<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatTriwulan1 extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function triwulan1()
    {
        return $this->belongsTo(Triwulan1::class, 'triwulan1_id');
    }
}
