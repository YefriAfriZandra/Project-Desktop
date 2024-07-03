<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminSistem extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $primaryKey = 'nip_peg_sis';
    protected $fillable = [
        'user_id',
        'nama_pegawai',
        'tgl_lahir',
        'jenis_kelamin',
        'alamat',
        'telp',
        'foto_adm',
    ];

    public function user(): BelongsTo
    {
        return $this -> belongsTo(User::class, 'user_id','user_id');
    }
}
