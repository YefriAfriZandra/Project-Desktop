<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'pengumuman.index',
            ['pengumumans' => Pengumuman::latest()->paginate(10)],
        );
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pengumuman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            // 'user_id'=>'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'penerima' => 'required',
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required',
        ]);
        $validatedData['user_id'] = auth()->user()->user_id;

        Pengumuman::create($validatedData);
        return redirect('/pengumuman')->with('pesan', 'Data Berhasil di Simpan');
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
        return view(
            'pengumuman.edit',
            [
                'pengumumans' => Pengumuman::find($id),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'penerima' => 'required',
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required',
        ]);
        $validatedData['user_id'] = auth()->user()->user_id;

        Pengumuman::where('pengumuman_id', $id)->update($validatedData);
        return redirect('/pengumuman')->with('pesan', 'Data Berhasil di Update')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pengumuman::destroy($id);
        return redirect('/pengumuman')->with('pesan', 'Data Berhasil di Hapus');
    }
}
