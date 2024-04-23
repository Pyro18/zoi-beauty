import 'package:flutter/material.dart';
import 'package:client/network/api.dart';
import 'package:client/views/user/home_page.dart';

class AuthController {
  final Api api = Api();

  Future<void> login(BuildContext context, String username, String email, String password) async {
    if (username.isEmpty || email.isEmpty || password.isEmpty) {
      print('Username, email or password cannot be empty');
      return;
    }
    try {
      var userData = await api.login(username, email, password);
      Navigator.push(
        context,
        MaterialPageRoute(builder: (context) => HomePage()),
      );
    } catch (e) {
      print(e);
    }
  }
}