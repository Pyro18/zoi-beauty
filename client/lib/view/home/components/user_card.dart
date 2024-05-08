import 'package:client/models/user_page_model.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';

class UserCard extends StatelessWidget {
  final String title;
  final String value;
  final Color color;

  UserCard({
    Key? key,
    required this.title,
    required this.value,
    required this.color,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Card(
      color: color,
      child: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: <Widget>[
            Text(
                '$title',
              style: Theme.of(context).textTheme.headline6!.copyWith(
                  color: Colors.white,
                  fontWeight: FontWeight.w600,
                ),
            ),
            const SizedBox(height: 8),
            Text(
                '$value',
              style: const TextStyle(
                color: Colors.white60,
                fontSize: 16,
              ),
            ),
          ],
        ),
      ),
    );
  }
}