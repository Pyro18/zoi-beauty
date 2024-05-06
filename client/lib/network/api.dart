import 'dart:convert';
import 'package:http/http.dart' as http;

class Api {
  static const String baseUrl = 'https://api.zoi-beauty.it/';

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
    final response = await http.get(Uri.parse(baseUrl + '/user/users.php?user_id=$userId'));
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
}