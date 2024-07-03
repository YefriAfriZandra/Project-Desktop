<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa; // Pastikan Anda telah mengimpor model Siswa

class HomeControllerApi extends Controller
{
    public function getNamaSiswa(Request $request, $user_id)
    {
        // Dapatkan nama_siswa berdasarkan user_id
        $siswa = Siswa::where('user_id', $user_id)->first();

        // if ($siswa) {
            return response()->json($siswa);
        // } else {
            // return response()->json(['message' => 'User not found'], 404);
        // }
    }
}
