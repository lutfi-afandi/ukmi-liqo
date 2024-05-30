<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'periode_id');
    }
}
