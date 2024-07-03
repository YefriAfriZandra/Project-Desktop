import 'package:flutter/material.dart';
import 'package:curved_navigation_bar/curved_navigation_bar.dart';
import 'package:siakad/Guru/GuruHome.dart';


class NavbarGuru extends StatefulWidget {
  const NavbarGuru({Key? key}) : super(key: key);

  @override
  _NavbarState createState() => _NavbarState();
}

class _NavbarState extends State<NavbarGuru> {
  int _currentIndex = 0;
  final List<Widget> _pages = [
    GuruHomePage(),
    GuruHomePage(),
    GuruHomePage(),
    GuruHomePage(),
    GuruHomePage(),
  ];

@override
  Widget build(BuildContext context) {
    return Scaffold(
      body: _pages[_currentIndex],
      bottomNavigationBar: CurvedNavigationBar(
        backgroundColor: Color.fromARGB(255, 238, 238, 238),
        height: 55,
        index: _currentIndex,
        items: const [
          Icon(Icons.home_rounded, size: 30),
          Icon(Icons.book, size: 30),
          Icon(Icons.grade, size: 30),
          Icon(Icons.payment, size: 30),
          Icon(Icons.announcement, size: 30),
        ],
        animationDuration: Duration(milliseconds: 500),
        onTap: (index) {
          setState(() {
            _currentIndex = index;
          });
        },
      ),
      
    );
  }
}
