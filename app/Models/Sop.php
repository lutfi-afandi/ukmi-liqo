<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sop extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function sub_sop()
    {
        return $this->hasMany(SupSop::class);
    }
}
