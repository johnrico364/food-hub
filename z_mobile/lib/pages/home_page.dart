import 'package:flutter/material.dart';

class HomePage extends StatefulWidget {
  const HomePage({super.key});

  @override
  HomePageState createState() => HomePageState();
}

class HomePageState extends State<HomePage> {
  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 10),
      child: Scaffold(
        appBar: AppBar(
          centerTitle: true,
          leading: IconButton(
            onPressed: () {
              Scaffold.of(context).openDrawer();
            },
            icon: const Icon(
              Icons.menu,
              color: Color.fromARGB(255, 0, 147, 44),
              size: 35,
            ),
            splashColor: Colors.grey,
          ),
          title: const Text(
            "Food Recipes",
            style: TextStyle(
              fontWeight: FontWeight.bold,
            ),
          ),
        ),
        body: const Padding(
        padding: EdgeInsets.symmetric(horizontal: 18),
        child: Text('This is the home page'),
      ),
      ),
    );
  }
}
