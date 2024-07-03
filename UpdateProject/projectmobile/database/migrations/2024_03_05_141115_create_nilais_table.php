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
        Schema::create('nilais', function (Blueprint $table) {
            $table->increments('nilai_id');

            $table->unsignedInteger('nis');
            $table->foreign('nis')->references('nis')->on('siswas');

            $table->unsignedInteger('pelajaran_id');
            $table->foreign('pelajaran_id')->references('pelajaran_id')->on('pelajarans');
            
            $table->float('nilai_tugas');
            $table->float('nilai_uts');
            $table->float('nilai_uas');
            $table->string('nilai_kepribadian', 1);
            $table->integer('sakit');
            $table->integer('alfa');
            $table->integer('izin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
