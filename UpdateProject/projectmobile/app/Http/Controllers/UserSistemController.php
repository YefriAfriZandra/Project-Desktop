<?php

namespace App\Http\Controllers;

use App\Models\AdminSistem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserSistemController extends Controller
{
    public function index()
    {
        return view('usersSistem.index', 
        [
            'admin_sistems'=>AdminSistem::latest()->paginate(10)
        ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usersSistem.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nip_peg_sis'=>'required|unique:admin_sistems',
            'nama_pegawai'=>'required',
            'email'=>'required',
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
            $user->role = 'sistem';
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            // Simpan data ke tabel 'admin_sistems' dengan menggunakan ID pengguna yang baru saja dibuat
            $adminSistem = new AdminSistem();
            $adminSistem->nip_peg_sis = $request->nip_peg_sis;
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
            return redirect('/usersSistem')->with('pesan','Data Berhasil di Simpan');

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

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $admin_sistems = AdminSistem::where('nip_peg_sis', 'like', "%{$searchTerm}%")
                        ->orWhere('nama_pegawai', 'like', "%{$searchTerm}%")
                        ->paginate(10);

        return view('usersSistem.index', [
            'admin_sistems' => $admin_sistems
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('usersSistem.edit',
            [
                'admin_sistems'=>AdminSistem::find($id),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $admin_sistems = AdminSistem::find($id);
    
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
            $validatedData['foto_adm'] = $admin_sistems->foto_adm;
        }
        $admin_sistems->update($validatedData);

        AdminSistem::where('nip_peg_sis', $id)->update($validatedData);
        return redirect('/usersSistem')->with('pesan', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = AdminSistem::find($id);
        AdminSistem::destroy($id);
        User::where('user_id',$user->user_id)->delete();
        return redirect('/usersGuru')->with('pesan','Data Berhasil di Hapus');
    }
}
