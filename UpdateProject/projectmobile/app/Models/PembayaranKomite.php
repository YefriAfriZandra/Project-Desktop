<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PembayaranKomite extends Model
{
    use HasFactory;
    protected $primaryKey='pembayaran_id';
    protected $fillable = [
        'nis', // Tambahkan 'nis' ke dalam properti $fillable
        'jenis_komite_id',
        'nip_peg_pem',
        'bulan',
        'jml_bayar',
        'tgl_bayar',
        'status',
    ];

    public function siswa(): BelongsTo
    {
        return $this ->belongsTo(Siswa::class, 'nis', 'nis');
    }
    public function jenis_komite(): BelongsTo
    {
        return $this ->belongsTo(JenisKomite::class, 'jenis_komite_id', 'jenis_komite_id');
    }
    public function pegawaipembayaran(): BelongsTo
    {
        return $this ->belongsTo(AdminPembayaran::class, 'nip_peg_pem', 'nip_peg_pem');
    }
    
}


