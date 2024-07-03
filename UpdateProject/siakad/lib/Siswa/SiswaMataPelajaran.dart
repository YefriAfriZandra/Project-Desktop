import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

import 'package:shared_preferences/shared_preferences.dart';

class SiswaMataPelajaranPage extends StatefulWidget {
  const SiswaMataPelajaranPage({Key? key}) : super(key: key);

  @override
  State<SiswaMataPelajaranPage> createState() => _SiswaMataPelajaranPageState();
}

class _SiswaMataPelajaranPageState extends State<SiswaMataPelajaranPage> {
  late Map<String, List<dynamic>> mapelHari;

  @override
  void initState() {
    super.initState();
    mapelHari = {
      'Senin': [],
      'Selasa': [],
      'Rabu': [],
      'Kamis': [],
      'Jumat': [],
      'Sabtu': [],
    };
    fetchJadwalMapel();
  }

  Future<void> fetchJadwalMapel() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    int? userId = prefs.getInt('user_id');

    for (var hari in mapelHari.keys) {
      final response = await http.get(Uri.parse(
          'https://generous-joint-ape.ngrok-free.app/api/mapel-$hari/$userId'));
      if (response.statusCode == 200) {
        setState(() {
          mapelHari[hari] = json.decode(response.body);
        });
      } else {
        throw Exception('Failed to load mapel $hari');
      }
    }
  }

  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        automaticallyImplyLeading: false,
        backgroundColor: Colors.black,
        title: Text("Mata Pelajaran Anda"),
      ),
      body: ListView(
        children: mapelHari.entries
            .map((entry) => _buildHariColumn(entry.key, entry.value))
            .toList(),
      ),
    );
  }

  Widget _buildHariColumn(String hari, List<dynamic> mapelList) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.center,
      children: [
        Padding(
          padding: const EdgeInsets.all(10.0),
          child: Text(
            hari,
            style: TextStyle(
              fontSize: 20,
              fontWeight: FontWeight.bold,
            ),
          ),
        ),
        Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: mapelList
              .map((jadwal) => Card(
                    margin: EdgeInsets.all(3.0),
                    child: Padding(
                      padding: const EdgeInsets.all(15.0),
                      child: SizedBox(
                        width: double.infinity,
                        child: Text(
                          jadwal['pelajaran']['nama_pelajaran'],
                          style: TextStyle(
                            fontWeight: FontWeight.bold,
                            fontSize: 18,
                          ),
                        ),
                      ),
                    ),
                  ))
              .toList(),
        ),
      ],
    );
  }
}
