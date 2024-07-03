import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

import 'package:shared_preferences/shared_preferences.dart';

class SiswaPembayaranKomitePage extends StatefulWidget {
  const SiswaPembayaranKomitePage({super.key});

  @override
  State<SiswaPembayaranKomitePage> createState() =>
      _SiswaPembayaranKomitePageState();
}

class _SiswaPembayaranKomitePageState extends State<SiswaPembayaranKomitePage> {
  List<dynamic> siswaPembayarans = [];

  @override
  void initState() {
    super.initState();
    fetchsiswaPembayaran();
  }

  Future<void> fetchsiswaPembayaran() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    int? userId = prefs.getInt('user_id');
    final response = await http.get(Uri.parse(
        'https://generous-joint-ape.ngrok-free.app/api/pembayaran_siswa/$userId'));
    if (response.statusCode == 200) {
      setState(() {
        siswaPembayarans = json.decode(response.body);
      });
    } else {
      throw Exception('Failed to load nilais');
    }
  }

  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        automaticallyImplyLeading: false,
        backgroundColor: Colors.black,
        title: Text('Pembayaran Komite Anda'),
      ),
      body: siswaPembayarans.isEmpty
          ? Center(child: CircularProgressIndicator())
          : ListView.builder(
              itemCount: siswaPembayarans.length,
              itemBuilder: (context, index) {
                final pembayaran = siswaPembayarans[index];

                return Card(
                  margin: EdgeInsets.all(10.0),
                  child: ExpansionTile(
                    title: Text(
                      pembayaran['bulan'],
                      style: TextStyle(
                        fontWeight: FontWeight.bold,
                        fontSize: 18,
                      ),
                    ),
                    subtitle: Text(pembayaran['tgl_bayar']),
                    children: [
                      Padding(
                        padding: const EdgeInsets.all(15.0),
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Text('Admin: ${pembayaran['nama_pegawai']}'),
                            SizedBox(height: 5),
                            Text('Rp. ${pembayaran['jml_bayar'].toString()}'),
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
