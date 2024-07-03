import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:siakad/ChooseUser.dart';
import 'dart:convert';
import 'package:siakad/components/buttonLogin.dart';
import 'package:siakad/components/textfieldLogin.dart';
import 'package:siakad/navbarGuru.dart';
import 'package:siakad/navbarSiswa.dart';
import 'package:shared_preferences/shared_preferences.dart';


class GuruLoginPage extends StatefulWidget {
  const GuruLoginPage({super.key});

  @override
  State<GuruLoginPage> createState() => _GuruLoginPageState();
}

class _GuruLoginPageState extends State<GuruLoginPage> {
  final usernameController = TextEditingController();
  final passwordController = TextEditingController();

  @override
  void dispose() {
    // Bersihkan controller saat widget dibuang untuk menghindari kebocoran memori
    usernameController.dispose();
    passwordController.dispose();
    super.dispose();
  }

  Future<void> signUserIn(BuildContext context) async {
    final email = usernameController.text;
    final password = passwordController.text;

    final url = Uri.parse(
        'https://generous-joint-ape.ngrok-free.app/api/loginGuru'); // Update with your API URL

    try {
      final response = await http.post(
        url,
        headers: {'Content-Type': 'application/json'},
        body: json.encode({
          'email': email,
          'password': password,
        }),
      );

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        final userId = data['user_id'];
        final token = data['token'];
        // Save userId and token to SharedPreferences
        final prefs = await SharedPreferences.getInstance();
        await prefs.setInt('user_id', userId);
        await prefs.setString('token', token);

        // Navigate to the next page (e.g., Navbar)
        Navigator.push(
          context,
          MaterialPageRoute(
            builder: (context) => NavbarGuru(),
          ),
        );
      } else {
        final data = json.decode(response.body);
        final error = data['error'];
        _showErrorDialog(context, error);
      }
    } catch (e) {
      print('Error during sign in: $e');
      _showErrorDialog(context, 'An error occurred. Please try again.');
    }
  }

  void _showErrorDialog(BuildContext context, String message) {
    showDialog(
      context: context,
      builder: (ctx) => AlertDialog(
        title: Text('Login Failed'),
        content: Text(message),
        actions: [
          TextButton(
            onPressed: () {
              Navigator.of(ctx).pop();
            },
            child: Text('OK'),
          ),
        ],
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.grey[300],
      body: SafeArea(
        child: Center(
          child: Column(
            children: [
              const SizedBox(
                height: 50,
              ),

              //logo
              Image.asset(
                'lib/images/logoSmanli.png',
                width: 150,
                height: 150,
              ),

              const SizedBox(
                height: 30,
              ),

              //greetings
              Text(
                'Welcome Back, Teacher!',
                style: TextStyle(
                  color: Colors.grey[700],
                  fontSize: 18,
                ),
              ),

              const SizedBox(
                height: 25,
              ),

              //username
              TextFieldLogin(
                controller: usernameController,
                hintText: 'Email',
                obscureText: false,
              ),

              const SizedBox(
                height: 10,
              ),

              //password
              TextFieldLogin(
                controller: passwordController,
                hintText: 'Password',
                obscureText: true,
              ),

              const SizedBox(
                height: 10,
              ),

              //forgot-pass
              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 25.0),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.end,
                  children: [
                    Text(
                      'Forgot Password?',
                      style: TextStyle(color: Colors.grey[600]),
                    ),
                  ],
                ),
              ),

              const SizedBox(
                height: 10,
              ),

              //signin button
              ButtonLogin(onTap: () {
                signUserIn(context);
              }),

              const SizedBox(
                height: 10,
              ),

              //register
              const Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Text("Not a Member?"),
                  SizedBox(
                    width: 5,
                  ),
                  Text(
                    "Register Now",
                    style: TextStyle(color: Colors.blue),
                  ),
                ],
              ),
              SizedBox(
                height: 20,
              ),
              GestureDetector(
                onTap: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => ChooseUser()),
                  ); // Kembali ke halaman sebelumnya
                },
                child: Text(
                  "Choose User",
                  style: TextStyle(color: Color.fromARGB(223, 13, 42, 122), fontSize: 17),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}