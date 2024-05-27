@extends('layout_lte/main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="callout callout-info">
                <h3>Selamat Datang <span class="text-primary text-bold">{{ auth()->user()->name }}!</span></h3>

                <p>Follow the steps to continue to payment.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
                <label class="btn bg-maroon active">
                    <input type="radio" name="options" id="option_b1"><i class="far fa-calendar-alt"></i> Periode Sekarang
                    :
                </label>
                <label class="btn bg-maroon">
                    <input type="radio" name="options" id="option_b2"checked=""> {{ $periode_aktif }}
                </label>
            </div>
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body p-1">
                    @php
                        $bg_progja = '';
                        $bg_sarmut = '';
                        $bg_tw1 = '';
                        $bg_tw2 = '';
                        $bg_tw3 = '';
                        $bg_tw4 = '';

                        $icon_progja = '';
                        $icon_sarmut = '';
                        $icon_tw1 = '';
                        $icon_tw2 = '';
                        $icon_tw3 = '';
                        $icon_tw4 = '';

                        switch ($laporan->konf_progja) {
                            case 'belum':
                                $bg_progja = 'bg-danger';
                                $icon_progja = '<i class="fas fa-times"></i>';
                                break;

                            default:
                                # code...
                                break;
                        }
                    @endphp
                    <a class="btn btn-app bg-info" style="height: 140px; width: 140px;padding: 20px 15px; font-size: 18px">
                        <span class="badge {{ $bg_progja }}" style="font-size: 18px">{!! $icon_progja !!}</span>
                        <i class="fas fa-file-invoice" style="font-size: 80px"></i> Progja
                    </a>
                    <a class="btn btn-app bg-info" style="height: 140px; width: 140px;padding: 20px 15px; font-size: 18px">
                        <span class="badge {{ $bg_progja }}" style="font-size: 18px">{!! $icon_progja !!}</span>
                        <i class="fas fa-file-invoice" style="font-size: 80px"></i> Progja
                    </a>
                    <a class="btn btn-app bg-info" style="height: 140px; width: 140px;padding: 20px 15px; font-size: 18px">
                        <span class="badge {{ $bg_progja }}" style="font-size: 18px">{!! $icon_progja !!}</span>
                        <i class="fas fa-file-invoice" style="font-size: 80px"></i> Progja
                    </a>
                    <a class="btn btn-app bg-info" style="height: 140px; width: 140px;padding: 20px 15px; font-size: 18px">
                        <span class="badge {{ $bg_progja }}" style="font-size: 18px">{!! $icon_progja !!}</span>
                        <i class="fas fa-file-invoice" style="font-size: 80px"></i> Progja
                    </a>
                    <a class="btn btn-app bg-info" style="height: 140px; width: 140px;padding: 20px 15px; font-size: 18px">
                        <span class="badge {{ $bg_progja }}" style="font-size: 18px">{!! $icon_progja !!}</span>
                        <i class="fas fa-file-invoice" style="font-size: 80px"></i> Progja
                    </a>
                    <a class="btn btn-app bg-info" style="height: 140px; width: 140px;padding: 20px 15px; font-size: 18px">
                        <span class="badge {{ $bg_progja }}" style="font-size: 18px">{!! $icon_progja !!}</span>
                        <i class="fas fa-file-invoice" style="font-size: 80px"></i> Progja
                    </a>
                </div>
            </div>
            <table class="table table-bordered">
                <tr>
                    <td class="font-weight-bold">Nama</td>
                    <td>:</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Username</td>
                    <td>:</td>
                    <td>{{ $user->username }}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Level</td>
                    <td>:</td>
                    <td>{{ $user->level }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
