import 'package:client/controllers/booking_controller.dart';
import 'package:client/controllers/service_controller.dart';
import 'package:client/models/service_model.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';
import 'package:intl/intl.dart';

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
  ServiceController serviceController = ServiceController();
  String? selectedService;
  String? selectedDate;
  String? selectedTime;

  String formatTimeOfDay(TimeOfDay timeOfDay) {
    final now = DateTime.now();
    final dt = DateTime(now.year, now.month, now.day, timeOfDay.hour, timeOfDay.minute);
    final format = DateFormat('HH:mm');  // formato 24h
    return format.format(dt);
  }

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
                                  controller: dateController,
                                  decoration: InputDecoration(
                                    labelText: 'Data',
                                  ),
                                  onTap: () async {
                                    final date = await showDatePicker(
                                      context: context,
                                      initialDate: DateTime.now(),
                                      firstDate: DateTime.now(),
                                      lastDate: DateTime.now().add(Duration(days: 365)),
                                    );
                                    if (date != null) {
                                      selectedDate = DateFormat('yyyy-MM-dd').format(date);
                                      dateController.text = selectedDate!;
                                    }
                                  },
                                ),
                                TextField(
                                  controller: timeController,
                                  decoration: InputDecoration(
                                    labelText: 'Ora',
                                  ),
                                  onTap: () async {
                                    final time = await showTimePicker(
                                      context: context,
                                      initialTime: TimeOfDay.now(),
                                      builder: (BuildContext context, Widget? child) {
                                        return MediaQuery(
                                          data: MediaQuery.of(context).copyWith(alwaysUse24HourFormat: true),
                                          child: child!,
                                        );
                                      },
                                    );
                                    if (time != null) {
                                      selectedTime = formatTimeOfDay(time);
                                      timeController.text = selectedTime!;
                                    }
                                  },
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
                                  final dateTime = dateController.text + ' ' + timeController.text;
                                  final date = dateTime.split(' ')[0];
                                  final time = dateTime.split(' ')[1];
                                  final result = await widget.bookingController.updateBooking(
                                    widget.bookingId,
                                    date,
                                    time,
                                  );
                                  if (result) {
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