<?php

namespace App\Http\Controllers;

use App\Models\AdminPembayaran;
use App\Models\PembayaranKomite;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranKomiteControllerApi extends Controller
{
    public function index()
    {
        return PembayaranKomite::all();
    }

    public function getPembayaranSiswa(Request $request, $user_id)
    {
        // Ambil user_id dari Request (atau gunakan parameter $user_id secara langsung)
        // Filter pembayaran_komites berdasarkan user_id
    
        $pembayaran = PembayaranKomite::join('siswas', 'pembayaran_komites.nis', '=', 'siswas.nis')
            ->join('users', 'siswas.user_id', '=', 'users.user_id')
            ->join('admin_pembayarans', 'pembayaran_komites.nip_peg_pem', '=', 'admin_pembayarans.nip_peg_pem')
            ->where('users.user_id', $user_id)
            ->select('pembayaran_komites.*', 'admin_pembayarans.nama_pegawai')
            ->get();
    
        return response()->json($pembayaran);
    }
    


    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return PembayaranKomite::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return PembayaranKomite::findOrFail($id);
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
            $PembayaranKomite = PembayaranKomite::findOrFail($id);
            $PembayaranKomite->update($request->all());

            return $PembayaranKomite;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $PembayaranKomite = PembayaranKomite::findOrFail($id);
        $PembayaranKomite->delete();

        return 204;
    }
}
