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
        Schema::create('pengumumans', function (Blueprint $table) {
            $table->increments('pengumuman_id');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            
            $table->string('judul', 50);
            $table->string('deskripsi', 100);
            $table->integer('penerima');
            // $table->string('status', 10);
            $table->date('tgl_awal');
            $table->date('tgl_akhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumumans');
    }
};
