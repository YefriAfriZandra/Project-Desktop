<?php

namespace App\Http\Controllers;

use App\Models\AdminSistem;
use Illuminate\Http\Request;

class UserSistemControllerApi extends Controller
{
    public function index()
    {
        return AdminSistem::all();
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
        return AdminSistem::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return AdminSistem::findOrFail($id);
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
            $AdminSistem = AdminSistem::findOrFail($id);
            $AdminSistem->update($request->all());
    
            return $AdminSistem;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $AdminSistem = AdminSistem::findOrFail($id);
        $AdminSistem->delete();

        return 204;
    }
}
