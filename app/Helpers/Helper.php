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
                $icon = '<i class="fas fa-exclamation-triangle"></i>';
                break;
            case 'diterima':
                $icon = '<i class="fas fa-check-circle"></i>';
                break;
            case 'ditolak':
                $icon = '<i class="fas fa-times-circle"></i>';
                break;
            case 'sedang':
                $icon = '<i class="fas fa-circle-notch fa-spin"></i>';
                break;

            default:
                # code...
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
                # code...
                break;
        }

        return $bg;
    }
}
