<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class LoginControllerApi extends Controller
{
    public function authenticateSiswa(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek kredensial
        if ($token = auth('api')->attempt($credentials)) {
            $user = auth('api')->user();
            // Cek apakah pengguna memiliki peran 'siswa'
            if ($user->role !== 'siswa') {
                Auth::logout();
                return response()->json([
                    'error' => 'Only students can log in.'
                ], 403);
            }
            $userId = $user->user_id;

            return response()->json([
                'message' => 'Login successful',
                'user_id' => $userId,
                'token' => $token
            ], 200);
        } else {
            // Jika kredensial tidak cocok
            return response()->json([
                'error' => 'The provided credentials do not match our records.'
            ], 401);
        }

        // return $this->respondWithToken($token);
        // if (Auth::attempt($credentials)) {
        // $user = Auth::user();
        // Cek apakah pengguna memiliki peran 'siswa'
        // if ($user->role !== 'siswa') {
        //     Auth::logout();
        //     return response()->json([
        //         'error' => 'Only students can log in.'
        //     ], 403);
        // }

        // Simpan user_id ke dalam session atau variabel
        // $request->session()->put('user_id', $user->id);
        // Untuk API, mungkin lebih baik mengembalikan user_id di response
        //     $userId = $user->id;

        //     return response()->json([
        //         'message' => 'Login successful',
        //         'user_id' => $userId,
        //         // Kamu juga bisa menambahkan data user lain yang diperlukan di sini
        //     ], 200);
        // // }

        // // Jika kredensial tidak cocok
        // return response()->json([
        //     'error' => 'The provided credentials do not match our records.'
        // ], 401);
    }

    public function authenticateGuru(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek kredensial
        if ($token = auth('api')->attempt($credentials)) {
            $user = auth('api')->user();
            // Cek apakah pengguna memiliki peran 'siswa'
            if ($user->role !== 'guru') {
                Auth::logout();
                return response()->json([
                    'error' => 'Only teachers can log in.'
                ], 403);
            }
            $userId = $user->user_id;

            return response()->json([
                'message' => 'Login successful',
                'user_id' => $userId,
                'token' => $token
            ], 200);
        } else {
            // Jika kredensial tidak cocok
            return response()->json([
                'error' => 'The provided credentials do not match our records.'
            ], 401);
        }
    }

    public function logout(Request $request)
{
    try {
        // Mencoba melakukan logout dengan menghapus token yang terkait dengan user saat ini
        auth('api')->logout();

        // Hapus session jika menggunakan session
        // Misalnya, jika Anda menyimpan sesi di database atau tempat lain
        // Contoh: Session::where('user_id', auth('api')->user()->id)->delete();

        return response()->json([
            'message' => 'Logout successful'
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Failed to logout'
        ], 500);
    }
}

    // public function logout(Request $request)
    // {
    //     // Logout pengguna
    //     Auth::logout();

    //     // Invalidate session
    //     $request->session()->invalidate();

    //     // Regenerate token CSRF
    //     $request->session()->regenerateToken();

    //     return response()->json([
    //         'message' => 'Successfully logged out'
    //     ], 200);
    // }

    // Method untuk mendapatkan user_id yang sedang login (jika diperlukan)
    public function getUserId(Request $request)
    {
        return response()->json([
            'user_id' => $request->session()->get('user_id')
        ]);
    }
}
