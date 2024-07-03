<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Pelajaran;
use App\Models\Siswa;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'nilai.index',['nilais'=>Nilai::latest()->paginate(10)],
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('nilai.create',
        [
            'siswas'=>Siswa::all(),
            'pelajarans'=>Pelajaran::all(),       
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData=$request->validate([
            'nis'=>'required',
            'pelajaran_id'=>'required',
            'nilai_tugas'=>'required',
            'nilai_uts'=>'required',
            'nilai_uas'=>'required',
            'nilai_kepribadian'=>'required',
            'sakit'=>'required',
            'alfa'=>'required',
            'izin'=>'required',
        ]);

        Nilai::create($validatedData);
        return redirect('/nilai')->with('pesan','Data Berhasil di Simpan');
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
        return view('nilai.edit',
            [
                'nilais'=>Nilai::find($id),
                'siswas'=>Siswa::all(),
                'pelajarans'=>Pelajaran::all(),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData=$request->validate([
            'nis'=>'required',
            'pelajaran_id'=>'required',
            'nilai_tugas'=>'required',
            'nilai_uts'=>'required',
            'nilai_uas'=>'required',
            'nilai_kepribadian'=>'required',
            'sakit'=>'required',
            'alfa'=>'required',
            'izin'=>'required',
        ]);

        Nilai::where('nilai_id',$id)->update($validatedData);
        return redirect('/nilai')->with('pesan','Data Berhasil di Update')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Nilai::destroy($id);
        return redirect('/nilai')->with('pesan','Data Berhasil di Hapus');
    }
}
