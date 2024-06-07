@extends('layout_lte/main')
@php
    $helper = new \App\Helpers\Helper();

    if ($laporan == null) {
        $rute = '#';
        $rute_re = '#';
    } else {
        $rute = route('divisi.progja.update', ['progja' => $laporan->id]);
        $rute_re = route('divisi.progja.reupload', ['progja' => $laporan->id]);
    }
@endphp
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="info-box p-4">
                <svg width="72px" height="72px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <title>Stockholm-icons / Communication / Clipboard-check</title>
                    <desc>Created with Sketch.</desc>
                    <defs></defs>
                    <g id="Stockholm-icons-/-Communication-/-Clipboard-check" stroke="none" stroke-width="1" fill="none"
                        fill-rule="evenodd">
                        <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                        <path
                            d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                            id="Combined-Shape" fill="#000000" opacity="0.3"></path>
                        <path
                            d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z"
                            id="check-path" fill="#000000"></path>
                        <path
                            d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                            id="Combined-Shape" fill="#000000"></path>
                    </g>
                </svg>
                <div class="info-box-content">
                    <h4 class="info-box-number mb-0">Detail Program Kerja</h4>
                    <h5 class="info-box-text font-weight-light">{{ $user->name }}</h5>
                </div>
                <div class="info-box-button">
                    <a href="{{ route('divisi.dashboard.index') }}" class="btn btn-info btn-lg"><i
                            class="fas fa-chevron-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10">
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
                    @if ($laporan == null)
                        <div class="callout callout-danger">
                            <h5>Belum ada laporan</h5>
                            <p class="font-italic">{{ $user->name }} belum mengunggah dokumen Program kerja Periode
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

                            <dt class="col-sm-3">Tanggal Upload</dt>
                            <dd class="col-sm-8">:
                                <a type="button">
                                    {{ date('d/m/Y', strtotime($laporan->tgl_upload_progja)) }}
                                </a>
                            </dd>

                            <dt class="col-sm-3">Tanggal Konfirmasi</dt>
                            <dd class="col-sm-8">:
                                <a type="button">
                                    {{ $laporan->konf_progja == 'diterima' ? date('d/m/Y', strtotime($laporan->tgl_konf_progja)) : '' }}
                                </a>
                            </dd>

                            <dt class="col-sm-3">Catatan Auditor</dt>
                            <dd class="col-sm-8 d-inline-flex">:
                                <div class="callout callout-danger w-100">
                                    {!! $laporan->ket_progja ?? '<i>belum ada catatan</i>' !!}
                                </div>
                            </dd>

                            <dt class="col-sm-3">Aksi</dt>
                            <dd class="col-sm-8">:
                                @if ($laporan->konf_progja == 'diterima')
                                    <i class="fas fa-check-circle"></i> selesai
                                @elseif($laporan->konf_progja == 'sedang')
                                    <i class="fas fa-info-circle fa-beat text-info"></i> Menunggu pemeriksaan dari LPM
                                @elseif($laporan->konf_progja == 'belum')
                                    <button type="button" class="btn btn-info btn-sm"
                                        onclick="ubah('{{ $laporan->id }}')">
                                        <i class="far fa-edit"></i> ubah
                                    </button>
                                @else
                                    <button type="button" class="btn btn-info btn-sm"
                                        onclick="reupload('{{ $laporan->id }}')">
                                        <i class="fas fa-retweet"></i> reupload
                                    </button>
                                @endif
                                <button type="button" class="btn bg-navy btn-sm"
                                    onclick="riwayat('{{ $laporan->id }}')">
                                    <i class="fas fa-history"></i> Riwayat
                                </button>

                            </dd>

                        </dl>
                    @endif
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
                    <h4 class="modal-title">Update Program Kerja - {{ $user->name }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ $rute }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="progja">File Progja</label>
                            <input type="hidden" name="laporan_id" id="laporan_id_ubah">
                            <input type="file" class="form-control" id="progja" name="progja"
                                accept="application/pdf">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-upload"></i>
                            Update</button>
                    </div>
                </form>

            </div>

        </div>

    </div>
    {{-- end modal edit --}}

    {{-- modal reupload --}}
    <div class="modal fade" id="modal-reupload">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gradient-navy">
                    <h4 class="modal-title">Reupload Program Kerja - {{ $user->name }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ $rute_re }}" method="post" enctype="multipart/form-data">
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
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-upload"></i>
                            Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end modal reupload --}}

    {{-- modal riwayat --}}
    <div id="list-riwayat"></div>
    {{-- end modal riwayat --}}
@endsection
@section('js')
    <script>
        function lihat(parameter_file) {
            // console.log(parameter_file);
            var storage = "{{ asset('storage/uploads/progja/') }}/";
            $('#file').attr('src', storage + parameter_file);
            $('#modal-xl').modal('show')
        }

        function ubah(param_id) {
            $('#laporan_id_ubah').val(param_id);
            $('#modal-edit').modal('show')
        }

        function reupload(param_id) {
            $('#laporan_id_ubah').val(param_id);
            $('#modal-reupload').modal('show')
        }

        function riwayat(param_id) {
            var url = "{{ route('divisi.progja.riwayat', ':id') }}";
            url = url.replace(":id", param_id);

            $.ajax({
                type: "get",
                url: url,
                dataType: "JSON",
                success: function(response) {
                    $('#list-riwayat').html(response.html);
                    $('#modal-riwayat').modal('show')
                }
            });
        }
    </script>
@endsection
