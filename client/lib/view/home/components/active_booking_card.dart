import 'package:client/controllers/booking_controller.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';

class BookingCard extends StatefulWidget {
  final String title, iconSrc, date, time;
  final Color color;
  final int bookingId;
  final BookingController bookingController;

  BookingCard({
    Key? key,
    required this.title,
    required this.date,
    required this.time,
    required this.color,
    required this.iconSrc,
    required this.bookingId,
    required this.bookingController,
  }) : super(key: key);

  @override
  State<BookingCard> createState() => _BookingCardState();
}

class _BookingCardState extends State<BookingCard> {
  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 24),
      height: 280,
      width: 260,
      decoration: BoxDecoration(
        color: widget.color,
        borderRadius: const BorderRadius.all(Radius.circular(30)),
      ),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Expanded(
            child: Padding(
              padding: const EdgeInsets.only(top: 6, right: 8),
              child: Column(
                children: [
                  Text(
                    widget.title,
                    style: Theme.of(context).textTheme.titleLarge!.copyWith(
                        color: Colors.white, fontWeight: FontWeight.w600),
                  ),
                  Padding(
                    padding: const EdgeInsets.only(top: 12, bottom: 8),
                    child: Text(
                      widget.date,
                      style: TextStyle(
                        color: Colors.white60,
                      ),
                    ),
                  ),
                  Text(
                    widget.time,
                    style: TextStyle(
                      color: Colors.white60,
                    ),
                  ),
                  const Spacer(),
                  IconButton(
                    icon: Icon(Icons.edit, color: Colors.white),
                    onPressed: () {
                      // Crea un TextEditingController per ciascuno dei campi di input
                      final serviceNameController = TextEditingController();
                      final dateController = TextEditingController();
                      final timeController = TextEditingController();

                      // Mostra un dialogo quando l'utente fa clic sul pulsante
                      showDialog(
                        context: context,
                        builder: (context) {
                          return AlertDialog(
                            title: Text('Modifica prenotazione'),
                            content: Column(
                              children: <Widget>[
                                TextField(
                                  controller: serviceNameController,
                                  decoration: InputDecoration(
                                    labelText: 'Nome del servizio',
                                  ),
                                ),
                                TextField(
                                  controller: dateController,
                                  decoration: InputDecoration(
                                    labelText: 'Data',
                                  ),
                                ),
                                TextField(
                                  controller: timeController,
                                  decoration: InputDecoration(
                                    labelText: 'Ora',
                                  ),
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
                                  // Quando l'utente fa clic su "Conferma", chiama `updateBooking` con i nuovi dettagli della prenotazione
                                  final result = await widget.bookingController.updateBooking(
                                    widget.bookingId,
                                    dateController.text,
                                    timeController.text,
                                  );
                                  if (result) {
                                    // Aggiorna l'interfaccia utente
                                    setState(() {});
                                  } else {
                                    // Gestisci l'errore
                                  }
                                  Navigator.of(context).pop();
                                },
                              ),
                            ],
                          );
                        },
                      );
                    },
                  ),
                ],
              ),
            ),
          ),
          SvgPicture.asset(widget.iconSrc),
        ],
      ),
    );
  }
}