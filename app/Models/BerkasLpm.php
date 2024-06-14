<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasLpm extends Model
{
    use HasFactory;
    protected $table = 'berkas_lpms';
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }
}
