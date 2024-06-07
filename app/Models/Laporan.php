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
            ->leftJoin('triwulan1s', 'laporans.id', '=', 'triwulan1s.laporan_id')
            ->leftJoin('triwulan2s', 'laporans.id', '=', 'triwulan2s.laporan_id')
            ->leftJoin('triwulan3s', 'laporans.id', '=', 'triwulan3s.laporan_id')
            ->leftJoin('triwulan4s', 'laporans.id', '=', 'triwulan4s.laporan_id')
            ->select(
                'users.id as user_id',
                'laporans.id as laporan_id',
                'users.*',
                'laporans.*',
                'triwulan1s.*',
                'triwulan2s.*',
                'triwulan3s.*',
                'triwulan4s.*'
            )
            ->where('users.id', $user_id)
            ->first();
    }

    public static function getAll($user_id, $periode_id)
    {
        return self::with(['user', 'triwulan1', 'triwulan2', 'triwulan3', 'triwulan4', 'periode'])
            ->where('user_id', $user_id)
            ->where('periode_id', $periode_id)
            ->first();
    }

    public function triwulan1()
    {
        return $this->hasMany(Triwulan1::class, 'laporan_id');
    }

    public function triwulan2()
    {
        return $this->hasMany(Triwulan2::class, 'laporan_id');
    }

    public function triwulan3()
    {
        return $this->hasMany(Triwulan3::class, 'laporan_id');
    }

    public function triwulan4()
    {
        return $this->hasMany(Triwulan4::class, 'laporan_id');
    }

    public function riwayat_progja()
    {
        return $this->hasMany(RiwayatProgja::class, 'laporan_id');
    }
}
