import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:siakad/ChooseUser.dart';

class GuruHomePage extends StatefulWidget {
  const GuruHomePage({super.key});

  @override
  State<GuruHomePage> createState() => _GuruHomePageState();
}

Future<void> logout() async {
  final SharedPreferences prefs = await SharedPreferences.getInstance();
  await prefs.remove('user_id');
  await prefs.remove('token');
  print('User ID dan Token telah dihapus.');
}

class _GuruHomePageState extends State<GuruHomePage> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        automaticallyImplyLeading: false,
        title: Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: <Widget>[
            Text("Nama Guru")
            // Text(siswa.isNotEmpty ? siswa['nama_siswa'] : 'Nama Siswa'),
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
    );
  }
}
