# Centro Estetico App

Questa è un'applicazione per i centri estetici che permette agli utenti di prenotare servizi. L'app offre una varietà di funzionalità, tra cui la visualizzazione di prenotazioni attive e passate, la prenotazione di nuovi servizi e la gestione del profilo utente.

## Struttura delle Cartelle

```
└── 📁lib
    └── 📁controllers
        └── auth_controller.dart
        └── booking_controller.dart
        └── service_controller.dart
        └── user_controller.dart
    └── main.dart
    └── 📁models
        └── booking_model.dart
        └── menu.dart
        └── past_booking_model.dart
        └── rive_model.dart
        └── service_model.dart
        └── user_model.dart
        └── user_page_model.dart
    └── 📁network
        └── api.dart
    └── 📁notifier
        └── BookingNotifier.dart
    └── objectbox-model.json
    └── objectbox.g.dart
    └── 📁utils
        └── constants.dart
        └── rive_utils.dart
    └── 📁view
        └── 📁entry_point
            └── 📁components
                └── animated_bar.dart
                └── btm_nav_item.dart
                └── info_card.dart
                └── menu_btn.dart
                └── side_bar.dart
                └── side_menu.dart
            └── entry_point.dart
        └── 📁home
            └── 📁components
                └── active_booking_card.dart
                └── book_a_service_card.dart
                └── past_booking_card.dart
                └── service_card.dart
                └── user_card.dart
            └── home_screen.dart
            └── promotion_screen.dart
            └── service_screen.dart
            └── user_screen.dart
        └── 📁splash_screen
            └── 📁auth
                └── login_dialog.dart
                └── login_form.dart
            └── 📁components
                └── animated_btn.dart
            └── splash_screen.dart
```

## Esempi di Codice Significativi

Ecco l'implementazione di `api.dart`, che gestisce le chiamate alle API del backend:

```dart
import 'dart:convert';
import 'package:http/http.dart' as http;

class Api {
  final String baseUrl = 'https://api.zoi-beauty.it/';

  Future<List<Map<String, dynamic>>> fetchActiveBookings(String userId) async {
    final response = await http.get(Uri.parse('$baseUrl/bookings/$userId'));
    if (response.statusCode == 200) {
      final List<dynamic> data = jsonDecode(response.body);
      return data.cast<Map<String, dynamic>>();
    } else {
      throw Exception('Failed to load active bookings');
    }
  }
```

Questo file gestisce la comunicazione con il backend per recuperare i dati delle prenotazioni attive. Le altre operazioni CRUD per le prenotazioni sono gestite in modo simile, con metodi aggiuntivi aggiunti a `Api` per gestire operazioni come la creazione, l'aggiornamento e l'eliminazione delle prenotazioni.

### Esempio di chiamata API in `booking_controller.dart`:

Il `booking_controller.dart` è responsabile della gestione delle operazioni relative alle prenotazioni, inclusa l'interazione con le API per recuperare, aggiornare e eliminare le prenotazioni.

```dart
import 'package:client/network/api.dart';

class BookingController {
  final Api _api = Api();

  Future<List<Booking>> fetchActiveBookings(String userId) async {
    try {
      final response = await _api.fetchActiveBookings(userId);
      // Parse response data into Booking objects
      return response.map((json) => Booking.fromJson(json)).toList();
    } catch (e) {
      throw Exception('Failed to fetch active bookings: $e');
    }
  }

  // Other methods for creating, updating, and deleting bookings...
}
```

### Esempio di modello in `booking_model.dart`:

Il `booking_model.dart` definisce la struttura dei dati delle prenotazioni e fornisce un metodo per convertire i dati JSON in oggetti di modello.

```dart
class Booking {
  final String id;
  final String title;
  final String iconSrc;
  final String color;
  final String date;
  final String time;

  Booking({
    required this.id,
    required this.title,
    required this.iconSrc,
    required this.color,
    required this.date,
    required this.time,
  });

  factory Booking.fromJson(Map<String, dynamic> json) {
    return Booking(
      id: json['id'],
      title: json['title'],
      iconSrc: json['iconSrc'],
      color: json['color'],
      date: json['date'],
      time: json['time'],
    );
  }
}
```

### Esempio di utilizzo dei modelli nelle schermate in `home_screen.dart`:

La `home_screen.dart` utilizza i modelli dei dati delle prenotazioni per visualizzare le prenotazioni attive e passate.

```dart
import 'package:client/models/booking_model.dart';
import 'package:client/controllers/booking_controller.dart';

class HomePage extends StatelessWidget {
  final BookingController _bookingController = BookingController();

  @override
  Widget build(BuildContext context) {
    return FutureBuilder<List<Booking>>(
      future: _bookingController.fetchActiveBookings('10'),
      builder: (context, snapshot) {
        if (snapshot.connectionState == ConnectionState.waiting) {
          return CircularProgressIndicator();
        } else if (snapshot.hasError) {
          print(snapshot.error);
          return Text('Error: ${snapshot.error}');
        } else {
          // Display active bookings using BookingCard widget
          return ListView.builder(
            itemCount: snapshot.data.length,
            itemBuilder: (context, index) {
              return BookingCard(
                booking: snapshot.data[index],
              );
            },
          );
        }
      },
    );
  }
}
```

Questi esempi illustrano come le API vengono utilizzate per ottenere dati, come vengono convertiti in oggetti di modello e come vengono utilizzati per costruire l'interfaccia utente.
