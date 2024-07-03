<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalPelajaran extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $primaryKey='jadwal_pelajaran_id';

    public function kelas(): BelongsTo
    {
        return $this -> belongsTo(Kelas::class, 'kelas_id', 'kelas_id');
    }

    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class, 'pelajaran_id', 'pelajaran_id');
    }

    public function guru()
    {
        return $this->pelajaran->guru(); // Mengakses relasi guru melalui relasi pelajaran
    }
}
