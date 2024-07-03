import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

class SiswaPengumumanPage extends StatefulWidget {
  const SiswaPengumumanPage({super.key});

  @override
  State<SiswaPengumumanPage> createState() => _SiswaPengumumanPageState();
}

class _SiswaPengumumanPageState extends State<SiswaPengumumanPage> {
  List<dynamic> pengumumans = [];

  @override
  void initState() {
    super.initState();
    fetchPengumumans();
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

  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        automaticallyImplyLeading: false,
        backgroundColor: Colors.black,
        title: Text('Pengumuman'),
      ),
      body: pengumumans.isEmpty
          ? Center(child: CircularProgressIndicator())
          : ListView.builder(
              itemCount: pengumumans.length,
              itemBuilder: (context, index) {
                final pengumuman = pengumumans[index];
                return Card(
                  margin: EdgeInsets.all(10.0),
                  child: Padding(
                    padding: const EdgeInsets.all(15.0),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          pengumuman['judul'],
                          style: TextStyle(
                            fontWeight: FontWeight.bold,
                            fontSize: 18,
                          ),
                        ),
                        SizedBox(height: 5),
                        Text(pengumuman['deskripsi']),
                      ],
                    ),
                  ),
                );
              },
            ),
    );
  }
}
