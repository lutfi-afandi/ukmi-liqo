@extends('layout_lte.main')
@php
    $helper = new \App\Helpers\Helper();

@endphp

@section('content')
    {{-- judul --}}
    <div class="row">
        <div class="col-md-12">
            <div class="info-box p-2 pl-3">

                <div class="info-box-content m">
                    <h4 class="info-box-number mb-0">Unggah Laporan</h4>
                    <h5 class="info-box-text font-weight-light">Lembaga Penjamin Mutu</h5>
                </div>
                <div class="info-box-button pt-2 pr-3 d-none">
                    <a href="{{ route('admin.laporan.index') }}" class="btn btn-info"><i class="fas fa-home"></i>
                        Beranda</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- form pilih divisi & periode --}}
                    <form id="form-search" method="get">
                        @csrf

                        <div id="alert">
                            @if (session()->has('msgs'))
                                <div class="alert {{ session('class') }}">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    {{ session('msgs') }}
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-lg-5 mt-1">
                                <select name="user_id" id="user_id" class="form-control select2bs4" style="width: 100%;"
                                    required>
                                    <option value="" hidden>-Pilih Bagian-</option>
                                    @foreach ($divisis as $divisi)
                                        <option value="{{ $divisi->id }}" {{ $user_id == $divisi->id ? 'selected' : '' }}>
                                            {{ $divisi->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-5 mt-1">
                                <select name="periode_id" id="periode_id" class="form-control" required>
                                    <option value="">-Pilih Periode-</option>
                                    @foreach ($periode as $item)
                                        <option value="{{ $item->id }}" {{ $item->id }}"
                                            {{ $periode_id == $item->id ? 'selected' : '' }}>{{ $item->tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2 mt-1">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($user_id && $periode_id)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <center><strong>{{ $pemilik->name }}</strong></center>
                    </div>
                    <div class="card-body">
                        @php
                            $syarat = $helper->syaratOnLpm($user_id, $periode_id);
                            // dd($syarat);
                        @endphp

                        <div class="row">
                            <div class="col-md-6">
                                <div class="small-box ">
                                    <a href="{{ route('divisi.progja.index') }}"
                                        class="small-box bg-{!! $helper->bg($laporan->konf_progja ?? '') !!}">
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
                                        <a href="{{ route('divisi.sarmut.index') }}"
                                            class="small-box bg-{!! $helper->bg($laporan->konf_sarmut ?? '') !!}">
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
                                        <i class="fa fa-spinner fa-spin"></i> UPLOAD BERKAS LAPORAN DAHULU
                                    </center>
                                </div>
                            </div>
                        @else
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="small-box bg-white">
                                        <a href="{{ $syarat['url_tw1'] }}" class="small-box bg-{!! $helper->bg($laporan->triwulan1->first()->konf ?? '') !!} ">
                                            <div class="inner">

                                                <h3>Triwulan 1</h3>
                                                <p class="badge bg-white ">{!! $helper->icon($laporan->triwulan1->first()->konf ?? '') !!}</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-dice-one"></i>
                                            </div>
                                            <span class="small-box-footer">{{ $syarat['text_info1'] }}
                                                <i class="fas fa-arrow-circle-right"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="small-box bg-white">
                                        <a href="{{ $syarat['url2'] }}" class="small-box bg-{!! $helper->bg($laporan->triwulan2->first()->konf ?? '') !!}">
                                            <div class="inner">
                                                <h3>Triwulan 2</h3>
                                                <p class="badge bg-white ">{!! $helper->icon($laporan->triwulan2->first()->konf ?? '') !!}</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-dice-two"></i>
                                            </div>
                                            <span class="small-box-footer">{{ $syarat['text_info2'] }}
                                                <i class="fas fa-arrow-circle-right"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="small-box bg-white">
                                        <a href="{{ $syarat['url3'] }}" class="small-box bg-{!! $helper->bg($laporan->triwulan3->first()->konf ?? '') !!}">
                                            <div class="inner">
                                                <h3>Triwulan 3</h3>
                                                <p class="badge bg-white ">{!! $helper->icon($laporan->triwulan3->first()->konf ?? '') !!}</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-dice-three"></i>
                                            </div>
                                            <span class="small-box-footer">{{ $syarat['text_info3'] }}
                                                <i class="fas fa-arrow-circle-right"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="small-box bg-white">
                                        <a href="{{ $syarat['url4'] }}" class="small-box bg-{!! $helper->bg($laporan->triwulan4->first()->konf ?? '') !!}">
                                            <div class="inner">
                                                <h3>Triwulan 4</h3>
                                                <p class="badge bg-white ">{!! $helper->icon($laporan->triwulan4->first()->konf ?? '') !!}</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-dice-four"></i>
                                            </div>
                                            <span class="small-box-footer">{{ $syarat['text_info4'] }}
                                                <i class="fas fa-arrow-circle-right"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div id="tempat-modal"></div>
@endsection

@section('js')
    <script>
        // setTimeout(function() {
        //     document.getElementById('alert').innerHTML = '';
        // }, 2000);
        $(document).ready(function() {
            $(function() {
                $('#datatableku').DataTable({
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "responsive": true,
                });
            });

        });

        function search() {
            var periode_id = $('#periode_id').val();
            var user_id = $('#user_id').val();

            if (user_id == "" || periode_id == "") {
                alert('silahkan pilih tahun periode dan Divisi!')
                console.log(periode_id, user_id);
            } else {

            }

        }

        // $('#form-search').submit(function(e) {
        //     e.preventDefault();

        // });

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
@endsection
