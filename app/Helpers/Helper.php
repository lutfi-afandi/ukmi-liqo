<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use App\Models\Laporan;
use App\Models\Periode;
use App\Models\User;
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

    public function syarat()
    {
        $user = User::find(Auth::user()->id);
        $periode = Periode::where('status', 1)->first();
        $periode_id = $periode->id;
        $laporan = Laporan::getAll($user->id, $periode_id);

        $sarmut = $laporan->sarmut ?? '';
        $progja = $laporan->progja ?? '';


        if ($progja != null) {
            $tw1 = $laporan->triwulan1->first() ?? '';
            $tw2 = $laporan->triwulan2->first() ?? '';
            $tw3 = $laporan->triwulan3->first() ?? '';
            $tw4 = $laporan->triwulan4->first() ?? '';
            if ($sarmut == null) {
                $url_tw1 = '#';
                $text_info1 = 'isi sarmut terlebih dahulu!';
            } else {
                $url_tw1 = route('divisi.triwulan1.index');
                $text_info1 = 'isi sarmut terlebih dahulu!';
            }

            if ($tw1 == null) {
                $url2 = '#';
                $text_info2 = 'evaluasi Triwulan 1 belum diisi!';
            } else {
                $url2 = route('divisi.triwulan1.index');
                $text_info2 = 'evaluasi Triwulan 1 belum diisi!';
            }

            if ($tw2 == null) {
                $url3 = '#';
                $text_info3 = 'evaluasi Triwulan 2 belum diisi!';
            } else {
                $url3 = route('divisi.triwulan2.index');
                $text_info3 = 'evaluasi Triwulan 2 belum diisi!';
            }

            if ($tw3 == null) {
                $url4 = '#';
                $text_info4 = 'evaluasi Triwulan 3 belum diisi!';
            } else {
                $url4 = route('divisi.triwulan3.index');
                $text_info4 = 'evaluasi Triwulan 3 belum diisi!';
            }

            return [
                'progja'   => $progja,

                'url_tw1' => $url_tw1,
                'text_info1' => $text_info1,

                'url2' => $url2,
                'text_info2' => $text_info2,

                'url3' => $url3,
                'text_info3' => $text_info3,

                'url4' => $url4,
                'text_info4' => $text_info4,
            ];
        }
    }
}
