import 'dart:async';
import 'package:flutter/material.dart';

//pages
import 'package:z_mobile/drawer.dart';

class SplashScreen extends StatefulWidget {
  const SplashScreen({super.key});

  @override
  SplashScreenState createState() => SplashScreenState();
}

class SplashScreenState extends State<SplashScreen> {
  @override
  void initState() {
    super.initState();
    Timer(const Duration(seconds: 1 /* Adjust to 3 secs when ready */), () {
      Navigator.of(context).pushReplacement(
          MaterialPageRoute(builder: (__) => const App()));
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.green[100],
      body: Center(
          child: SizedBox(
        height: 500,
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            const SizedBox(height: 10),
            Image.asset(
              'assets/images/favicon.ico',
              height: 450,
              width: 450,
            )
          ],
        ),
      )),
    );
  }
}
