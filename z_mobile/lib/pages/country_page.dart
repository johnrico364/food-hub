import 'package:flutter/material.dart';

class CountryPage extends StatefulWidget {
  final String country;

  const CountryPage({
    super.key,
    required this.country,
  });

  @override
  CountryPageState createState() => CountryPageState();
}

class CountryPageState extends State<CountryPage> {
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
          title: Text(
            "${widget.country} Recipes",
            style: const TextStyle(
              fontWeight: FontWeight.bold,
            ),
          ),
        ),
        body: Padding(
          padding: const EdgeInsets.symmetric(horizontal: 18),
          child: Text('Showing recipes from ${widget.country}'),
        ),
      ),
    );
  }
}
