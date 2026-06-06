import 'package:flutter/material.dart';

class HomePage extends StatefulWidget {
  const HomePage({super.key});

  @override
  State<HomePage> createState() => HomePageState();
}

class HomePageState extends State<HomePage> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SingleChildScrollView(
        child: (Column(
          children: [
            Padding(
              padding: EdgeInsets.fromLTRB(24, 16, 24, 16),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  Icon(
                    Icons.menu_rounded,
                    color: Color.fromRGBO(74, 56, 43, 1),
                  ),
                  Row(
                    children: [
                      Text(
                        'Mini Church ',
                        style: TextStyle(
                          fontWeight: FontWeight.bold,
                          color: Color.fromRGBO(74, 56, 43, 1),
                        ),
                      ),
                      Image.asset('assets/images/ovelhinha.png', width: 20),
                    ],
                  ),
                ],
              ),
            ),

            Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Padding(
                  padding: EdgeInsetsGeometry.all(20),
                  child: (Text(
                    'Pagina Home (principal)',
                    style: TextStyle(
                      color: Color.fromRGBO(74, 56, 43, 1),
                      fontWeight: FontWeight.w900,
                    ),
                  )),
                ),
              ],
            ),

            Padding(
              padding: EdgeInsets.all(8),
              child: Container(
                decoration: BoxDecoration(
                  boxShadow: [
                    BoxShadow(
                      color: Color.fromRGBO(188, 126, 75, 1),
                      blurRadius: 2,
                      blurStyle: BlurStyle.normal,
                    ),
                  ],
                  color: Color.fromRGBO(245, 237, 220, 1),
                  // border: Border.all(
                  //   color: Color.fromRGBO(188, 126, 75, 1),
                  //   width: 2,
                  //   style: BorderStyle.solid,
                  // ),
                  borderRadius: BorderRadius.circular(4),
                ),
                width: 340,
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Padding(
                      padding: EdgeInsets.all(14),
                      child: Text(
                        'Seu testemunho diario foi \narmazenado com sucesso !',
                        style: TextStyle(
                          color: Color.fromRGBO(188, 126, 75, 1),
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                    ),
                    Padding(
                      padding: EdgeInsets.all(10),
                      child: Image.asset('assets/images/bible.png', width: 40),
                    ),
                  ],
                ),
              ),
            ),

            Padding(
              padding: EdgeInsets.all(8),
              child: Container(
                decoration: BoxDecoration(
                  boxShadow: [
                    BoxShadow(
                      color: Color.fromRGBO(188, 126, 75, 1),
                      blurRadius: 2,
                      blurStyle: BlurStyle.normal,
                    ),
                  ],
                  color: Color.fromRGBO(245, 237, 220, 1),
                  borderRadius: BorderRadius.circular(4),
                ),
                width: 340,
                child: Padding(
                  padding: EdgeInsets.all(14),
                  child: Row(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Icon(
                        Icons.star,
                        color: Color.fromRGBO(188, 126, 75, 1),
                        size: 24,
                      ),
                      SizedBox(width: 12),
                      Expanded(
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Text(
                              'Sua oração para o dia de hoje',
                              style: TextStyle(
                                color: Color.fromRGBO(74, 56, 43, 1),
                                fontWeight: FontWeight.bold,
                                fontSize: 15,
                              ),
                            ),
                            SizedBox(height: 8),
                            Text(
                              'Senhor, obrigado por mais este dia. '
                              'Guia meus passos, minhas palavras e meus pensamentos. '
                              'Que eu possa ser luz por onde eu passar e refletir o Teu amor '
                              'em cada atitude. Amém.',
                              style: TextStyle(
                                color: Color.fromRGBO(74, 56, 43, 0.6),
                                fontSize: 13,
                              ),
                            ),
                          ],
                        ),
                      ),
                    ],
                  ),
                ),
              ),
            ),

            Row(
              children: [
                Padding(
                  padding: EdgeInsetsGeometry.fromLTRB(22, 10, 0, 10),
                  child: Text(
                    "Acoes rapidas abaixo: ",
                    style: TextStyle(
                      color: Color.fromRGBO(74, 56, 43, 1),
                      fontWeight: FontWeight.bold,
                      fontSize: 18
                    ),
                  ),
                ),
              ],
            ),

            Padding(
              padding: EdgeInsets.all(8),
              child: Container(
                padding: EdgeInsets.all(16),
                decoration: BoxDecoration(
                  color: Color.fromRGBO(188, 126, 75, 1),
                  borderRadius: BorderRadius.circular(8),
                ),
                width: 340,
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Image.asset('assets/images/cartoon_cross.png', width: 60),
                    Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      textDirection: TextDirection.rtl,
                      children: [
                        Text(
                          'Veja seus relatos semanais',
                          style: TextStyle(
                            color: Color.fromRGBO(245, 237, 220, 1),
                            fontWeight: FontWeight.bold,
                            fontSize: 16,
                          ),
                        ),
                        SizedBox(height: 10),
                        TextButton(
                          onPressed: () {},
                          style: TextButton.styleFrom(
                            padding: EdgeInsets.zero,
                            minimumSize: Size.zero,
                            tapTargetSize: MaterialTapTargetSize.shrinkWrap,
                          ),
                          child: Row(
                            mainAxisAlignment: MainAxisAlignment.end,
                            crossAxisAlignment: CrossAxisAlignment.end,
                            children: [
                              Container(
                                padding: EdgeInsets.fromLTRB(12, 6, 12, 6),
                                decoration: BoxDecoration(
                                  color: Color.fromRGBO(245, 237, 220, 1),
                                  borderRadius: BorderRadius.circular(4),
                                ),
                                child: Row(
                                  mainAxisAlignment: MainAxisAlignment.end,
                                  children: [
                                    Text(
                                      'Ver relatos',
                                      style: TextStyle(
                                        color: Color.fromRGBO(188, 126, 75, 1),
                                        fontWeight: FontWeight.bold,
                                        fontSize: 14,
                                      ),
                                    ),
                                    Icon(
                                      Icons.arrow_forward,
                                      color: Color.fromRGBO(188, 126, 75, 1),
                                      size: 16,
                                    ),
                                  ],
                                ),
                              ),
                            ],
                          ),
                        ),
                      ],
                    ),
                  ],
                ),
              ),
            ),
          ],
        )),
      ),

      backgroundColor: Color.fromRGBO(245, 237, 220, 1),
    );
  }
}
