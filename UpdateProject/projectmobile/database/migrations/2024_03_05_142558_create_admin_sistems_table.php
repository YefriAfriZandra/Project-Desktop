<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin_sistems', function (Blueprint $table) {
            $table->unsignedBigInteger('nip_peg_sis')->primary();

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users');

            $table->string('nama_pegawai', 50);
            $table->date('tgl_lahir');
            $table->string('jenis_kelamin', 10);
            $table->string('alamat', 100);
            $table->string('telp', 14);
            $table->string('foto_adm');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_sistems');
    }
};
