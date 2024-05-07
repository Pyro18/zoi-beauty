import 'package:client/models/past_booking_model.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';

class PastBookingCard extends StatelessWidget {
  final PastBooking pastBooking;
  final int index;

  const PastBookingCard(this.pastBooking, {super.key, required this.index});

  @override
  Widget build(BuildContext context) {
    final color =
    index.isEven ? const Color(0xFF7553F6) : const Color(0xFF47E6B1);
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 20),
      height: 200,
      decoration: BoxDecoration(
          color: color,
          borderRadius: const BorderRadius.all(Radius.circular(20))),
      child: Container(
        child: Row(
          children: [
            Flexible( // Use Flexible instead of Expanded
              fit: FlexFit.loose, // Set fit to FlexFit.loose
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    pastBooking.title,
                    style: Theme.of(context).textTheme.headlineSmall!.copyWith(
                      color: Colors.white,
                      fontWeight: FontWeight.w600,
                    ),
                  ),
                  const SizedBox(height: 4),
                  Text(
                    pastBooking.description,
                    style: const TextStyle(
                      color: Colors.white60,
                      fontSize: 16,
                    ),
                  )
                ],
              ),
            ),
            const SizedBox(
              height: 40,
              child: VerticalDivider(
                // thickness: 5,
                color: Colors.white70,
              ),
            ),
            const SizedBox(width: 8),
            SvgPicture.asset(
                pastBooking.iconSrc,
                height: 40,
                width: 40
            ),
          ],
        ),
      ),
    );
  }
}
