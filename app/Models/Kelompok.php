<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }

    public function rombel()
    {
        return $this->hasMany(AnggotaKelompok::class);
    }

    public function pertemuan()
    {
        return $this->hasMany(Pertemuan::class);
    }
}
