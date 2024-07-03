<?php

namespace App\Http\Controllers;

use App\Models\AdminPembayaran;
use Illuminate\Http\Request;

class UserPembayaranControllerApi extends Controller
{
    public function index()
    {
        return AdminPembayaran::all();
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
        return AdminPembayaran::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return AdminPembayaran::findOrFail($id);
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
            $AdminPembayaran = AdminPembayaran::findOrFail($id);
            $AdminPembayaran->update($request->all());
    
            return $AdminPembayaran;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $AdminPembayaran = AdminPembayaran::findOrFail($id);
        $AdminPembayaran->delete();

        return 204;
    }
}
