@extends('templateAdminLTE/home')
@section('sub-breadcrumb', 'Halaman Utama')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <a href="#" class="box bg-info">
                <div class="box-cell p-a-3 valign-middle">
                    <i class="box-bg-icon middle right fa fa-star"></i>
                    <span class="font-size-24"><strong>1</strong></span><br>
                    <span class="font-size-15">Kegiatan</span>
                </div>
            </a>
        </div>
    </div>
    @include('admin.home.grafik')
@endsection
