import 'package:flutter/material.dart';
import 'package:curved_navigation_bar/curved_navigation_bar.dart';
import 'package:siakad/Siswa/SiswaHome.dart';
import 'package:siakad/Siswa/SiswaMataPelajaran.dart';
import 'package:siakad/Siswa/SiswaNilai.dart';
import 'package:siakad/Siswa/SiswaPembayaran.dart';
import 'package:siakad/Siswa/SiswaPengumuman.dart';


class NavbarSiswa extends StatefulWidget {
  const NavbarSiswa({Key? key}) : super(key: key);

  @override
  _NavbarState createState() => _NavbarState();
}

class _NavbarState extends State<NavbarSiswa> {
  int _currentIndex = 0;
  final List<Widget> _pages = [
    SiswaHomePage(),
    SiswaMataPelajaranPage(),
    SiswaNilaiPage(),
    SiswaPembayaranKomitePage(),
    SiswaPengumumanPage(),
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
