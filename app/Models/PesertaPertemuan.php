<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaPertemuan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pertemuan()
    {
        return $this->belongsTo(Pertemuan::class);
    }
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}
