import 'package:flutter/material.dart';
import 'package:client/controllers/user_controller.dart';
import 'package:client/models/user_page_model.dart';
import 'package:client/view/home/components/user_card.dart';

class UserPage extends StatefulWidget {
  @override
  _UserPageState createState() => _UserPageState();
}

class _UserPageState extends State<UserPage> {
  final UserController userController = UserController();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        appBar: AppBar(
          title: Text('User Information'),
          centerTitle: true,
        ),
        body: FutureBuilder<UserPageModel>(
          future: userController
              .fetchUser('10'), // replace '10' with the actual user id
          builder: (context, snapshot) {
            if (snapshot.connectionState == ConnectionState.waiting) {
              return Center(child: CircularProgressIndicator());
            } else if (snapshot.hasError) {
              print(snapshot.error);
              return Center(child: Text('Error: ${snapshot.error}'));
            } else {
              UserPageModel user = snapshot.data!;
              List<Color> colors = [
                Color(0xFF7553F6),
                Color(0xFF80A4FF)
              ]; // List of colors to alternate
              List<Widget> userCards = [
                UserCard(
                    title: 'Username:',
                    value: user.username ?? '',
                    color: colors[0]),
                UserCard(
                    title: 'Nome:', value: user.nome ?? '', color: colors[1]),
                UserCard(
                    title: 'Cognome:',
                    value: user.cognome ?? '',
                    color: colors[0]),
                UserCard(
                    title: 'Telefono:',
                    value: user.telefono ?? '',
                    color: colors[1]),
                UserCard(
                    title: 'Email', value: user.email ?? '', color: colors[0]),
              ];
              return ListView(children: userCards);
            }
          },
        ));
  }
}
