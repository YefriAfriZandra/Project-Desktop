<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;

class NilaiControllerApi extends Controller
{
    // public function index()
    // {
    //     return Nilai::all();
    // }

    public function index(Request $request)
    {
        $userId = $request->query('user_id');

        if ($userId) {
            $siswa = Siswa::where('user_id', $userId)->first();
            if ($siswa) {
                return Nilai::with('pelajarans')->where('nis', $siswa->nis)->get();
            } else {
                return response()->json(['message' => 'Siswa not found'], 404);
            }
        }

        return Nilai::with('pelajarans')->get();
    }

    public function getNilai(Request $request, $user_id)
    {
        $siswa = Siswa::where('user_id', $user_id)->first();

        if ($siswa) {
            $nilaiSiswa = Nilai::with('pelajarans')->where('nis', $siswa->nis)->get();
            return response()->json($nilaiSiswa);
        } else {
            return response()->json(['message' => 'Siswa not found'], 404);
        }
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
        return Nilai::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Nilai::findOrFail($id);
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
            $Nilai = Nilai::findOrFail($id);
            $Nilai->update($request->all());
    
            return $Nilai;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Nilai = Nilai::findOrFail($id);
        $Nilai->delete();

        return 204;
    }
}
