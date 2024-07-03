<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Pelajaran;
use Illuminate\Http\Request;

class PelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'pelajaran.index',['pelajarans'=>Pelajaran::latest()->paginate(10)],
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pelajaran.create',
        [
            // 'pelajarans'=>Pelajaran::find($id),
            'gurus'=>Guru::all(),       
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData=$request->validate([
            'nip_guru'=>'required',
            'nama_pelajaran'=>'required',
        ]);

        Pelajaran::create($validatedData);
        return redirect('/pelajaran')->with('pesan','Data Berhasil di Simpan');
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
        return view('pelajaran.edit',
            [
                'pelajarans'=>Pelajaran::find($id),
                'gurus'=>Guru::all(),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData=$request->validate([
            'guru'=>'required',
            'nama_pelajaran'=>'required'
        ]);

        Pelajaran::where('pelajaran_id',$id)->update($validatedData);
        return redirect('/pelajaran')->with('pesan','Data Berhasil di Update')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pelajaran::destroy($id);
        return redirect('/pelajaran')->with('pesan','Data Berhasil di Hapus');
    }
}
