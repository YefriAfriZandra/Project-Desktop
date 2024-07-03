<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKomite extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $primaryKey='jenis_komite_id';
    protected $table = 'jenis_komites';

}
