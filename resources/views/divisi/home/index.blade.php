@extends('layout_lte/main')
@php
    $helper = new \App\Helpers\Helper();
@endphp
@section('content')
    {{-- <div class="row">
        <div class="col-sm-12">
            <div class="callout callout-info">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>Selamat Datang <span class="text-primary text-bold">{{ auth()->user()->name }}!</span></h3>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur </p>
                <div class="btn-group btn-group-toggle mb-2 ml-auto" data-toggle="buttons">
                    <label class="btn bg-lime active">
                        <input type="radio" name="options" id="option_b1"><i class="far fa-calendar-alt"></i> Periode
                        Sekarang :
                    </label>
                    <label class="btn bg-lime">
                        <input type="radio" name="options" id="option_b2" checked=""> {{ $periode_aktif }}
                    </label>
                    <button type="button" class="btn btn-lime btn-flat dropdown-toggle dropdown-icon"
                        data-toggle="dropdown" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                        <a class="dropdown-item" href="#">Action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </div>
            </div>

        </div>
    </div> --}}
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header bg-primary">
                    <h3>
                        <center>LEMBAGA PENJAMIN MUTU
                            <br> Universitas Teknokrat Indonesia
                        </center>
                    </h3>
                </div>
                <div class="card-body  p-1">
                    <div class="row p-0">
                        <div class="col-md-6 m-0 pr-1">
                            <a class="d-block align-items-center text-center pt-5 pb-4 "
                                style="border: 1px !important; color: rgb(88, 88, 88; background: url('https://cdn.pixabay.com/photo/2016/12/02/02/10/idea-1876659_1280.jpg'))"
                                href="{{ route('divisi.laporan.index') }}">
                                <i class="fas fa-city fa-8x"></i>
                                <h4 class="mb-1 mt-1 ">Program Kerja</h4>
                                <span class="badge bg-primary">{!! $helper->icon($laporan->konf_progja) !!}</span>
                            </a>
                        </div>
                        <div class="col-md-6 m-0 pl-0">
                            <a class="d-block align-items-center text-center pt-5 pb-4 " style="border: 1px !important;"
                                href="/dashboard">
                                <i class="fas fa-book-open fa-8x"></i>
                                <span>{!! $helper->icon($laporan->konf_sarmut) !!}</span>
                                <p>Sarmut</p>
                            </a>
                        </div>

                    </div>
                    <div class="row p-1">
                        <div class="col-md-3">
                            <a class="d-block align-items-center text-center pt-5 pb-4 " style="border: 1px !important;"
                                href="/dashboard">
                                <i class="fa fa-file fa-8x"></i>
                                <p>Program Kerja</p>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a class="d-block align-items-center text-center pt-5 pb-4 " style="border: 1px !important;"
                                href="/dashboard">
                                <i class="fa fa-file fa-8x"></i>
                                <p>Program Kerja</p>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a class="d-block align-items-center text-center pt-5 pb-4 " style="border: 1px !important;"
                                href="/dashboard">
                                <i class="fa fa-file fa-8x"></i>
                                <p>Program Kerja</p>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a class="d-block align-items-center text-center pt-5 pb-4 " style="border: 1px !important;"
                                href="/dashboard">
                                <i class="fa fa-file fa-8x"></i>
                                <p>Program Kerja</p>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endsection
