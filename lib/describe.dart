import 'package:flutter/material.dart';

class DescribePage extends StatefulWidget {
  @override
  State<DescribePage> createState() => DescribePageState();
}

class DescribePageState extends State<DescribePage> {
  String selectedHumor = '';
  String descriptionText = '';

  String _getMoodDescription() {
    switch (selectedHumor) {
      case 'happy':
        return 'O seu dia foi feliz! 😊';
      case 'neutral':
        return 'O seu dia foi mais ou menos... 😐';
      case 'saddiest':
        return 'O seu dia foi ruim (sinto muito) 😢';
      default:
        return '';
    }
  }

  Color _getMoodColor() {
    switch (selectedHumor) {
      case 'happy':
        return Color.fromRGBO(74, 56, 43, 1); // Brown color from app theme
      case 'neutral':
        return Color.fromRGBO(100, 100, 100, 1); // Gray
      case 'saddiest':
        return Color.fromRGBO(139, 0, 0, 1); // Dark red
      default:
        return Colors.black;
    }
  }

  String _getMoodPlaceholder() {
    switch (selectedHumor) {
      case 'happy':
        return 'Conta pra mim, o que de especial aconteceu hoje ?';
      case 'neutral':
        return 'Bem como foi seu dia ?';
      case 'saddiest':
        return 'Precisa desabafar ? me conta o oque aconteceu pra eu te ajudar... ';
      default:
        return 'Conta pra mim, como foi seu dia...';
    }
  }

  bool _isDescriptionValid() {
    return descriptionText.length >= 20;
  }

  Color _getButtonBackgroundColor() {
    return _isDescriptionValid()
        ? Color.fromRGBO(188, 126, 75, 1)
        : Color.fromRGBO(200, 200, 200, 0.5); // Light gray when invalid
  }

  void _showErrorPopup(BuildContext context) {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: Text('Erro de Validação'),
          content: Text(
            'voce precisa digitar ao menos 20 caracteres para avancar',
          ),
          actions: [
            TextButton(
              onPressed: () {
                Navigator.of(context).pop();
              },
              child: Text('OK'),
            ),
          ],
        );
      },
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Color.fromRGBO(245, 237, 220, 1),
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
            mainAxisAlignment: MainAxisAlignment.spaceAround,
            children: [
              GestureDetector(
                onTap: () {
                  setState(() {
                    selectedHumor = 'happy';
                  });
                },
                child: selectedHumor == 'happy'
                    ? Image.asset(
                        'assets/images/happiness.png',
                        width: 60,
                        height: 60,
                      )
                    : Image.asset(
                        'assets/images/happiness_gray.png',
                        width: 60,
                        height: 60,
                      ),
              ),
              GestureDetector(
                onTap: () {
                  setState(() {
                    selectedHumor = 'neutral';
                  });
                },
                child: selectedHumor == 'neutral'
                    ? Image.asset(
                        'assets/images/neutral.png',
                        width: 60,
                        height: 60,
                      )
                    : Image.asset(
                        'assets/images/neutral_gray.png',
                        width: 60,
                        height: 60,
                      ),
              ),
              GestureDetector(
                onTap: () {
                  setState(() {
                    selectedHumor = 'saddiest';
                  });
                },
                child: selectedHumor == 'saddiest'
                    ? Image.asset(
                        'assets/images/saddiest.png',
                        width: 60,
                        height: 60,
                      )
                    : Image.asset(
                        'assets/images/saddiest_gray.png',
                        width: 60,
                        height: 60,
                      ),
              ),
            ],
          ),
          Container(
            alignment: Alignment.centerLeft,
            child: Padding(
              padding: EdgeInsets.fromLTRB(30.0, 18.0, 0.0, 0.0),
              child: Text(
                '( Toque em uma das carinhas para continuar )',
                style: TextStyle(
                  fontSize: 14,
                  color: Color.fromRGBO(80, 80, 80, 1),
                ),
              ),
            ),
          ),

          // Conditionally show textarea and button when mood is selected
          if (selectedHumor.isNotEmpty) ...[
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                // Subtitle describing selected mood with colorized text
                Padding(
                  padding: EdgeInsets.fromLTRB(30.0, 10.0, 0.0, 0.0),
                  child: Text(
                    _getMoodDescription(),
                    style: TextStyle(
                      fontSize: 16,
                      color: _getMoodColor(),
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                ),
                SizedBox(height: 10),
                Padding(
                  padding: EdgeInsets.fromLTRB(30.0, 80.0, 0.0, 0.0),
                  child: Text(
                    'Descreva o seu dia abaixo: ',
                    style: TextStyle(
                      fontSize: 14,
                      color: Color.fromRGBO(80, 80, 80, 1),
                    ),
                  ),
                ),
                SizedBox(height: 10),
                Padding(
                  padding: EdgeInsets.fromLTRB(30.0, 0.0, 30.0, 10.0),
                  child: TextField(
                    onChanged: (value) {
                      setState(() {
                        descriptionText = value;
                      });
                    },
                    decoration: InputDecoration(
                      hintText: _getMoodPlaceholder(),
                      border: OutlineInputBorder(
                        borderRadius: BorderRadius.circular(10),
                      ),
                      filled: true,
                      fillColor: Colors.white,
                    ),
                    maxLines: 4,
                  ),
                ),
                Padding(
                  padding: EdgeInsets.fromLTRB(30.0, 0.0, 30.0, 10.0),
                  child: SizedBox(
                    width: 340,
                    height: 60,
                    child: TextButton(
                      onPressed: () {
                        if (_isDescriptionValid()) {
                          // TODO: Implement prayer functionality
                        } else {
                          _showErrorPopup(context);
                        }
                      },
                      style: TextButton.styleFrom(
                        backgroundColor: _getButtonBackgroundColor(),
                      ),
                      child: Text(
                        'Vamos orar pelo seu dia',
                        style: TextStyle(
                          fontSize: 18,
                          fontWeight: FontWeight.bold,
                          color: Color.fromRGBO(245, 237, 220, 1),
                        ),
                      ),
                    ),
                  ),
                ),
              ],
            ),
          ],
        ],
      ),
    );
  }
}
