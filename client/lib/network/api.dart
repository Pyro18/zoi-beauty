import 'dart:convert';
import 'package:http/http.dart' as http;

class Api {
  static const String baseUrl = 'https://api.zoi-beauty.it/api/v1/';

  // login function
  Future<Map<String, dynamic>> login(String username, String password) async {
    final response = await http.post(
      Uri.parse(baseUrl + 'auth/login.php'),
      headers: <String, String>{
        'Content-Type': 'application/json; charset=UTF-8',
      },
      body: jsonEncode(<String, String>{
        'userIdentifier': username,
        'password': password,
      }),
    );
    if (response.statusCode == 200) {
      var data = jsonDecode(response.body);
      if (data['status'] == 'success') {
        print('User logged in: ${data['data']}');
        return data;
      } else {
        print('Login failed: ${data['message']}');
        return {'status': 'failure', 'message': data['message']};
      }
    } else {
      throw Exception('Failed to login');
    }
  }

  Future<Map<String, dynamic>> getUser(String userId) async {
    final response =
        await http.get(Uri.parse(baseUrl + 'user/users.php?user_id=$userId'));
    if (response.statusCode == 200) {
      var data = jsonDecode(response.body);
      if (data['status'] == 'success') {
        return data;
      } else {
        throw Exception('Failed to fetch user');
      }
    } else {
      throw Exception('Failed to fetch user');
    }
  }

  Future<List<Map<String, dynamic>>> getActiveBookings(String userId) async {
    final response = await http.get(Uri.parse(baseUrl + 'service/booking.php?user_id=$userId'));
    if (response.statusCode == 200) {
      var data = jsonDecode(response.body);
      if (data['status'] == 'success') {
        return List<Map<String, dynamic>>.from(data['data']);
      } else {
        print('Failed to fetch bookings: ${data['message']}');
        throw Exception('Failed to fetch bookings');
      }
    } else {
      throw Exception('Failed to fetch bookings');
    }
  }

  Future<bool> deleteBooking(int bookingId) async {
    final response = await http.delete(Uri.parse(baseUrl + 'service/booking.php?booking_id=$bookingId'));
    if (response.statusCode == 200) {
      var data = jsonDecode(response.body);
      if (data['status'] == 'success') {
        return true;
      } else {
        print('Failed to delete booking: ${data['message']}');
        return false;
      }
    } else {
      throw Exception('Failed to delete booking');
    }
  }


  Future<Map<String, dynamic>> bookService(String userId, String serviceId, String date, String time) async {
    final body = jsonEncode(<String, String>{
      'utente_id': userId,
      'servizio_id': serviceId,
      'data_ora': '$date $time',
    });

    print('Data sent to server: $body');

    final response = await http.post(
      Uri.parse(baseUrl + 'service/booking.php'),
      headers: <String, String>{
        'Content-Type': 'application/json; charset=UTF-8',
      },
      body: body,
    );
    print('Server response: ${response.body}');
    if (response.statusCode == 200) {
      var data = jsonDecode(response.body);
      if (data['status'] == 'success') {
        return data;
      } else {
        throw Exception('Failed to book service');
      }
    } else {
      throw Exception('Failed to book service');
    }
  }
}
