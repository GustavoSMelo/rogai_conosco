import 'package:flutter/material.dart';

class Words extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    // Helper methods

    Widget _buildContentBox(
      IconData icon,
      String description,
      String verseReference,
      String verseText,
    ) {
      return Container(
        margin: const EdgeInsets.only(bottom: 16),
        decoration: BoxDecoration(
          color: Color.fromRGBO(245, 237, 220, 1),
          borderRadius: BorderRadius.circular(5),
          border: Border.all(color: Color.fromRGBO(188, 126, 75, 1), width: 1),
        ),
        child: Padding(
          padding: const EdgeInsets.all(16),
          child: Row(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Container(
                padding: const EdgeInsets.all(12),
                decoration: BoxDecoration(
                  color: Color.fromRGBO(188, 126, 75, 1).withValues(alpha: 0.2),
                  borderRadius: BorderRadius.circular(8),
                ),
                child: Icon(
                  icon,
                  color: Color.fromRGBO(188, 126, 75, 1),
                  size: 24,
                ),
              ),
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      description,
                      style: const TextStyle(fontSize: 14, height: 1.4),
                      maxLines: 2,
                      overflow: TextOverflow.ellipsis,
                    ),
                    Text(
                      verseReference,
                      style: TextStyle(
                        fontSize: 12,
                        fontWeight: FontWeight.w800,
                        color: Color.fromRGBO(188, 126, 75, 1),
                      ),
                    ),
                    Text(
                      verseText,
                      style: const TextStyle(
                        fontSize: 12,
                        fontStyle: FontStyle.italic,
                        color: Colors.blueGrey,
                      ),
                    ),
                  ],
                ),
              ),
            ],
          ),
        ),
      );
    }

    // UI build
    return Scaffold(
      backgroundColor: Color.fromRGBO(245, 237, 220, 1),
      body: Column(
        children: [
          Padding(
            padding: EdgeInsets.fromLTRB(10, 30, 10, 0),
            child: Text(
              'Titulo: Titulo da conversa',
              textAlign: TextAlign.left,
              style: TextStyle(
                fontSize: 21,
                fontWeight: FontWeight.bold,
                color: Color.fromRGBO(74, 56, 43, 1),
              ),
            ),
          ),
          Padding(
            padding: EdgeInsets.fromLTRB(10, 0, 10, 15),
            child: Text(
              'Espero que se identifique com essas palavras',
              textAlign: TextAlign.left,
              style: TextStyle(
                fontSize: 16,
                fontWeight: FontWeight.bold,
                color: Color.fromRGBO(211, 176, 146, 1),
              ),
            ),
          ),
          Expanded(
            child: ListView(
              padding: const EdgeInsets.symmetric(horizontal: 20),
              children: [
                _buildContentBox(
                  Icons.favorite,
                  'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                  'NT - John 1:1',
                  'In the beginning is a verb, and the verb was with God, and the verb is God',
                ),
                _buildContentBox(
                  Icons.close,
                  'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                  'NT - John 1:1',
                  'In the beginning is a verb, and the verb was with God, and the verb is God',
                ),
                _buildContentBox(
                  Icons.star,
                  'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                  'NT - John 1:1',
                  'In the beginning is a verb, and the verb was with God, and the verb is God',
                ),
              ],
            ),
          ),
          TextButton(
            onPressed: () {},
            style: TextButton.styleFrom(
              backgroundColor: Color.fromRGBO(188, 126, 75, 1),
            ),
            child: Text('Avancar'),
          ),
        ],
      ),
    );
  }
}
