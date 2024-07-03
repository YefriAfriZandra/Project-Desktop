<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('usersSiswa.index',[
            'siswas'=>Siswa::latest()->paginate(10)
        ],
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usersSiswa.create',
        [
            // 'pelajarans'=>Pelajaran::find($id),
            'kelas'=>Kelas::all(),       
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nis'=>'required|unique:siswas',
            'kelas_id'=>'required',
            'nama_siswa'=>'required',
            'email'=>'required',
            'password'=>'required',
            'tgl_lahir'=>'required|date',
            'jenis_kelamin'=>'required',
            'alamat'=>'required',
            'nama_ortu'=>'required',
            'telp'=>'required',
            'foto_siswa'=>'required',
        ]);

        if ($request->hasFile('foto_siswa')) {
            $foto = $request->file('foto_siswa');
            $namaFile = 'img_' . time() . '_' . $foto->getClientOriginalName();
            $foto->move('images', $namaFile);
        } else {
            $namaFile = 'img_default.png';
        }
        $validatedData['foto_siswa'] = $namaFile;

        DB::beginTransaction();
        try {
            $user = new User();
            $user->role = 'siswa';
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            // Simpan data ke tabel 'admin_sistems' dengan menggunakan ID pengguna yang baru saja dibuat
            $siswa = new Siswa();
            $siswa->nis = $request->nis;
            $siswa->user_id = $user->user_id;
            $siswa->kelas_id = $request->kelas_id;
            $siswa->nama_siswa = $request->nama_siswa;
            $siswa->tgl_lahir = $request->tgl_lahir;
            $siswa->jenis_kelamin = $request->jenis_kelamin;
            $siswa->alamat = $request->alamat;
            $siswa->nama_ortu = $request->nama_ortu;
            $siswa->telp = $request->telp;
            $siswa->foto_siswa = $namaFile;
            $siswa->save();

            // Commit transaction
            DB::commit();
            return redirect('/usersSiswa')->with('pesan','Data Berhasil di Simpan');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menyimpan data.']);
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $siswas = Siswa::where('nis', 'like', "%{$searchTerm}%")
                        ->orWhere('nama_siswa', 'like', "%{$searchTerm}%")
                        ->paginate(10);

        return view('usersSiswa.index', [
            'siswas' => $siswas
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('usersSiswa.edit',
            [
                'siswas'=>Siswa::find($id),
                'kelas'=>Kelas::all(),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $siswas = Siswa::find($id);
    
        $validatedData = $request->validate([
            'kelas_id'=>'required',
            'nama_siswa'=>'required',
            'tgl_lahir'=>'required|date',
            'jenis_kelamin'=>'required',
            'alamat'=>'required',
            'nama_ortu'=>'required',
            'telp'=>'required',
            'foto_siswa'=>'nullable',
        ]);

        if ($request->hasFile('foto_siswa')) {
            $foto = $request->file('foto_siswa');
            $namaFile = 'img_' . time() . '_' . $foto->getClientOriginalName();
            $foto->move('images', $namaFile);
    
            // Jika ada file yang diunggah, update nama file gambar
            $validatedData['foto_siswa'] = $namaFile;
        } else {
            // Jika tidak ada file gambar yang diunggah, gunakan foto_siswa yang sudah ada
            $validatedData['foto_siswa'] = $siswas->foto_siswa;
        }
        $siswas->update($validatedData);

        Siswa::where('nis', $id)->update($validatedData);
        return redirect('/usersSiswa')->with('pesan', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Siswa::find($id);
        Siswa::destroy($id);
        User::where('user_id',$user->user_id)->delete();
        return redirect('/usersGuru')->with('pesan','Data Berhasil di Hapus');
    }
}
