<?php

namespace App\Http\Controllers;

use App\Models\JenisKomite;
use Illuminate\Http\Request;

class JenisKomiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'jeniskomite.index',['jenis_komites'=>JenisKomite::latest()->paginate(10)],
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jeniskomite.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData=$request->validate([
            'type'=>'required',
            'deskripsi'=>'required',
            'biaya'=>'required',
        ]);

        JenisKomite::create($validatedData);
        return redirect('/jenisKomite')->with('pesan','Data Berhasil di Simpan');
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
        return view('jeniskomite.edit',
            [
                'jenis_komites'=>JenisKomite::find($id),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData=$request->validate([
            'type'=>'required',
            'deskripsi'=>'required',
            'biaya'=>'required',
        ]);

        JenisKomite::where('jenis_komite_id',$id)->update($validatedData);
        return redirect('/jenisKomite')->with('pesan','Data Berhasil di Update')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        JenisKomite::destroy($id);
        return redirect('/jenisKomite')->with('pesan','Data Berhasil di Hapus');
    }
}
