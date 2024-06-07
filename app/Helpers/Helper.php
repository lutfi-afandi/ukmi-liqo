<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use App\Models\Periode;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use Auth;

class Helper
{
    public function periode_aktif()
    {
        $periode = Periode::where('status', 1)->first();
        return $periode->tahun;
    }

    public function icon($konfirmasi)
    {
        $icon = '';
        switch ($konfirmasi) {
            case 'belum':
                $icon = '<i class="fas fa-exclamation-triangle fa-beat"></i> Belum Diperiksa';
                break;
            case 'diterima':
                $icon = '<i class="fas fa-check-circle"></i> Diterima';
                break;
            case 'ditolak':
                $icon = '<i class="fas fa-times-circle"></i> Ditolak';
                break;
            case 'sedang':
                $icon = '<i class="fas fa-circle-notch fa-spin"></i> Sedang Diperiksa';
                break;

            default:
                $icon = '<i class="fas fa-exclamation-triangle fa-fade"></i> belum diisi';
                break;
        }

        return $icon;
    }
    public function bg($konfirmasi)
    {
        $bg = '';
        switch ($konfirmasi) {
            case 'belum':
                $bg = 'warning';
                break;
            case 'diterima':
                $bg = 'success';
                break;
            case 'ditolak':
                $bg = 'danger';
                break;
            case 'sedang':
                $bg = 'info';
                break;

            default:
                $bg = 'danger';
                break;
        }

        return $bg;
    }
}
