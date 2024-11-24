import 'package:flutter/material.dart';

// pages
import 'pages/home_page.dart';
import 'pages/country_page.dart';
class App extends StatefulWidget {
  const App({super.key});

  @override
  AppState createState() => AppState();
}

class AppState extends State<App> {
  int _selectedPageIndex = 0;
  String _selectedCountry = '';

  // Modified page list
  List<Widget> get _page => [
    const HomePage(),
    CountryPage(country: _selectedCountry),  // Pass the selected country
  ];

  // Modified _seletePage to accept country parameter
  void _seletePage(int index, [String country = '']) {
    setState(() {
      _selectedPageIndex = index;
      _selectedCountry = country;  // Update selected country
    });

    Future.delayed(const Duration(milliseconds: 500), () {
      if (mounted) {
        Navigator.pop(context);
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: _page[_selectedPageIndex],
      drawer: Drawer(
        child: ListView(
          padding: EdgeInsets.zero,
          children: [
            SizedBox(
              height: 120,
              child: DrawerHeader(
                margin: EdgeInsets.zero,
                padding: EdgeInsets.zero,
                decoration: const BoxDecoration(
                  color: Color.fromARGB(255, 244, 244, 244),
                ),
                child: Center(
                  child: Image.asset(
                    'assets/images/favicon.ico',
                    height: 30,
                  ),
                ),
              ),
            ),
            ListTile(
              leading: const Icon(
                Icons.food_bank_outlined,
                color: Color.fromARGB(255, 0, 147, 44),
                size: 25,
              ),
              title: const Text("Home",
                  style: TextStyle(
                    color: Color.fromARGB(255, 0, 147, 44),
                    fontWeight: FontWeight.bold,
                    fontSize: 16,
                  )),
              onTap: () => _seletePage(0),
              splashColor: const Color.fromARGB(255, 244, 244, 244),
            ),
            ExpansionTile(
              leading: const Icon(
                Icons.language,
                color: Color.fromARGB(255, 0, 147, 44),
                size: 25,
              ),
              title: const Text(
                "Country",
                style: TextStyle(
                  color: Color.fromARGB(255, 0, 147, 44),
                  fontWeight: FontWeight.bold,
                  fontSize: 16,
                ),
              ),
              children: [
                ListTile(
                  contentPadding: const EdgeInsets.only(left: 72),
                  title: const Text(
                    "Philippines",
                    style: TextStyle(
                      fontSize: 16,
                    ),
                  ),
                  onTap: () => _seletePage(1, 'Philippines'),  // Pass country name
                ),
                ListTile(
                  contentPadding: const EdgeInsets.only(left: 72),
                  title: const Text(
                    "Canada",
                    style: TextStyle(
                      fontSize: 16,
                    ),
                  ),
                  onTap: () => _seletePage(1, 'Canada'),  // Pass country name
                ),
              ],
            ),
          ],
        ),
      ),
    );
  }
}
