import 'package:flutter/material.dart';
import 'package:mini_church/words.dart';

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
      case 'sad':
        return 'O seu dia foi ruim 😢';
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
          Row(
            children: [
              Align(
                alignment: Alignment.centerLeft,
                child: Padding(
                  padding: EdgeInsetsGeometry.fromLTRB(0, 10, 0, 30),
                  child: Column(
                    children: [
                      Text(
                        'Como foi o \nseu dia ?',
                        style: TextStyle(
                          fontSize: 28,
                          fontWeight: FontWeight.w600,
                          color: Color.fromRGBO(74, 56, 43, 1),
                          height: 1.15,
                        ),
                        textAlign: TextAlign.left,
                      ),
                      Container(
                        alignment: Alignment.centerLeft,
                        child: Padding(
                          padding: EdgeInsetsGeometry.fromLTRB(20, 10, 0, 0),
                          child: Text(
                            'Toque em uma das carinhas para continuar',
                            style: TextStyle(
                              fontSize: 8,
                              color: Color.fromRGBO(80, 80, 80, 1),
                            ),
                          ),
                        ),
                      ),
                    ],
                  ),
                ),
              ),
              Image.asset(
                'assets/images/cross_image.png',
                width: 190,
                height: 150,
                fit: BoxFit.contain,
              ),
            ],
          ),
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceEvenly,
            children: [
              GestureDetector(
                onTap: () {
                  setState(() {
                    selectedHumor = 'happy';
                  });
                },
                child: Container(
                  decoration: BoxDecoration(
                    border: Border.all(
                      color: selectedHumor == 'happy'
                          ? Colors.lightGreen
                          : Color.fromRGBO(211, 176, 146, 1),
                      width: 1,
                    ),
                    borderRadius: BorderRadius.circular(5),
                  ),
                  child: Padding(
                    padding: EdgeInsetsGeometry.symmetric(
                      horizontal: 20,
                      vertical: 20,
                    ),
                    child: Column(
                      children: [
                        selectedHumor == 'happy'
                            ? Image.asset(
                                'assets/images/happiness.png',
                                width: 30,
                                height: 30,
                              )
                            : Image.asset(
                                'assets/images/happiness_gray.png',
                                width: 30,
                                height: 30,
                              ),
                        Padding(
                          padding: EdgeInsetsGeometry.fromLTRB(0, 10, 0, 0),
                          child: Text(
                            "Otimo",
                            style: TextStyle(
                              color: selectedHumor == 'happy'
                                  ? Colors.lightGreen
                                  : Color.fromRGBO(211, 176, 146, 1),
                              fontSize: 16,
                              fontWeight: FontWeight.bold,
                            ),
                            textAlign: TextAlign.center,
                          ),
                        ),
                        Text(
                          "Foi um dia\nmuito bom.",
                          style: TextStyle(color: Colors.grey, fontSize: 10),
                          textAlign: TextAlign.center,
                        ),
                      ],
                    ),
                  ),
                ),
              ),
              GestureDetector(
                onTap: () {
                  setState(() {
                    selectedHumor = 'neutral';
                  });
                },
                child: Container(
                  decoration: BoxDecoration(
                    border: Border.all(
                      color: selectedHumor == 'neutral'
                          ? Colors.orangeAccent
                          : Color.fromRGBO(211, 176, 146, 1),
                      width: 1,
                    ),
                    borderRadius: BorderRadius.circular(5),
                  ),
                  child: Padding(
                    padding: EdgeInsetsGeometry.symmetric(
                      horizontal: 20,
                      vertical: 20,
                    ),
                    child: Column(
                      children: [
                        selectedHumor == 'neutral'
                            ? Image.asset(
                                'assets/images/neutral.png',
                                width: 30,
                                height: 30,
                              )
                            : Image.asset(
                                'assets/images/neutral_gray.png',
                                width: 30,
                                height: 30,
                              ),
                        Padding(
                          padding: EdgeInsetsGeometry.fromLTRB(0, 10, 0, 0),
                          child: Text(
                            "Neutro",
                            style: TextStyle(
                              color: selectedHumor == 'neutral'
                                  ? Colors.orangeAccent
                                  : Color.fromRGBO(211, 176, 146, 1),
                              fontSize: 16,
                              fontWeight: FontWeight.bold,
                            ),
                            textAlign: TextAlign.center,
                          ),
                        ),
                        Text(
                          "Foi um dia\nbem normal.",
                          style: TextStyle(color: Colors.grey, fontSize: 10),
                          textAlign: TextAlign.center,
                        ),
                      ],
                    ),
                  ),
                ),
              ),
              GestureDetector(
                onTap: () {
                  setState(() {
                    selectedHumor = 'sad';
                  });
                },
                child: Container(
                  decoration: BoxDecoration(
                    border: Border.all(
                      color: selectedHumor == 'sad'
                          ? Colors.redAccent
                          : Color.fromRGBO(211, 176, 146, 1),
                      width: 1,
                    ),
                    borderRadius: BorderRadius.circular(5),
                  ),
                  child: Padding(
                    padding: EdgeInsetsGeometry.symmetric(
                      horizontal: 20,
                      vertical: 20,
                    ),
                    child: Column(
                      children: [
                        selectedHumor == 'sad'
                            ? Image.asset(
                                'assets/images/saddiest.png',
                                width: 30,
                                height: 30,
                              )
                            : Image.asset(
                                'assets/images/saddiest_gray.png',
                                width: 30,
                                height: 30,
                              ),
                        Padding(
                          padding: EdgeInsetsGeometry.fromLTRB(0, 10, 0, 0),
                          child: Text(
                            "Dificil",
                            style: TextStyle(
                              color: selectedHumor == 'sad'
                                  ? Colors.redAccent
                                  : Color.fromRGBO(211, 176, 146, 1),
                              fontSize: 16,
                              fontWeight: FontWeight.bold,
                            ),
                            textAlign: TextAlign.center,
                          ),
                        ),
                        Text(
                          "Foi um dia\nbem dificil.",
                          style: TextStyle(color: Colors.grey, fontSize: 10),
                          textAlign: TextAlign.center,
                        ),
                      ],
                    ),
                  ),
                ),
              ),
            ],
          ),
          if (selectedHumor.isNotEmpty) ...[
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Padding(
                  padding: EdgeInsets.fromLTRB(25.0, 20.0, 22.0, 10.0),
                  child: Container(
                    decoration: BoxDecoration(
                      border: Border.all(
                        color: Color.fromRGBO(211, 176, 146, 1),
                      ),
                      borderRadius: BorderRadius.circular(5),
                    ),
                    child: Padding(
                      padding: EdgeInsets.all(8.0),
                      child: Row(
                        children: [
                          Padding(
                            padding: EdgeInsets.fromLTRB(0, 0, 8.0, 0),
                            child: Icon(
                              Icons.stars,
                              color: Color.fromRGBO(188, 126, 75, 1),
                              size: 24,
                            ),
                          ),
                          Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(
                                _getMoodDescription(),
                                style: TextStyle(
                                  fontSize: 14,
                                  fontWeight: FontWeight.bold,
                                  color: Color.fromRGBO(74, 56, 43, 1),
                                ),
                                textAlign: TextAlign.left,
                              ),
                              Text(
                                selectedHumor == 'happy'
                                    ? "Quandos estamos na presenha de nosso Senhor, \ntodo dia eh um bom dia"
                                    : selectedHumor == 'neutral'
                                    ? "Bem... Todos temos dias mais paradao, \nporem vamos buscar o nosso Senhor todos os dias"
                                    : "As vezes o nosso Pai celestial coloca barreiras \nem nossas vidas para nos tornar-mos mais fortes,\n em corpo e em espirito",
                                style: TextStyle(
                                  fontSize: 10,
                                  color: Colors.grey,
                                ),
                                overflow: TextOverflow.ellipsis,
                                maxLines: 2,
                              ),
                            ],
                          ),
                        ],
                      ),
                    ),
                  ),
                ),
                Padding(
                  padding: EdgeInsets.fromLTRB(30.0, 0.0, 0.0, 5.0),
                  child: Text(
                    'Descreva como foi o seu dia: ',
                    style: TextStyle(
                      fontSize: 14,
                      fontWeight: FontWeight.bold,
                      color: Color.fromRGBO(74, 56, 43, 1),
                    ),
                  ),
                ),
                Padding(
                  padding: EdgeInsets.fromLTRB(25.0, 0.0, 30.0, 10.0),
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
                      fillColor: Color.fromRGBO(245, 237, 220, 1),
                    ),
                    maxLines: 4,
                  ),
                ),
                Padding(
                  padding: EdgeInsets.fromLTRB(30.0, 0.0, 30.0, 10.0),
                  child: SizedBox(
                    width: 340,
                    height: 40,
                    child: TextButton(
                      onPressed: () {
                        if (_isDescriptionValid()) {
                          Navigator.push(
                            context,
                            MaterialPageRoute(builder: (context) => Words()),
                          );
                        } else {
                          // _showErrorPopup(context);
                          Navigator.push(
                            context,
                            MaterialPageRoute(builder: (context) => Words()),
                          );
                        }
                      },
                      style: TextButton.styleFrom(
                        backgroundColor: _getButtonBackgroundColor(),
                      ),
                      child: Text(
                        'Vamos orar pelo seu dia',
                        style: TextStyle(
                          fontSize: 12,
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
