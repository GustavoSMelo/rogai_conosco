import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'describe.dart';

void main() {
  WidgetsFlutterBinding.ensureInitialized();
  SystemChrome.setEnabledSystemUIMode(
    SystemUiMode.manual,
    overlays: [SystemUiOverlay.bottom],
  );
  SystemChrome.setSystemUIOverlayStyle(SystemUiOverlayStyle.light);
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(
          seedColor: Color.fromRGBO(188, 126, 75, 1),
        ),
      ),
      home: const MyHomePage(),
    );
  }
}

class MyHomePage extends StatefulWidget {
  const MyHomePage({super.key});
  @override
  State<MyHomePage> createState() => _MyHomePageState();
}

class _MyHomePageState extends State<MyHomePage> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Color.fromRGBO(245, 237, 220, 1),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.start,
          children: [
            Padding(
              padding: EdgeInsetsGeometry.fromLTRB(0, 90, 0, 0),
              child: Image.asset('assets/images/ovelhinha.png', width: 100),
            ),
            Text(
              'Mini Church',
              style: TextStyle(
                fontSize: 32,
                fontWeight: FontWeight.bold,
                color: Color.fromRGBO(74, 56, 43, 1),
              ),
            ),
            const SizedBox(height: 8),
            Text(
              'Encontre Deus no seu dia a dia',
              style: TextStyle(
                fontSize: 16,
                color: Color.fromRGBO(74, 56, 43, 1),
              ),
            ),
            const Spacer(),
            SizedBox(
              width: 320,
              child: Padding(
                padding: const EdgeInsets.only(bottom: 20),
                child: Text(
                  'Joao 3:16 - Deus amou tanto o mundo que deu o seu único Filho, para que todo aquele que nele crê não se perca, mas tenha a vida eterna.',
                  textAlign: TextAlign.center,
                  style: TextStyle(
                    fontSize: 14,
                    color: Color.fromRGBO(74, 56, 43, 1),
                  ),
                ),
              ),
            ),
            SizedBox(
              width: 230,
              height: 50,
              child: TextButton(
                onPressed: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => DescribePage()),
                  );
                },
                style: TextButton.styleFrom(
                  backgroundColor: Color.fromRGBO(188, 126, 75, 1),
                ),
                child: Text(
                  'Avancar',
                  style: TextStyle(
                    fontSize: 18,
                    fontWeight: FontWeight.bold,
                    color: Color.fromRGBO(245, 237, 220, 1),
                  ),
                ),
              ),
            ),
            const SizedBox(height: 75),
          ],
        ),
      ),
    );
  }
}
