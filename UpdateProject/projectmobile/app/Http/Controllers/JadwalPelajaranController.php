<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\Pelajaran;
use Illuminate\Http\Request;

class JadwalPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('jadwalpelajaran.index',
            compact('kelas')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $guru = Guru::all();
        $pelajaran = Pelajaran::all();
        return view('jadwalpelajaran.create', compact('guru', 'pelajaran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jadwalPelajaran = JadwalPelajaran::where('kelas_id', $id)->paginate(10);
        $kelas = Kelas::findOrFail($id);
        $pelajaran = Pelajaran::all();
        return view('jadwalpelajaran.satuan', compact('jadwalPelajaran', 'kelas', 'pelajaran'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('jadwalpelajaran.edit',
            [
                'jadwal_pelajarans'=>JadwalPelajaran::find($id),
                'gurus' => Guru::all(),
                'pelajarans' => Pelajaran::all()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData=$request->validate([
            'hari'=>'required',
            'jam'=>'required',
            'pelajaran_id'=>'required',
        ]);

        JadwalPelajaran::where('jadwal_pelajaran_id',$id)->update($validatedData);
        return redirect('/jadwalpelajaran')->with('pesan','Data Berhasil di Update')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        JadwalPelajaran::destroy($id);
        return redirect('/jadwalpelajaran')->with('pesan','Data Berhasil di Hapus');
    }
}
