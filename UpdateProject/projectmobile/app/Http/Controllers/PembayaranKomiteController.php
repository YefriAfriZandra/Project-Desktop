<?php

namespace App\Http\Controllers;

use App\Models\AdminPembayaran;
use App\Models\JenisKomite;
use App\Models\PembayaranKomite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranKomiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'pembayaranKomite.index',['pembayarankomite'=>PembayaranKomite::latest()->paginate(10)],
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pembayaranKomite.create', ['jenis_komite'=>JenisKomite::all() ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        $nip_peg_pem = AdminPembayaran::where('user_id', $user->user_id)->value('nip_peg_pem');
        $jenis_komite = JenisKomite::findOrFail($request->jenis_komite_id);
        $biaya_komite = $jenis_komite->biaya;

        $status = ($request->jml_bayar >= $biaya_komite) ? 'lunas' : 'belum';

        $validatedData = $request->validate([
            'nis' => 'required|exists:siswas,nis',
            'jenis_komite_id' => 'required',
            'bulan'=>'required',
            'jml_bayar' => 'required',
            'tgl_bayar' => 'required',
        ]);

        $validatedData['nip_peg_pem'] = $nip_peg_pem;
        $validatedData['status'] = $status;

        PembayaranKomite::create($validatedData);

        return redirect('/pembayaranKomite')->with('pesan', 'Data Berhasil di Simpan');
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
        return view('pembayaranKomite.edit',
            [
                'pembayarankomites'=>PembayaranKomite::find($id),
                'jenis_komite'=>JenisKomite::all(),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();

        $nip_peg_pem = AdminPembayaran::where('user_id', $user->user_id)->value('nip_peg_pem');
        $jenis_komite = JenisKomite::findOrFail($request->jenis_komite_id);
        $biaya_komite = $jenis_komite->biaya;

        $status = ($request->jml_bayar >= $biaya_komite) ? 'lunas' : 'belum';

        $validatedData = $request->validate([
            'nis' => 'required|exists:siswas,nis',
            'jenis_komite_id' => 'required',
            'bulan'=>'required',
            'jml_bayar' => 'required',
            'tgl_bayar' => 'required',
        ]);
        $validatedData['nip_peg_pem'] = $nip_peg_pem;
        $validatedData['status'] = $status;

        PembayaranKomite::where('pembayaran_id',$id)->update($validatedData);
        return redirect('/pembayaranKomite')->with('pesan','Data Berhasil di Update')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PembayaranKomite::destroy($id);
        return redirect('/pembayaranKomite')->with('pesan','Data Berhasil di Hapus');
    }
}
