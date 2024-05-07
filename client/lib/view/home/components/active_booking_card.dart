import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';

class BookingCard extends StatelessWidget {
  const BookingCard({
    super.key,
    required this.title,
    required this.date,
    required this.time,
    this.color = const Color(0xFF7553F6),
    this.iconSrc = "assets/icons/ios.svg",
  });

  final String title, iconSrc, date, time;
  final Color color;

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 24),
      height: 280,
      width: 260,
      decoration: BoxDecoration(
        color: color,
        borderRadius: const BorderRadius.all(Radius.circular(30)),
      ),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Expanded(
            child: Padding(
              padding: const EdgeInsets.only(top: 6, right: 8),
              child: Column(
                children: [
                  Text(
                    title,
                    style: Theme.of(context).textTheme.titleLarge!.copyWith(
                        color: Colors.white, fontWeight: FontWeight.w600),
                  ),
                  Padding(
                    padding: const EdgeInsets.only(top: 12, bottom: 8),
                    child: Text(
                      date, // Display the date
                      style: TextStyle(
                        color: Colors.white60,
                      ),
                    ),
                  ),
                  Text(
                    time, // Display the time
                    style: TextStyle(
                      color: Colors.white60,
                    ),
                  ),
                  const Spacer(),
                ],
              ),
            ),
          ),
          SvgPicture.asset(iconSrc),
        ],
      ),
    );
  }
}