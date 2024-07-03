<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->unsignedInteger('nis')->primary();

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users');

            $table->unsignedInteger('kelas_id');
            $table->foreign('kelas_id')->references('kelas_id')->on('kelas');

            $table->string('nama_siswa',50);
            $table->date('tgl_lahir');
            $table->string('jenis_kelamin',10);
            $table->string('alamat', 100);
            $table->string('nama_ortu', 50);
            $table->string('telp', 14);
            $table->string('foto_siswa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
