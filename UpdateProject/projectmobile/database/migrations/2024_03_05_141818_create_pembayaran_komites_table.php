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
        Schema::create('pembayaran_komites', function (Blueprint $table) {
            $table->increments('pembayaran_id');
            
            $table->unsignedInteger('nis');
            $table->foreign('nis')->references('nis')->on('siswas');

            $table->unsignedInteger('jenis_komite_id');
            $table->foreign('jenis_komite_id')->references('jenis_komite_id')->on('jenis_komites');

            $table->unsignedBigInteger('nip_peg_pem');
            $table->foreign('nip_peg_pem')->references('nip_peg_pem')->on('admin_pembayarans');

            $table->string('bulan', 10);
            $table->integer('jml_bayar');
            $table->date('tgl_bayar');
            $table->string('status', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_komites');
    }
};
