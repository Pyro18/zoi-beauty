import 'package:flutter/material.dart';
import 'package:client/network/api.dart';
import 'package:objectbox/objectbox.dart';
import 'package:path_provider/path_provider.dart' as path_provider;
import 'package:client/models/user_model.dart';
import 'package:client/objectbox.g.dart';

class AuthController {
  final Api api = Api();
  static Store? _store;
  static Box<User>? _userBox;
  late Future<void> _initFuture;

  AuthController() {
    _initFuture = _initObjectBox();
  }

  Future<void> _initObjectBox() async {
    if (_store == null) {
      final directory = await path_provider.getApplicationDocumentsDirectory();
      print('Directory: ${directory.path}');
      _store = Store(getObjectBoxModel(), directory: '${directory.path}/objectbox');
      _userBox = _store!.box<User>();
    }
  }

  Future<AuthController> init() async {
    await _initFuture;
    return this;
  }

  void dispose() {
    _store?.close();
  }

  Future<bool> login(
      BuildContext context, String username, String password) async {
    await init();
    print('Username: $username');
    print('Password: $password');
    if (username.isEmpty || password.isEmpty) {
      print('Username or password cannot be empty');
      return false;
    }
    var userData = await api.login(username, password);
    print('User data: $userData');
    if (userData['status'] == 'success') {
      print('User logged in: ${userData['data']}');
      _userBox?.put(User(username: username, password: password));
      return true;
    } else if (userData['status'] == 'failure') {
      print('Login failed: ${userData['message']}');
      return false;
    } else {
      print('An error occurred');
      return false;
    }
  }

  Future<User?> getLoggedInUser() async {
    await init();
    final users = _userBox?.getAll();
    if (users != null && users.isNotEmpty) {
      return users.first;
    }
    return null;
  }

  Future<User> logout() async {
    await init();
    final users = _userBox?.getAll();
    if (users != null && users.isNotEmpty) {
      User user = users.first;
      _userBox?.remove(user.id);
      return user;
    }
    return User(username: '', password: '');
  }
}