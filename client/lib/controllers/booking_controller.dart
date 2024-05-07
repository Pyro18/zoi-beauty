import 'package:client/models/booking_model.dart';
import 'package:client/models/past_booking_model.dart';
import 'package:client/network/api.dart';
import 'package:sqflite/sqflite.dart';
import 'package:path/path.dart';

class BookingController {
  final Api api = Api();
  List<Booking> bookings = [];

  Future<Database> _initDb() async {
    return openDatabase(
      join(await getDatabasesPath(), 'past_bookings.db'),
      onCreate: (db, version) {
        return db.execute(
          "CREATE TABLE bookings(id INTEGER PRIMARY KEY, title TEXT, description TEXT, iconSrc TEXT, colorValue INTEGER, date TEXT, time TEXT, completedAt TEXT)",
        );
      },
      version: 1,
    );
  }

  Future<List<Booking>> fetchActiveBookings(String userId) async {
    final bookingData = await api.getActiveBookings(userId);
    List<Booking> fetchedBookings = bookingData.asMap().entries.map((entry) {
      int idx = entry.key;
      Map<String, dynamic> data = entry.value;
      return Booking.fromMap(data,
          colorIndex: idx); // indice per alternare i colori
    }).toList();
    print('data: $bookingData');
    print('Fetched bookings: $fetchedBookings');
    print('Fetched bookings: ${fetchedBookings.length}');

    return fetchedBookings;
  }

  Stream<List<PastBooking>> fetchPastBookings() async* {
    while (true) {
      final db = await _initDb();
      final maps = await db.query('bookings');

      yield List.generate(maps.length, (i) {
        return PastBooking(
          id: maps[i]['id'] as int,
          title: maps[i]['title'] as String,
          description: maps[i]['description'] as String,
          iconSrc: maps[i]['iconSrc'] as String,
          colorValue: maps[i]['colorValue'] as int,
          date: maps[i]['date'] as String,
          time: maps[i]['time'] as String,
          completedAt: maps[i]['completedAt'] as String,
        );
      });
      await Future.delayed(Duration(seconds: 5)); // Aggiorna ogni 5 secondi
    }
  }

  Future<bool> deleteBooking(int bookingId) async {
    bookings = await fetchActiveBookings('10');
    final response = await api.deleteBooking(bookingId);

    if (!bookings.any((booking) => booking.id == bookingId)) {
      print('Booking with id $bookingId not found');
      return false;
    }

    if (response) {
      print('Booking deleted');
      return true;
    } else {
      return false;
    }
  }

  Future<void> checkBookings() async {
    final now = DateTime.now();
    final activeBookings = await fetchActiveBookings('10');
    for (var booking in activeBookings) {
      final bookingDateTime = DateTime.parse('${booking.date} ${booking.time}');
      if (bookingDateTime.isBefore(now)) {
        // La prenotazione è scaduta, spostala nelle prenotazioni passate
        final pastBooking = PastBooking(
          id: booking.id,
          title: booking.title,
          description: booking.description,
          iconSrc: booking.iconSrc,
          colorValue: booking.color.value,
          date: booking.date,
          time: booking.time,
          completedAt: DateTime.now().toString(), // Or however you want to set this
        );
        final db = await _initDb();
        await db.insert(
          'bookings',
          pastBooking.toMap(),
          conflictAlgorithm: ConflictAlgorithm.replace,
        );
        // Elimina la prenotazione dalle prenotazioni attive
        await api.deleteBooking(booking.id);
      }
    }
  }


  Future<bool> addBooking(String userId, String serviceId, String date, String time) async {
    final response = await api.bookService(userId, serviceId, date, time);
    if (response['status'] == 'success') {
      print('Booking created');
      return true;
    } else {
      return false;
    }
  }
}
