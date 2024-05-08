import 'package:flutter/material.dart';

class PromotionPage extends StatelessWidget {
  final String title;

  const PromotionPage({
    Key? key,
    required this.title,
  }) : super(key: key);


  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(

        title: const Text(
          'Promozioni',
          style: TextStyle(
            fontSize: 24,
            fontWeight: FontWeight.bold,
            textBaseline: TextBaseline.alphabetic
          ),
        ),
        toolbarHeight: 170, // default è 56
        backgroundColor: Colors.transparent,
      ),
      body: const Center(
        child: Text(
          'ATTUALMENTE NON CI SONO PROMOZIONI',
          style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold),
          textAlign: TextAlign.center,
        ),
      ),
    );
  }
}