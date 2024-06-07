<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatTriwulan4 extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function triwulan4()
    {
        return $this->belongsTo(Triwulan4::class, 'triwulan4_id');
    }
}
