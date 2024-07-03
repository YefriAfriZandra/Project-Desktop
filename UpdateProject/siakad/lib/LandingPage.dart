import 'package:flutter/material.dart';
import 'package:siakad/ChooseUser.dart';
import 'package:siakad/Siswa/SiswaLogin.dart';

class LandingPage extends StatefulWidget {
  const LandingPage({Key? key}) : super(key: key);

  @override
  State<LandingPage> createState() => _LandingPageState();
}

class _LandingPageState extends State<LandingPage> {
  int _currentIndex = 0;

  final List<String> _images = [
    'lib/images/BGLP1.jpg',
    'lib/images/BGLP2.jpg',
    'lib/images/BGLP3.jpg',
  ];

  final List<String> _texts = [
    "Transformasi Pendidikan dalam Genggaman Anda",
    "Info Akademik Terbaru dan Akurat, Kapan Saja, di Mana Saja",
    "Mudahnya Mengakses Pengumuman dan Data Mahasiswa dengan Satu Sentuhan"
  ];

  void _nextPage() {
    setState(() {
      if (_currentIndex < _images.length - 1) {
        _currentIndex++;
      } else {
        Navigator.push(
          context,
          MaterialPageRoute(builder: (context) => ChooseUser()),
        );
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Stack(
        children: [
          AnimatedSwitcher(
            duration: const Duration(milliseconds: 500),
            child: Container(
              key: ValueKey<int>(_currentIndex),
              decoration: BoxDecoration(
                image: DecorationImage(
                  image: AssetImage(_images[_currentIndex]),
                  fit: BoxFit.cover,
                ),
              ),
            ),
          ),
          Container(
            decoration: BoxDecoration(
              gradient: LinearGradient(
                begin: Alignment.topCenter,
                end: Alignment.bottomCenter,
                colors: [Colors.transparent, Colors.black.withOpacity(0.7)],
              ),
            ),
          ),
          Align(
            alignment: Alignment.center,
            child: Padding(
              padding: const EdgeInsets.symmetric(horizontal: 16.0),
              child: Text(
                _texts[_currentIndex],
                textAlign: TextAlign.center,
                style: const TextStyle(
                  fontSize: 24,
                  color: Color.fromARGB(255, 255, 255, 255),
                  fontWeight: FontWeight.bold,
                ),
              ),
            ),
          ),
          Column(
            mainAxisAlignment: MainAxisAlignment.end,
            children: [
              Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: List.generate(_images.length, (index) {
                  return Container(
                    margin: const EdgeInsets.all(4.0),
                    width: 10.0,
                    height: 10.0,
                    decoration: BoxDecoration(
                      color: _currentIndex == index ? Colors.white : Colors.black,
                      shape: BoxShape.circle,
                    ),
                  );
                }),
              ),
              Padding(
                padding: const EdgeInsets.fromLTRB(20, 20, 20, 30),
                child: SizedBox(
                  width: double.infinity,
                  child: ElevatedButton(
                    onPressed: _nextPage,
                    style: ElevatedButton.styleFrom(
                      padding: const EdgeInsets.symmetric(vertical: 16.0),
                      backgroundColor: Colors.black,
                    ),
                    child: const Text('Next'),
                  ),
                ),
              ),
            ],
          ),
        ],
      ),
    );
  }
}
