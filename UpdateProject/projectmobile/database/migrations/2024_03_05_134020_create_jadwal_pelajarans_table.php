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
        Schema::create('jadwal_pelajarans', function (Blueprint $table) {
            $table->increments('jadwal_pelajaran_id');

            $table->unsignedInteger('kelas_id');
            $table->foreign('kelas_id')->references('kelas_id')->on('kelas');
            
            $table->string('hari',10);
            $table->integer('jam');

            $table->unsignedInteger('pelajaran_id');
            $table->foreign('pelajaran_id')->references('pelajaran_id')->on('pelajarans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_pelajarans');
    }
};
