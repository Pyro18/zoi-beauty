import 'dart:convert';
import 'package:http/http.dart' as http;

class Api {
  static const String baseUrl = 'http://10.0.2.2:8080/backend/api/v1/';

  // login function
  Future<Map<String, dynamic>> login(String username, String email, String password) async {
    final response = await http.post(
      Uri.parse(baseUrl + 'auth/login.php'),
      headers: <String, String>{
        'Content-Type': 'application/json; charset=UTF-8',
      },
      body: jsonEncode(<String, String>{
        'userIdentifier': username,
        'email': email,
        'password': password,
      }),
    );
    if (response.statusCode == 200) {
      // Handle successful login
      var data = jsonDecode(response.body);
      if (data['status'] == 'success') {
        print('User logged in: ${data['data']}');
        return data['data'];
      } else {
        print('Login failed: ${data['message']}');
        throw Exception('Failed to login: ${data['message']}');
      }
    } else {
      throw Exception('Failed to login');
    }
  }

  // register function
}