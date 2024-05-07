import 'package:flutter/material.dart' show Color;

class Booking {
  final String title, description, iconSrc, date, time;
  final int id;
  final Color color;

  Booking({
    required this.id,
    required this.title,
    this.description = 'testino piccino',
    this.iconSrc = "assets/icons/ios.svg",
    required this.color,
    required this.date,
    required this.time,
  });


  factory Booking.fromMap(Map<String, dynamic> map, {int colorIndex = 0}) {
    List<Color> colors = [Color(0xFF7553F6), Color(0xFF80A4FF)]; // List of colors to alternate
    return Booking(
      id: map['id'] ?? 'No id',
      title: map['servizio_nome'] ?? 'Nessun Servizio',
      description: 'Effettuata da: ${map['utente_nome']} ${map['utente_cognome']}',
      iconSrc: "assets/icons/ios.svg",
      color: colors[colorIndex % colors.length], // Select color based on index
      date: map['data_ora']?.split(' ')[0] ?? 'No date',
      time: map['data_ora']?.split(' ')[1] ?? 'No time',
    );
  }

}


// final List<Booking> bookAServices = [
//   Booking(title: "State Machine"),
//   Booking(
//     title: "Animated Menu",
//     color: const Color(0xFF9CC5FF),
//     iconSrc: "assets/icons/code.svg",
//   ),
//   Booking(title: "Flutter with Rive"),
//   Booking(
//     title: "Animated Menu",
//     color: const Color(0xFF9CC5FF),
//     iconSrc: "assets/icons/code.svg",
//   ),
// ];