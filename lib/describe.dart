import 'package:flutter/material.dart';

class DescribePage extends StatelessWidget {
  const DescribePage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Column(
        children: [
          Align(
            alignment: Alignment.centerLeft,
            child: Padding(
              padding: EdgeInsetsGeometry.fromLTRB(30, 50, 0, 30),
              child: Text(
                'Como foi o seu dia ?',
                style: TextStyle(
                  fontSize: 21,
                  fontWeight: FontWeight.bold,
                  color: Color.fromRGBO(74, 56, 43, 1),
                ),
              ),
            ),
          ),
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceEvenly,
            children: [
              Image.asset(
                'assets/images/happiness_gray.png',
                width: 60,
                height: 60,
              ),
              Image.asset(
                'assets/images/neutral_gray.png',
                width: 60,
                height: 60,
              ),
              Image.asset(
                'assets/images/saddiest_gray.png',
                width: 60,
                height: 60,
              ),
            ],
          ),
        ],
      ),
    );
  }
}
