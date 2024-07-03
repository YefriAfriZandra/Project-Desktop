<?php

namespace App\Http\Controllers;

use App\Models\AdminPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserPembayaranController extends Controller
{
    public function index()
    {
        return view('usersPembayaran.index',[
            'admin_pembayarans'=>AdminPembayaran::latest()->paginate(10)
        ],
        );
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $admin_pembayarans = AdminPembayaran::where('nip_peg_pem', 'like', "%{$searchTerm}%")
                        ->orWhere('nama_pegawai', 'like', "%{$searchTerm}%")
                        ->paginate(10);

        return view('usersPembayaran.index', [
            'admin_pembayarans' => $admin_pembayarans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usersPembayaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nip_peg_pem'=>'required|unique:admin_pembayarans',
            'nama_pegawai'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'tgl_lahir'=>'required|date',
            'jenis_kelamin'=>'required',
            'alamat'=>'required',
            'telp'=>'required',
            'foto_adm'=>'required',
        ]);

        if ($request->hasFile('foto_adm')) {
            $foto = $request->file('foto_adm');
            $namaFile = 'img_' . time() . '_' . $foto->getClientOriginalName();
            $foto->move('images', $namaFile);
        } else {
            $namaFile = 'img_default.png';
        }
        $validatedData['foto_adm'] = $namaFile;

        DB::beginTransaction();
        try {
            $user = new User();
            $user->role = 'pembayaran';
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            // Simpan data ke tabel 'admin_sistems' dengan menggunakan ID pengguna yang baru saja dibuat
            $adminSistem = new AdminPembayaran();
            $adminSistem->nip_peg_pem = $request->nip_peg_pem;
            $adminSistem->user_id = $user->user_id;
            $adminSistem->nama_pegawai = $request->nama_pegawai;
            $adminSistem->tgl_lahir = $request->tgl_lahir;
            $adminSistem->jenis_kelamin = $request->jenis_kelamin;
            $adminSistem->alamat = $request->alamat;
            $adminSistem->telp = $request->telp;
            $adminSistem->foto_adm = $namaFile;
            $adminSistem->save();

            // Commit transaction
            DB::commit();
            return redirect('/usersPembayaran')->with('pesan','Data Berhasil di Simpan');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menyimpan data.']);
        }
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
        return view('usersPembayaran.edit',
            [
                'admin_pembayarans'=>AdminPembayaran::find($id),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $admin_pembayarans = AdminPembayaran::find($id);
    
        $validatedData = $request->validate([
            'nama_pegawai'=>'required',
            'tgl_lahir'=>'required|date',
            'jenis_kelamin'=>'required',
            'alamat'=>'required',
            'telp'=>'required',
            'foto_adm'=>'nullable',
        ]);
        
        if ($request->hasFile('foto_adm')) {
            $foto = $request->file('foto_adm');
            $namaFile = 'img_' . time() . '_' . $foto->getClientOriginalName();
            $foto->move('images', $namaFile);
    
            // Jika ada file yang diunggah, update nama file gambar
            $validatedData['foto_adm'] = $namaFile;
        } else {
            // Jika tidak ada file gambar yang diunggah, gunakan foto_adm yang sudah ada
            $validatedData['foto_adm'] = $admin_pembayarans->foto_adm;
        }
        $admin_pembayarans->update($validatedData);

        AdminPembayaran::where('nip_peg_pem', $id)->update($validatedData);
        return redirect('/usersPembayaran')->with('pesan', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = AdminPembayaran::find($id);
        AdminPembayaran::destroy($id);
        User::where('user_id',$user->user_id)->delete();
        return redirect('/usersGuru')->with('pesan','Data Berhasil di Hapus');
    }
}
