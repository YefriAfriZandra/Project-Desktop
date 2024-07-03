<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\Pelajaran;
use Dotenv\Util\Str;
use Illuminate\Http\Request;

class InputJadwalPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('inputjadwal.index',
            compact('kelas')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $guru = Guru::all();
        $pelajaran = Pelajaran::all();
        $kelas_id = $id;
        return view('inputjadwal.create', compact('guru','pelajaran', 'kelas_id'));
    }

    // public function create(Request $request)
    // {
    //     $kelas = $request->input('kelas_id');
    //     $guru = Guru::all();
    //     $pelajaran = Pelajaran::all();
    //     $kelasRecords = Kelas::all(); // Assuming 'Kelas' is your model for the 'kelas' table
    //     return view('inputjadwal.create', compact('guru','pelajaran','kelas', 'kelasRecords'));
    // }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData=$request->validate([
            'kelas_id'=>'required',
            'hari'=>'required',
            'jam'=>'required',
            'pelajaran_id'=>'required',
        ]);

        JadwalPelajaran::create($validatedData);
        return redirect('/inputjadwalpelajaran')->with('pesan','Data Berhasil di Simpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
