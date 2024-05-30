<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id');
    }

    public static function getLaporan($user_id, $periode_id)
    {
        return User::leftJoin('laporans', function ($join) use ($periode_id) {
            $join->on('users.id', '=', 'laporans.user_id')
                ->where('laporans.periode_id', '=', $periode_id);
        })
            ->select('users.*', 'laporans.*')
            ->where('users.id', $user_id)
            ->first();
    }
}
