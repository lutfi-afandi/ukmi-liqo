@extends('layout_lte/main')
@php
    $helper = new \App\Helpers\Helper();
@endphp
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title text-lg font-weight-bold">Program Kerja Tahun : {{ $progja->periode->tahun }}</h3>
                </div>
                <div class="card-body">
                    <div id="alert">
                        @if (session()->has('msgs'))
                            <div class="alert {{ session('class') }}">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ session('msgs') }}
                            </div>
                        @endif
                    </div>

                    <dl class="row text-md">
                        <dt class="col-sm-3">File Progja</dt>
                        <dd class="col-sm-8">:
                            <a type="button" class="" onclick="lihat('{{ $progja->progja }}')">
                                {{ $progja->progja }} <i class="fas fa-share-square"></i>
                            </a>
                        </dd>
                        <dt class="col-sm-3">Status</dt>
                        <dd class="col-sm-8">:
                            <a type="button" class="text-{!! $helper->bg($progja->konf_progja) !!}">
                                {!! $helper->icon($progja->konf_progja) !!}
                            </a>
                        </dd>

                        <dt class="col-sm-3">Catatan Auditor</dt>
                        <dd class="col-sm-8">:
                            {!! $progja->ket_progja ?? '<i>belum ada catatan</i>' !!}
                        </dd>

                        <dt class="col-sm-3">Aksi</dt>
                        <dd class="col-sm-8">:
                            @if ($progja->konf_progja == 'sedang' || $progja->konf_progja == 'diterima')
                                done
                            @else
                                ubah | hapus
                            @endif
                        </dd>

                    </dl>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-widget widget-user-2 shadow-sm">
                <div class="widget-user-header bg-warning">
                    Laporan
                </div>
                <div class="card-footer p-0">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Program Kerja <span class="float-right badge bg-primary">31</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Sarmut <span class="float-right badge bg-info">5</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Triwulan 1 <span class="float-right badge bg-success">12</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Triwulan 2 <span class="float-right badge bg-danger">842</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Triwulan 3 <span class="float-right badge bg-danger">842</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Triwulan 4 <span class="float-right badge bg-danger">842</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('js')
    <script>
        function lihat(parameter_file) {
            // console.log(parameter_file);
            var storage = "{{ asset('storage/uploads/progja/') }}/";
            $('#file').attr('src', storage + parameter_file);
            $('#modal-xl').modal('show')
        }
    </script>
@endsection
