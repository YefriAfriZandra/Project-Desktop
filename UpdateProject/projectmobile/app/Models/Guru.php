<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Guru extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $primaryKey='nip_guru';

    public function users(): BelongsTo
    {
        return $this -> belongsTo(User::class, 'user_id','user_id');
    }
}
