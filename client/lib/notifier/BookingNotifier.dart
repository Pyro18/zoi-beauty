import 'package:flutter/material.dart';

class BookingNotifier extends ChangeNotifier {
  bool _isBookingUpdated = false;

  bool get isBookingUpdated => _isBookingUpdated;

  void setBookingUpdated(bool value) {
    _isBookingUpdated = value;
    notifyListeners();
  }
}