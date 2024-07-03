<?php

namespace App\Http\Controllers;

use App\Models\JenisKomite;
use Illuminate\Http\Request;

class JenisKomiteControllerApi extends Controller
{
    public function index()
    {
        return JenisKomite::all();
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
        return JenisKomite::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return JenisKomite::findOrFail($id);
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
            $JenisKomite = JenisKomite::findOrFail($id);
            $JenisKomite->update($request->all());
    
            return $JenisKomite;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $JenisKomite = JenisKomite::findOrFail($id);
        $JenisKomite->delete();

        return 204;
    }
}
