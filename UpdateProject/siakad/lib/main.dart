import 'package:flutter/material.dart';
import 'package:siakad/LandingPage.dart';
import 'package:siakad/Siswa/SiswaHome.dart';
import 'package:siakad/Siswa/SiswaLogin.dart';
import 'package:siakad/navbarSiswa.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      // home: SiswaLoginPage(),
      home: LandingPage(),
      //  home:  Navbar(),
    );
  }
}

