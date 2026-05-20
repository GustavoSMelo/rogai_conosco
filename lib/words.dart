import 'package:flutter/material.dart';

class Words extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Color.fromRGBO(245, 237, 220, 1),
      body: Column(
        children: [
          Padding(
            padding: EdgeInsetsGeometry.symmetric(horizontal: 20, vertical: 30),
            child: Text(
              'Titulo: Titulo da conversa',
              style: TextStyle(
                fontSize: 21,
                fontWeight: FontWeight.bold,
                color: Color.fromRGBO(74, 56, 43, 1),
              ),
            ),
          ),
        ],
      ),
    );
  }
}
