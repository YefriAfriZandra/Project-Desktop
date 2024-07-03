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
        Schema::create('pelajarans', function (Blueprint $table) {
            $table->increments('pelajaran_id');

            $table->unsignedBigInteger('nip_guru');
            $table->foreign('nip_guru')->references('nip_guru')->on('gurus');

            $table->string('nama_pelajaran', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelajarans');
    }
};
