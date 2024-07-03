<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanControllerApi extends Controller
{
    public function index()
    {
        return Pengumuman::all();
    }

    public function pengumumanForSiswa()
    {
        return Pengumuman::whereIn('penerima', [1, 3])->get();
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
        return Pengumuman::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Pengumuman::findOrFail($id);
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
    { {
            $Pengumuman = Pengumuman::findOrFail($id);
            $Pengumuman->update($request->all());

            return $Pengumuman;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Pengumuman = Pengumuman::findOrFail($id);
        $Pengumuman->delete();

        return 204;
    }
}
