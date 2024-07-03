<?php

namespace App\Http\Controllers;

use App\Models\JadwalPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalPelajaranControllerApi extends Controller
{
    public function index()
    {
        return JadwalPelajaran::with('pelajaran')->get();
    }

    public function getMapelSenin(Request $request, $user_id)
    {
        $kelasId = DB::table('siswas')
            ->join('users', 'siswas.user_id', '=', 'users.user_id')
            ->where('users.user_id', $user_id)
            ->value('siswas.kelas_id');

        $jadwalPelajaranSenin = JadwalPelajaran::with('pelajaran')
            ->where('hari', 'Senin')
            ->where('kelas_id', $kelasId)
            ->orderBy('jam', 'asc')
            ->get();

        return response()->json($jadwalPelajaranSenin);
    }

    public function getMapelSelasa(Request $request, $user_id)
    {
        $kelasId = DB::table('siswas')
            ->join('users', 'siswas.user_id', '=', 'users.user_id')
            ->where('users.user_id', $user_id)
            ->value('siswas.kelas_id');


        $jadwalPelajaranSelasa = JadwalPelajaran::with('pelajaran')
            ->where('hari', 'Selasa')
            ->where('kelas_id', $kelasId)
            ->orderBy('jam', 'asc')
            ->get();
        return response()->json($jadwalPelajaranSelasa);
    }

    public function getMapelRabu(Request $request, $user_id)
    {
        $kelasId = DB::table('siswas')
            ->join('users', 'siswas.user_id', '=', 'users.user_id')
            ->where('users.user_id', $user_id)
            ->value('siswas.kelas_id');
        $jadwalPelajaranRabu = JadwalPelajaran::with('pelajaran')
            ->where('hari', 'Rabu')
            ->where('kelas_id', $kelasId)
            ->orderBy('jam', 'asc')
            ->get();
        return response()->json($jadwalPelajaranRabu);
    }

    public function getMapelKamis(Request $request, $user_id)
    {
        $kelasId = DB::table('siswas')
            ->join('users', 'siswas.user_id', '=', 'users.user_id')
            ->where('users.user_id', $user_id)
            ->value('siswas.kelas_id');
        $jadwalPelajaranKamis = JadwalPelajaran::with('pelajaran')
            ->where('hari', 'Kamis')
            ->where('kelas_id', $kelasId)
            ->orderBy('jam', 'asc')
            ->get();
        return response()->json($jadwalPelajaranKamis);
    }

    public function getMapelJumat(Request $request, $user_id)
    {
        $kelasId = DB::table('siswas')
            ->join('users', 'siswas.user_id', '=', 'users.user_id')
            ->where('users.user_id', $user_id)
            ->value('siswas.kelas_id');
        $jadwalPelajaranJumat = JadwalPelajaran::with('pelajaran')
            ->where('hari', 'Jumat')
            ->where('kelas_id', $kelasId)
            ->orderBy('jam', 'asc')
            ->get();
        return response()->json($jadwalPelajaranJumat);
    }

    public function getMapelSabtu(Request $request, $user_id)
    {
        $kelasId = DB::table('siswas')
            ->join('users', 'siswas.user_id', '=', 'users.user_id')
            ->where('users.user_id', $user_id)
            ->value('siswas.kelas_id');
        $jadwalPelajaranSabtu = JadwalPelajaran::with('pelajaran')
            ->where('hari', 'Sabtu')
            ->where('kelas_id', $kelasId)
            ->orderBy('jam', 'asc')
            ->get();
        return response()->json($jadwalPelajaranSabtu);
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
        return JadwalPelajaran::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return JadwalPelajaran::findOrFail($id);
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
            $JadwalPelajaran = JadwalPelajaran::findOrFail($id);
            $JadwalPelajaran->update($request->all());

            return $JadwalPelajaran;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $JadwalPelajaran = JadwalPelajaran::findOrFail($id);
        $JadwalPelajaran->delete();

        return 204;
    }
}
