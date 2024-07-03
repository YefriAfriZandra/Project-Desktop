import 'package:flutter/material.dart';
import 'package:carousel_slider/carousel_slider.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:siakad/ChooseUser.dart';
import 'package:siakad/LandingPage.dart';

class SiswaHomePage extends StatefulWidget {
  const SiswaHomePage({Key? key}) : super(key: key);

  @override
  _SiswaHomePageState createState() => _SiswaHomePageState();
}

class _SiswaHomePageState extends State<SiswaHomePage> {
  List<dynamic> pengumumans = [];
  Map<String, dynamic> siswa = {};

  @override
  void initState() {
    super.initState();
    fetchPengumumans();
    loadSiswa();
  }

  Future<void> loadSiswa() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    int? userId = prefs.getInt('user_id');

    if (userId != null) {
      var response = await http.get(Uri.parse(
          'https://generous-joint-ape.ngrok-free.app/api/nama_siswa/$userId'));

      if (response.statusCode == 200) {
        setState(() {
          siswa = json.decode(response.body);
        });
      } else {
        // Handle error
      }
    } else {
      // Handle user ID not found in SharedPreferences
    }
  }

  Future<void> fetchPengumumans() async {
    final response = await http.get(Uri.parse(
        'https://generous-joint-ape.ngrok-free.app/api/pengumumanForSiswa'));
    if (response.statusCode == 200) {
      setState(() {
        pengumumans = json.decode(response.body);
      });
    } else {
      throw Exception('Failed to load pengumumans');
    }
  }

  Future<void> logout() async {
    final SharedPreferences prefs = await SharedPreferences.getInstance();
    await prefs.remove('user_id');
    await prefs.remove('token');
    print('User ID dan Token telah dihapus.');
  }
//   Future<void> logout() async {
//   try {
//     final response = await http.post(
//       Uri.parse('https://generous-joint-ape.ngrok-free.app/api/logout'),
//       headers: <String, String>{
//         'Content-Type': 'application/json; charset=UTF-8',
//       },
//     );

//     if (response.statusCode == 200) {
//       SharedPreferences prefs = await SharedPreferences.getInstance();
//       await prefs.clear(); // Menghapus semua data di SharedPreferences
//       Navigator.pushAndRemoveUntil(
//         context,
//         MaterialPageRoute(builder: (BuildContext context) => LandingPage()),
//         (route) => false,
//       );
//     } else {
//       // Cetak pesan error dari server jika tersedia
//       print('Failed to logout: ${response.body}');
//       throw Exception('Failed to logout');
//     }
//   } catch (e) {
//     print('Error: $e');
//     // Handle error
//   }
// }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.black,
        automaticallyImplyLeading: false,
        title: Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: <Widget>[
            Text(siswa.isNotEmpty ? siswa['nama_siswa'] : 'Nama Siswa'),
            // CircleAvatar(
            //   backgroundImage: NetworkImage(
            //     siswa.isNotEmpty
            //         ? 'https://generous-joint-ape.ngrok-free.app/images/${siswa['foto_siswa']}'
            //         : 'https://static.vecteezy.com/system/resources/previews/005/005/788/original/user-icon-in-trendy-flat-style-isolated-on-grey-background-user-symbol-for-your-web-site-design-logo-app-ui-illustration-eps10-free-vector.jpg',
            //   ),
            //   backgroundColor: Colors.transparent,
            //   radius: 20,
            // ),
          ],
        ),
        actions: [
          IconButton(
              onPressed: () {
                logout();
                Navigator.push(
                  context,
                  MaterialPageRoute(
                    builder: (context) => ChooseUser(),
                  ),
                );
              },
              icon: Icon(Icons.logout))
        ],
      ),
      body: SafeArea(
        child: SingleChildScrollView(
          child: Column(
            children: <Widget>[
              SizedBox(
                  height: 10), // Tambahkan sedikit ruang di atas CarouselSlider
              pengumumans.isNotEmpty
                  ? CarouselSlider(
                      options: CarouselOptions(
                        height: 200.0,
                        autoPlay: true,
                        enlargeCenterPage: true,
                      ),
                      items: pengumumans.map((announcement) {
                        return Builder(
                          builder: (BuildContext context) {
                            return Container(
                              width: MediaQuery.of(context).size.width,
                              margin: EdgeInsets.symmetric(horizontal: 10.0),
                              decoration: BoxDecoration(
                                image: const DecorationImage(
                                  image:
                                      AssetImage('lib/images/BGpengumuman.jpg'),
                                  fit: BoxFit.cover,
                                ),
                                borderRadius: BorderRadius.circular(10.0),
                                boxShadow: [
                                  BoxShadow(
                                    color: const Color.fromARGB(255, 65, 65, 65)
                                        .withOpacity(0.3),
                                    spreadRadius: 2,
                                    blurRadius: 5,
                                    offset: Offset(-5, 0),
                                  ),
                                ],
                              ),
                              child: Column(
                                mainAxisAlignment: MainAxisAlignment.center,
                                children: [
                                  Text(
                                    announcement['judul'],
                                    style: const TextStyle(
                                      fontSize: 20.0,
                                      color: Color.fromARGB(255, 255, 255, 255),
                                    ),
                                    textAlign: TextAlign.center,
                                  ),
                                  SizedBox(height: 10),
                                  Text(
                                    announcement['deskripsi'],
                                    style: const TextStyle(
                                      fontSize: 15.0,
                                      color: Color.fromARGB(255, 255, 255, 255),
                                    ),
                                    textAlign: TextAlign.center,
                                  ),
                                  SizedBox(height: 10),
                                  Text(
                                    '${announcement['tgl_awal']} - ${announcement['tgl_akhir']}',
                                    style: const TextStyle(
                                      fontSize: 10.0,
                                      color: Color.fromARGB(255, 255, 255, 255),
                                    ),
                                    textAlign: TextAlign.center,
                                  ),
                                ],
                              ),
                            );
                          },
                        );
                      }).toList(),
                    )
                  : const CircularProgressIndicator(),
              Padding(
                padding: const EdgeInsets.fromLTRB(30, 40, 20, 30),
                child: GridView(
                  shrinkWrap: true,
                  physics: const NeverScrollableScrollPhysics(),
                  gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
                    crossAxisCount: 2,
                    mainAxisSpacing: 10.0,
                    crossAxisSpacing: 10.0,
                  ),
                  children: [
                    GestureDetector(
                      onTap: () {
                        // Navigate to Mata Pelajaran page
                      },
                      child: Container(
                        decoration: BoxDecoration(
                          color: Color.fromARGB(255, 60, 97, 165),
                          borderRadius: BorderRadius.circular(10.0),
                          boxShadow: [
                            BoxShadow(
                              color: Colors.black.withOpacity(0.3),
                              spreadRadius: 2,
                              blurRadius: 5,
                              offset: Offset(-5, 3),
                            ),
                          ],
                        ),
                        child: const Center(
                          child: Column(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: <Widget>[
                              Icon(
                                Icons.book,
                                color: Colors.white,
                                size: 40.0,
                              ),
                              SizedBox(height: 10.0),
                              Text(
                                'Mata Pelajaran',
                                style: TextStyle(color: Colors.white),
                              ),
                            ],
                          ),
                        ),
                      ),
                    ),
                    GestureDetector(
                      onTap: () {
                        // Navigate to Nilai page
                      },
                      child: Container(
                        decoration: BoxDecoration(
                          color: const Color.fromARGB(255, 60, 97, 165),
                          borderRadius: BorderRadius.circular(10.0),
                          boxShadow: [
                            BoxShadow(
                              color: Colors.black.withOpacity(0.3),
                              spreadRadius: 2,
                              blurRadius: 5,
                              offset: Offset(-5, 3),
                            ),
                          ],
                        ),
                        child: const Center(
                          child: Column(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: <Widget>[
                              Icon(
                                Icons.grade,
                                color: Colors.white,
                                size: 40.0,
                              ),
                              SizedBox(height: 10.0),
                              Text(
                                'Nilai',
                                style: TextStyle(color: Colors.white),
                              ),
                            ],
                          ),
                        ),
                      ),
                    ),
                    GestureDetector(
                      onTap: () {
                        // Navigate to Pengumuman page
                      },
                      child: Container(
                        decoration: BoxDecoration(
                          color: Color.fromARGB(255, 60, 97, 165),
                          borderRadius: BorderRadius.circular(10.0),
                          boxShadow: [
                            BoxShadow(
                              color: Colors.black.withOpacity(0.3),
                              spreadRadius: 2,
                              blurRadius: 5,
                              offset: Offset(-5, 3),
                            ),
                          ],
                        ),
                        child: const Center(
                          child: Column(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: <Widget>[
                              Icon(
                                Icons.announcement,
                                color: Colors.white,
                                size: 40.0,
                              ),
                              SizedBox(height: 10.0),
                              Text(
                                'Pengumuman',
                                style: TextStyle(color: Colors.white),
                              ),
                            ],
                          ),
                        ),
                      ),
                    ),
                    GestureDetector(
                      onTap: () {
                        // Navigate to Pembayaran Komite page
                      },
                      child: Container(
                        decoration: BoxDecoration(
                          color: Color.fromARGB(255, 60, 97, 165),
                          borderRadius: BorderRadius.circular(10.0),
                          boxShadow: [
                            BoxShadow(
                              color: Colors.black.withOpacity(0.3),
                              spreadRadius: 2,
                              blurRadius: 5,
                              offset: Offset(-5, 3),
                            ),
                          ],
                        ),
                        child: const Center(
                          child: Column(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: <Widget>[
                              Icon(
                                Icons.payment,
                                color: Colors.white,
                                size: 40.0,
                              ),
                              SizedBox(height: 10.0),
                              Text(
                                'Pembayaran Komite',
                                style: TextStyle(color: Colors.white),
                              ),
                            ],
                          ),
                        ),
                      ),
                    ),
                  ],
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
