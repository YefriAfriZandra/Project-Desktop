<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserGuruControllerApi extends Controller
{
    public function index()
    {
        return Guru::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Guru::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Guru::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        {
            $Guru = Guru::findOrFail($id);
            $Guru->update($request->all());
    
            return $Guru;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Guru = Guru::findOrFail($id);
        $Guru->delete();

        return 204;
    }

    public function nowLogin(Request $request)
    {
        $userId = Auth::id(); // Dapatkan ID pengguna yang saat ini diotentikasi
        $guru = Guru::where('user_id', $userId)->firstOrFail(); // Temukan data guru berdasarkan user ID

        return response()->json([
            'nip_guru' => $guru->nip_guru,
            'user_id' => $guru->user_id,
            'nama_guru' => $guru->nama_guru,
            'tgl_lahir' => $guru->tgl_lahir,
            'jenis_kelamin' => $guru->jenis_kelamin,
            'alamat' => $guru->alamat,
            'telp' => $guru->telp,
        ]);
    }
}
