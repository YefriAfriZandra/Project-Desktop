import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

import 'package:shared_preferences/shared_preferences.dart';

class SiswaNilaiPage extends StatefulWidget {
  const SiswaNilaiPage({super.key});

  @override
  State<SiswaNilaiPage> createState() => _SiswaNilaiPageState();
}

class _SiswaNilaiPageState extends State<SiswaNilaiPage> {
  List<dynamic> nilais = [];

  @override
  void initState() {
    super.initState();
    fetchNilais();
  }

  Future<void> fetchNilais() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    int? userId = prefs.getInt('user_id');
    final response = await http
        .get(Uri.parse('https://generous-joint-ape.ngrok-free.app/api/nilai_siswa/$userId'));
    if (response.statusCode == 200) {
      setState(() {
        nilais = json.decode(response.body);
      });
    } else {
      throw Exception('Failed to load nilais');
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        automaticallyImplyLeading: false,
        backgroundColor: Colors.black,
        title: Text('Nilai Anda'),
      ),
      body: nilais.isEmpty
          ? Center(child: CircularProgressIndicator())
          : ListView.builder(
              itemCount: nilais.length,
              itemBuilder: (context, index) {
                final nilai = nilais[index];

                double nilaiTugas = nilai['nilai_tugas'].toDouble();
                double nilaiUTS = nilai['nilai_uts'].toDouble();
                double nilaiUAS = nilai['nilai_uas'].toDouble();
                double average = (nilaiTugas + nilaiUTS + nilaiUAS) / 3;

                return Card(
                  margin: EdgeInsets.all(10.0),
                  child: ExpansionTile(
                    title: Text(
                      nilai['pelajarans']['nama_pelajaran'],
                      style: TextStyle(
                        fontWeight: FontWeight.bold,
                        fontSize: 18,
                      ),
                    ),
                    subtitle: Text(
                        'Rata-rata Nilai: ${average.toStringAsFixed(2)}'),
                    children: [
                      Padding(
                        padding: const EdgeInsets.all(15.0),
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Text('Nilai Tugas: $nilaiTugas'),
                            SizedBox(height: 5),
                            Text('Nilai UTS: $nilaiUTS'),
                            SizedBox(height: 5),
                            Text('Nilai UAS: $nilaiUAS'),
                          ],
                        ),
                      ),
                    ],
                  ),
                );
              },
            ),
    );
  }
}
