<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('usersGuru.index',[
            'gurus'=>Guru::latest()->paginate(10)
        ],);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $gurus = Guru::where('nip_guru', 'like', "%{$searchTerm}%")
                        ->orWhere('nama_guru', 'like', "%{$searchTerm}%")
                        ->paginate(10);

        return view('usersGuru.index', [
            'gurus' => $gurus
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usersGuru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nip_guru'=>'required|unique:gurus',
            'nama_guru'=>'required',
            'password'=>'required',
            'tgl_lahir'=>'required|date',
            'jenis_kelamin'=>'required',
            'alamat'=>'required',
            'email'=>'required|email',
            'telp'=>'required',
            'foto_guru' => 'required',
        ]);

        if ($request->hasFile('foto_guru')) {
            $foto = $request->file('foto_guru');
            $namaFile = 'img_' . time() . '_' . $foto->getClientOriginalName();
            $foto->move('images', $namaFile);
        } else {
            $namaFile = 'img_default.png';
        }
        
        $validatedData['foto_guru'] = $namaFile;

        DB::beginTransaction();
        try {
            $user = new User();
            $user->role = 'guru';
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            // Simpan data ke tabel 'admin_sistems' dengan menggunakan ID pengguna yang baru saja dibuat
            $guru = new Guru();
            $guru->nip_guru = $request->nip_guru;
            $guru->user_id = $user->user_id;
            $guru->nama_guru = $request->nama_guru;
            $guru->tgl_lahir = $request->tgl_lahir;
            $guru->jenis_kelamin = $request->jenis_kelamin;
            $guru->alamat = $request->alamat;
            $guru->telp = $request->telp;
            $guru->foto_guru = $namaFile;
            $guru->save();

            // Commit transaction
            DB::commit();
            return redirect('/usersGuru')->with('pesan','Data Berhasil di Simpan');

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
        return view('usersGuru.edit',
            [
                'gurus'=>Guru::find($id),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $guru = Guru::find($id);

        // Validasi data
        $validatedData = $request->validate([
            'nama_guru'=>'required',
            'tgl_lahir'=>'required|date',
            'jenis_kelamin'=>'required',
            'alamat'=>'required',
            'telp'=>'required',
            'foto_guru' => 'nullable', // Ubah menjadi nullable agar tidak selalu wajib diisi
        ]);

        if ($request->hasFile('foto_guru')) {
            $foto = $request->file('foto_guru');
            $namaFile = 'img_' . time() . '_' . $foto->getClientOriginalName();
            $foto->move('images', $namaFile);
    
            // Jika ada file yang diunggah, update nama file gambar
            $validatedData['foto_guru'] = $namaFile;
        } else {
            // Jika tidak ada file gambar yang diunggah, gunakan foto_guru yang sudah ada
            $validatedData['foto_guru'] = $guru->foto_guru;
        }
        $guru->update($validatedData);

        // Update data guru
        $guru->update($validatedData);

        return redirect('/usersGuru')->with('pesan', 'Data Berhasil Diupdate');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Guru::find($id);
        Guru::destroy($id);
        User::where('user_id',$user->user_id)->delete();
        return redirect('/usersGuru')->with('pesan','Data Berhasil di Hapus');
    }
}