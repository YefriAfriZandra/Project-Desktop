<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengumuman extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $primaryKey = 'pengumuman_id';
    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'penerima',
        'tgl_awal',
        'tgl_akhir',
    ];
    protected $table = 'pengumumans';

    public function adminSistem()
    {
        return $this->belongsTo(AdminSistem::class, 'user_id', 'user_id');
    }
}
