import 'package:flutter/material.dart';

class PastBooking {
  int id;
  String title, description, iconSrc, date, time, completedAt;
  int colorValue;

  PastBooking({
    this.id = 0,
    required this.title,
    required this.description,
    this.iconSrc = "assets/icons/ios.svg",
    required this.colorValue,
    required this.date,
    required this.time,
    required this.completedAt,
  });

  Color get color => Color(colorValue);
  set color(Color color) => colorValue = color.value;

  Map<String, dynamic> toMap() {
    return {
      'id': id,
      'title': title,
      'description': description,
      'iconSrc': iconSrc,
      'colorValue': colorValue,
      'date': date,
      'time': time,
      'completedAt': completedAt,
    };
  }
}