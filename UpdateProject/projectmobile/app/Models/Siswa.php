<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Siswa extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $primaryKey = 'nis';

    public function kelas(): BelongsTo
    {
        return $this -> belongsTo(Kelas::class, 'kelas_id','kelas_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','user_id');
    }

    public function nilais()
    {
        return $this->hasMany(Nilai::class, 'nis', 'nis');
    }

}
