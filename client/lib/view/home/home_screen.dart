import 'package:client/notifier/BookingNotifier.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

import '../../models/booking_model.dart';
import '../../models/past_booking_model.dart';
import 'components/active_booking_card.dart';
import 'components/past_booking_card.dart';
import 'package:client/controllers/booking_controller.dart';
import 'package:client/controllers/service_controller.dart';
import 'package:client/models/service_model.dart';
import 'package:dotted_border/dotted_border.dart';

class HomePage extends StatefulWidget {
  const HomePage({super.key});

  @override
  _HomePageState createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  final BookingController bookingController = BookingController();
  final ServiceController serviceController = ServiceController();

  @override
  void initState() {
    super.initState();
    bookingController.checkBookings();
  }

  void refreshPage() {
    setState(() {});
  }

  @override
  Widget build(BuildContext context) {
    final bookingController = BookingController();
    final bookingNotifier = Provider.of<BookingNotifier>(context);

    WidgetsBinding.instance!.addPostFrameCallback((_) {
      if (bookingNotifier.isBookingUpdated) {
        bookingController.updateBookings();
        bookingNotifier.setBookingUpdated(false);
      }
    });

    return Scaffold(
      body: SafeArea(
        bottom: false,
        child: SingleChildScrollView(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              const SizedBox(height: 40),
              Padding(
                padding: const EdgeInsets.all(20),
                child: Text(
                  "Prenotazioni",
                  style: Theme.of(context).textTheme.headlineMedium!.copyWith(
                      color: Colors.black, fontWeight: FontWeight.bold),
                ),
              ),

              FutureBuilder<List<Booking>>(
                future: bookingController.fetchActiveBookings('10'),
                builder: (context, snapshot) {
                  if (snapshot.connectionState == ConnectionState.waiting) {
                    return CircularProgressIndicator();
                  } else if (snapshot.hasError) {
                    print(snapshot.error);
                    return Text('Error: ${snapshot.error}');
                  } else {
                    // Crea una lista di widget GestureDetector
                    List<Widget> bookingCards = snapshot.data!
                        .map((booking) => GestureDetector(
                              onLongPress: () async {
                                final confirm = await showDialog(
                                  context: context,
                                  builder: (BuildContext context) {
                                    return AlertDialog(
                                      title: const Text('Conferma'),
                                      content: Text(
                                          'Sei sicuro di voler eliminare questa prenotazione?'),
                                      actions: <Widget>[
                                        TextButton(
                                          child: Text('Annulla'),
                                          onPressed: () {
                                            Navigator.of(context).pop(false);
                                          },
                                        ),
                                        TextButton(
                                          child: Text('Conferma'),
                                          onPressed: () {
                                            Navigator.of(context).pop(true);
                                          },
                                        ),
                                      ],
                                    );
                                  },
                                );
                                if (confirm) {
                                  final result = await bookingController
                                      .deleteBooking(booking.id);
                                  if (result) {
                                    // Aggiorna l'interfaccia utente
                                    setState(() {});
                                  } else {
                                    // Gestisci l'errore
                                  }
                                }
                              },
                              child: Padding(
                                padding: const EdgeInsets.only(left: 20),
                                child: BookingCard(
                                  title: booking.title,
                                  iconSrc: booking.iconSrc,
                                  color: booking.color,
                                  date: booking.date,
                                  time: booking.time,
                                  bookingId: booking.id,
                                  bookingController: bookingController,
                                ),
                              ),
                            ))
                        .toList();

                    bookingCards.add(
                      GestureDetector(
                        onTap: () {
                          showDatePicker(
                            context: context,
                            initialDate: DateTime.now(),
                            firstDate: DateTime.now(),
                            lastDate: DateTime.now().add(Duration(days: 365)),
                          ).then((pickedDate) {
                            if (pickedDate == null) {
                              return;
                            }
                            showTimePicker(
                              context: context,
                              initialTime: TimeOfDay.now(),
                            ).then((pickedTime) {
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
                              showDialog(
                                context: context,
                                builder: (BuildContext context) {
                                  String? serviceId;
                                  return FutureBuilder<List<Service>>(
                                    future: serviceController.fetchServices(),
                                    builder: (context, snapshot) {
                                      if (snapshot.connectionState == ConnectionState.waiting) {
                                        return CircularProgressIndicator();
                                      } else if (snapshot.hasError) {
                                        print(snapshot.error);
                                        return Text('Error: ${snapshot.error}');
                                      } else {
                                        return AlertDialog(
                                          title: Text('Nuova Prenotazione'),
                                          content: Column(
                                            children: <Widget>[
                                              DropdownButton<String>(
                                                hint: Text("Seleziona un servizio"),
                                                value: serviceId,
                                                onChanged: (String? newValue) {
                                                  setState(() {
                                                    serviceId = newValue;
                                                  });
                                                },
                                                items: snapshot.data!.map<DropdownMenuItem<String>>((Service service) {
                                                  return DropdownMenuItem<String>(
                                                    value: service.id,
                                                    child: Text(service.name),
                                                  );
                                                }).toList(),
                                              ),
                                            ],
                                          ),
                                          actions: <Widget>[
                                            TextButton(
                                              child: Text('Annulla'),
                                              onPressed: () {
                                                Navigator.of(context).pop();
                                              },
                                            ),
                                            TextButton(
                                              child: Text('Conferma'),
                                              onPressed: () async {
                                                if (serviceId != null) {
                                                  final result = await bookingController.addBooking('10', serviceId!, date, time);
                                                  if (result) {
                                                    // Aggiorna l'interfaccia utente
                                                    setState(() {});
                                                  } else {
                                                    // Gestisci l'errore
                                                  }
                                                  Navigator.of(context).pop();
                                                }
                                              },
                                            ),
                                          ],
                                        );
                                      }
                                    },
                                  );
                                },
                              );
                            });
                          });
                        },
                        child: Padding(
                          padding: const EdgeInsets.symmetric(
                              horizontal: 16, vertical: 24),
                          child: DottedBorder(
                            dashPattern: const [10, 10],
                            strokeWidth: 3,
                            color: Colors.grey,
                            borderType: BorderType.RRect,
                            radius: Radius.circular(30),
                            child: Container(
                              height: 270,
                              width: 250,
                              child: const Center(
                                child: Icon(
                                  Icons.add,
                                  size: 50,
                                  color: Colors.grey,
                                ),
                              ),
                            ),
                          ),
                        ),
                      ),
                    );
                    // Restituisce un SingleChildScrollView con la lista di bookingCards
                    return SingleChildScrollView(
                      scrollDirection: Axis.horizontal,
                      child: Row(
                        children: bookingCards,
                      ),
                    );
                  }
                },
              ),

              Padding(
                padding: const EdgeInsets.all(20),
                child: Text(
                  "Recenti",
                  style: Theme.of(context).textTheme.headlineSmall!.copyWith(
                      color: Colors.black, fontWeight: FontWeight.bold),
                ),
              ),
              // StreamBuilder<List<PastBooking>>(
              //   stream: bookingController.fetchPastBookings(),
              //   builder: (context, snapshot) {
              //     if (snapshot.connectionState == ConnectionState.waiting) {
              //       return CircularProgressIndicator();
              //     } else if (snapshot.hasError) {
              //       print(snapshot.error);
              //       return Text('Error: ${snapshot.error}');
              //     } else {
              //       // Crea una lista di widget PastBookingCard
              //       List<Widget> pastBookingCards = snapshot.data!
              //           .asMap()
              //           .entries
              //           .map((entry) => Flexible(
              //                 fit: FlexFit.loose,
              //                 child: PastBookingCard(entry.value,
              //                     index: entry.key),
              //               ))
              //           .toList();
              //       // Restituisce un SingleChildScrollView con la lista di pastBookingCards
              //       return SingleChildScrollView(
              //         scrollDirection: Axis.horizontal,
              //         child: Container(
              //           child: Row(
              //             children: pastBookingCards,
              //           ),
              //         ),
              //       );
              //     }
              //   },
              // ),
            ],
          ),
        ),
      ),
      floatingActionButton: Padding(
        padding: EdgeInsets.only(bottom: 60.0),
        child: FloatingActionButton(
          onPressed: refreshPage,
          child: Icon(Icons.refresh),
          backgroundColor: Colors.blue,
        ),
      ),
    );
  }
}
