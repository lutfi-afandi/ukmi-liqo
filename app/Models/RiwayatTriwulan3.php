<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatTriwulan3 extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function triwulan3()
    {
        return $this->belongsTo(Triwulan3::class, 'triwulan3_id');
    }
}
