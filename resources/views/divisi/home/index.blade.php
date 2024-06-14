@extends('layout_lte/main')
@php
    $helper = new \App\Helpers\Helper();
@endphp
@section('content')
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="info-box p-2">
                        <div class="info-box-icon">
                            <i class="fas fa-2x fa-th-large text-info"></i>

                        </div>
                        <div class="info-box-content">
                            <h4 class="info-box-number mb-0">Dashboard E-SPMI</h4>
                            <h5 class="info-box-text font-weight-light">{{ $user->name }}</h5>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="small-box ">
                        <a href="{{ route('divisi.progja.index') }}" class="small-box bg-{!! $helper->bg($laporan->konf_progja ?? '') !!}">
                            <div class="inner">
                                <h3>Program Kerja</h3>
                                <p class="badge bg-warning ">{!! $helper->icon($laporan->konf_progja ?? '') !!}</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                            <span class="small-box-footer">lihat
                                <i class="fas fa-arrow-circle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    @if ($laporan == null)
                        <div class="small-box ">
                            <a href="#" class="small-box bg-secondary">
                                <div class="inner">
                                    <h3>Sasaran Mutu</h3>
                                    <p class="badge bg-warning">
                                        <i class="fa fa-exclamination-circle"></i> Isi Progja terlebih dahulu
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-crosshairs"></i>
                                </div>
                                <span class="small-box-footer">lihat
                                    <i class="fas fa-arrow-circle-right"></i>
                                </span>
                            </a>
                        </div>
                    @else
                        <div class="small-box ">
                            <a href="{{ route('divisi.sarmut.index') }}" class="small-box bg-{!! $helper->bg($laporan->konf_sarmut ?? '') !!}">
                                <div class="inner">
                                    <h3>Sasaran Mutu</h3>
                                    <p class="badge bg-warning">{!! $helper->icon($laporan->konf_sarmut ?? '') !!}</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-crosshairs"></i>
                                </div>
                                <span class="small-box-footer">lihat
                                    <i class="fas fa-arrow-circle-right"></i>
                                </span>
                            </a>
                        </div>
                    @endif

                </div>
            </div>
            @if ($laporan == null)
                <div class="card">
                    <div class="card-body">
                        <center>
                            <i class="fa fa-spinner fa-spin"></i> SILAHKAN UPLOAD BERKAS LAPORAN
                        </center>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-md-3">
                        <div class="small-box bg-white">
                            <a href="{{ route('divisi.triwulan1.index') }}" class="small-box bg-{!! $helper->bg($laporan->triwulan1->first()->konf ?? '') !!}">
                                <div class="inner">
                                    <h3>Triwulan 1</h3>
                                    <p class="badge bg-white ">{!! $helper->icon($laporan->triwulan1->first()->konf ?? '') !!}</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-dice-one"></i>
                                </div>
                                <span class="small-box-footer">lihat
                                    <i class="fas fa-arrow-circle-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-white">
                            <a href="{{ route('divisi.triwulan2.index') }}" class="small-box bg-{!! $helper->bg($laporan->triwulan2->first()->konf ?? '') !!}">
                                <div class="inner">
                                    <h3>Triwulan 2</h3>
                                    <p class="badge bg-white ">{!! $helper->icon($laporan->triwulan2->first()->konf ?? '') !!}</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-dice-two"></i>
                                </div>
                                <span class="small-box-footer">lihat
                                    <i class="fas fa-arrow-circle-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-white">
                            <a href="{{ route('divisi.triwulan3.index') }}" class="small-box bg-{!! $helper->bg($laporan->triwulan3->first()->konf ?? '') !!}">
                                <div class="inner">
                                    <h3>Triwulan 3</h3>
                                    <p class="badge bg-white ">{!! $helper->icon($laporan->triwulan3->first()->konf ?? '') !!}</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-dice-three"></i>
                                </div>
                                <span class="small-box-footer">lihat
                                    <i class="fas fa-arrow-circle-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-white">
                            <a href="{{ route('divisi.triwulan4.index') }}" class="small-box bg-{!! $helper->bg($laporan->triwulan4->first()->konf ?? '') !!}">
                                <div class="inner">
                                    <h3>Triwulan 4</h3>
                                    <p class="badge bg-white ">{!! $helper->icon($laporan->triwulan4->first()->konf ?? '') !!}</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-dice-four"></i>
                                </div>
                                <span class="small-box-footer">lihat
                                    <i class="fas fa-arrow-circle-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>

                </div>
            @endif
        </div>
    </div>
@endsection
