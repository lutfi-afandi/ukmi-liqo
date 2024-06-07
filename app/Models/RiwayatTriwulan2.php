<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatTriwulan2 extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function triwulan2()
    {
        return $this->belongsTo(Triwulan2::class, 'triwulan2_id');
    }
}
