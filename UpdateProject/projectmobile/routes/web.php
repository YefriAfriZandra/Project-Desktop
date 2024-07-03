<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InputJadwalPelajaranController;
use App\Http\Controllers\JadwalPelajaranController;
use App\Http\Controllers\JenisKomiteController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\UserSistemController;
use App\Http\Controllers\UserPembayaranController;
use App\Http\Controllers\UserSiswaController;
use App\Http\Controllers\UserGuruController;
use App\Http\Controllers\PelajaranController;
use App\Http\Controllers\PembayaranKomiteController;
use App\Http\Controllers\PengumumanController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/home', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

Route::resource('usersSistem', UserSistemController::class)->except(['show']);;
Route::get('usersSistem/search', [UserSistemController::class, 'search'])->name('usersSistem.search');
Route::resource('usersPembayaran', UserPembayaranController::class)->except(['show']);
Route::get('usersPembayaran/search', [UserPembayaranController::class, 'search'])->name('usersPembayaran.search');
Route::resource('usersSiswa', UserSiswaController::class)->except(['show']);
Route::get('usersSiswa/search', [UserSiswaController::class, 'search'])->name('usersSiswa.search');
Route::resource('usersGuru', UserGuruController::class)->except(['show']);
Route::get('usersGuru/search', [UserGuruController::class, 'search'])->name('usersGuru.search');
Route::resource('routeKelas', KelasController::class);
Route::resource('pelajaran', PelajaranController::class);
Route::resource('nilai', NilaiController::class);

Route::resource('jadwalpelajaran', JadwalPelajaranController::class);
Route::get('/jadwalpelajaran/{id}', [JadwalPelajaranController::class, 'show'])->name('jadwalpelajaran.show');

Route::resource('inputjadwalpelajaran', InputJadwalPelajaranController::class);
Route::get('/inputjadwalpelajaran/create/{id}', [InputJadwalPelajaranController::class, 'create'])->name('inputjadwalpelajaran.create');
// Route::get('/inputjadwalpelajaran/{id}', [InputJadwalPelajaranController::class, 'create'])->name('inputjadwalpelajaran.create');

Route::resource('pembayaranKomite', PembayaranKomiteController::class);
Route::resource('jenisKomite', JenisKomiteController::class);
Route::resource('pengumuman', PengumumanController::class);


Route::get('/login', [LoginController::class,'login'])->name('login');
Route::post('/login', [LoginController::class,'authenticate']);

Route::post('/logout', [LoginController::class,'logout']);






