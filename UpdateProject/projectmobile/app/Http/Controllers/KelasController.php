<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;


class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelass = Kelas::orderBy('nama_kelas', 'asc')->paginate(10);

        foreach ($kelass as $kelas) {
            $jumlahSiswa = Siswa::where('kelas_id', $kelas->kelas_id)->count();
            $kelas->jumlah_siswa = $jumlahSiswa;
        }
        return view('kelas.index', compact('kelass'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData=$request->validate([
            'nama_kelas'=>'required',
        ]);

        Kelas::create($validatedData);
        return redirect('/routeKelas')->with('pesan','Data Berhasil di Simpan');
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
        return view('kelas.edit', [
            'kelas'=>Kelas::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData=$request->validate([
            'nama_kelas'=>'required'
        ]);

        Kelas::where('kelas_id',$id)->update($validatedData);
        return redirect('/routeKelas')->with('pesan','Data Berhasil di Update')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Kelas::destroy($id);
        return redirect('/routeKelas')->with('pesan','Data Berhasil di Hapus');
    }
}
