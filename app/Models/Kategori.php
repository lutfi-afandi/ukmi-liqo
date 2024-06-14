<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategoris';
    protected $guarded = ["id"];


    public function penetapan()
    {
        return $this->hasMany(Penetapan::class);
    }

    public function berkaslpm()
    {
        return $this->hasMany(BerkasLpm::class);
    }
}
