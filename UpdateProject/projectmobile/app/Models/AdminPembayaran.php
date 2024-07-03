<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPembayaran extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $primaryKey = 'nip_peg_pem';

    public function adminPembayaran()
    {
        return $this->belongsTo(AdminPembayaran::class, 'nip_pem_peg', 'nip_pem_peg');
    }
    
}
