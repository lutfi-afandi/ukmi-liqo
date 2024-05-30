@extends('layout_lte/main')
@php
    $helper = new \App\Helpers\Helper();
@endphp
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title text-lg font-weight-bold">Program Kerja Tahun : {{ $periode->tahun }}</h3>
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
                    @if ($laporan->progja == null)
                        <div class="callout callout-danger">
                            <h5>Belum ada laporan</h5>
                            <p class="font-italic">{{ $laporan->name }} belum mengunggah dokumen Program kerja Periode
                                {{ $periode->tahun }}!</p>
                            <form action="{{ route('divisi.progja.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Pilih File Progja:</label>
                                    <div class="col-sm-8">
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <input type="hidden" name="periode_id" value="{{ $periode->id }}">
                                        <input type="file" class="form-control" id="progja" name="progja"
                                            accept="application/pdf">
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i>
                                            Upload</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        <dl class="row text-md">
                            <dt class="col-sm-3">File Progja</dt>
                            <dd class="col-sm-8">:
                                <a type="button" class="" onclick="lihat('{{ $laporan->progja }}')">
                                    {{ $laporan->progja }} <i class="fas fa-share-square"></i>
                                </a>
                            </dd>
                            <dt class="col-sm-3">Status</dt>
                            <dd class="col-sm-8">:
                                <a type="button" class="text-{!! $helper->bg($laporan->konf_progja) !!}">
                                    {!! $helper->icon($laporan->konf_progja) !!}
                                </a>
                            </dd>

                            <dt class="col-sm-3">Catatan Auditor</dt>
                            <dd class="col-sm-8">:
                                {!! $laporan->ket_progja ?? '<i>belum ada catatan</i>' !!}
                            </dd>

                            <dt class="col-sm-3">Aksi</dt>
                            <dd class="col-sm-8">:
                                @if ($laporan->konf_progja == 'sedang' || $laporan->konf_progja == 'diterima')
                                    done
                                @else
                                    ubah | hapus
                                @endif
                            </dd>

                        </dl>
                    @endif
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

    {{-- modal file --}}
    <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
            <div class="modal-content bg-secondary">
                <div class="modal-header">

                </div>
                <div class="modal-body">
                    <iframe src="" id="file" frameborder="0" width="100%" height="640px"></iframe>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>

    </div>
    {{-- end modal file --}}

    {{-- modal edit --}}
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gradient-primary">
                    <h4 class="modal-title">Update Program Kerja - {{ $laporan->name }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="progja">File Progja</label>
                            <input type="file" class="form-control" id="progja" name="progja"
                                accept="application/pdf">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Update</button>
                    </div>
                </form>

            </div>

        </div>

    </div>
    {{-- end modal edit --}}
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
