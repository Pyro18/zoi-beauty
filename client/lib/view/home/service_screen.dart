import 'package:client/controllers/booking_controller.dart';
import 'package:client/notifier/BookingNotifier.dart';
import 'package:client/view/home/components/service_card.dart';
import 'package:flutter/material.dart';
import 'package:client/network/api.dart';
import 'package:provider/provider.dart';

class ServicePage extends StatefulWidget {
  const ServicePage({
    Key? key,
  }) : super(key: key);


  @override
  _ServicePageState createState() => _ServicePageState();
}

class _ServicePageState extends State<ServicePage> {
  Future<List<Map<String, dynamic>>>? _servicesFuture;
  bool _isBlueColor = true;
  List<String> selectedServiceIds = []; // Lista per memorizzare gli ID dei servizi selezionati

  @override
  void initState() {
    super.initState();
    _servicesFuture = Api().getServices();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('servizio'),
        centerTitle: true,
      ),
      body: FutureBuilder<List<Map<String, dynamic>>>(
        future: _servicesFuture,
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return Center(child: CircularProgressIndicator());
          } else if (snapshot.hasError) {
            print('Error: ${snapshot.error}');
            return Center(child: Text('Error: ${snapshot.error}'));
          } else {
            return ListView.builder(
              itemCount: snapshot.data!.length,
              itemBuilder: (context, index) {
                var service = snapshot.data![index];
                Color color = _isBlueColor ? Color(0xFF7553F6) : Color(0xFF80A4FF);
                _isBlueColor = !_isBlueColor;
                return GestureDetector(
                  onTap: () async {
                    // Add the service ID to the list
                    selectedServiceIds.add(service['id'].toString());
                    final bookingNotifier = Provider.of<BookingNotifier>(context, listen: false);
                    bookingNotifier.setBookingUpdated(true);

                    // Show the date picker
                    final pickedDate = await showDatePicker(
                      context: context,
                      initialDate: DateTime.now(),
                      firstDate: DateTime.now(),
                      lastDate: DateTime.now().add(Duration(days: 365)),
                    );
                    if (pickedDate == null) {
                      return;
                    }

                    // Show the time picker
                    final pickedTime = await showTimePicker(
                      context: context,
                      initialTime: TimeOfDay.now(),
                    );
                    if (pickedTime == null) {
                      return;
                    }

                    final dateTime = DateTime(
                      pickedDate.year,
                      pickedDate.month,
                      pickedDate.day,
                      pickedTime.hour,
                      pickedTime.minute,
                    );
                    final date =
                        '${dateTime.year}-${dateTime.month.toString().padLeft(2, '0')}-${dateTime.day.toString().padLeft(2, '0')}';
                    final time =
                        '${dateTime.hour.toString().padLeft(2, '0')}:${dateTime.minute.toString().padLeft(2, '0')}:00';

                    // Show the booking dialog
                    showDialog(
                      context: context,
                      builder: (context) {
                        return AlertDialog(
                          title: Text('Prenota un servizio'),
                          content: Text('Scegli data e ora per il tuo servizio'),
                          actions: [
                            TextButton(
                              child: Text('Annulla'),
                              onPressed: () {
                                Navigator.of(context).pop();
                                selectedServiceIds.clear(); // Clear the list if the operation is cancelled
                                print('lista svuotata');
                              },
                            ),
                            TextButton(
                              child: Text('Prenota'),
                              onPressed: () async {
                                // Use the addBooking function to make the booking
                                BookingController bookingController = BookingController();
                                bool bookingSuccess = await bookingController.addBooking('10', selectedServiceIds.first.toString(), date, time);
                                if (bookingSuccess) {
                                  print('Prenotazione effettuata con successo');
                                  Navigator.pop(context);
                                  selectedServiceIds.clear(); // Clear the list after the booking is successful
                                  bookingController.updateBookings();
                                  setState(() {});
                                } else {
                                  print('Errore nella prenotazione');

                                }


                              },
                            ),
                          ],
                        );
                      },
                    );
                  },
                  child: Padding(
                    padding: const EdgeInsets.all(8.0),
                    child: ServiceCard(
                      title: service['name'],
                      price: double.parse(service['price']),
                      iconsSrc: "assets/icons/ios.svg",
                      colorl: color,
                    ),
                  ),
                );
              },
            );
          }
        },
      ),
    );
  }
}

