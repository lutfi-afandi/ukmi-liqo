<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupSop extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function sop()
    {
        return $this->belongsTo(Sop::class);
    }
}
