<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pelajaran extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $primaryKey = 'pelajaran_id';
    
    public function guru(): BelongsTo
    {
        return $this -> belongsTo(Guru::class, 'nip_guru','nip_guru');
    }
}
