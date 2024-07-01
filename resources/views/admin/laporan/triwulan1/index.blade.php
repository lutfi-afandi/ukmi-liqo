@extends('layout_lte/main')
@php
    $helper = new \App\Helpers\Helper();
@endphp
@section('head')
    <link rel="stylesheet" href="{{ asset('template_lte/plugins/summernote/summernote-bs4.min.css') }}">
@endsection
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
                    <h5 class="info-box-text font-weight-light">{{ $user->name }}</h4>
                </div>
                <div class="info-box-button">
                    <a href="{{ route('admin.laporan.index') }}" class="btn btn-info btn-lg"><i
                            class="fas fa-chevron-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card card-primary ">

                <div class="card-body">
                    <iframe src="{{ $triwulan1->file_tw1 }}" width="100%" height="840px" frameborder="0"></iframe>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-widget widget-user-2 shadow-sm">

                <div class="widget-user-header bg-info">
                    Laporan
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
                    <div class="form-group">
                        <label>Tanggal Upload Berkas : </label>
                        <input type="text" class="form-control form-control-border"
                            value="{{ date('d/m/Y H:i', strtotime($triwulan1->tgl_upload)) }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Diterima Berkas : </label>
                        <input type="text" class="form-control form-control-border"
                            value="{{ $triwulan1->tgl_konf != null ? date('d/m/Y H:i', strtotime($triwulan1->tgl_konf)) : '' }}"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label>Status : </label>
                        <input type="text" class="form-control form-control-border" value="{{ $triwulan1->konf }}"
                            readonly>
                    </div>
                    <form action="{{ route('admin.triwulan1.update', ['triwulan1' => $triwulan1->id]) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label>Set Status:</label>
                            <select class="form-control" name="konf" required>
                                <option value="" hidden>-Pilih Status-</option>
                                <option value="sedang" {{ $triwulan1->konf == 'sedang' ? 'selected' : '' }}>
                                    diperiksa
                                </option>
                                <option {{ $triwulan1->konf == 'diterima' ? 'selected' : '' }}>diterima</option>
                                <option {{ $triwulan1->konf == 'ditolak' ? 'selected' : '' }}>ditolak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Catatan Aditor:</label>
                            <textarea id="summernote" name="ket" placeholder="catatan Auditor">
                                {!! $triwulan1->ket ?? '' !!}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-paper-plane"></i>
                                Kirim</button>
                        </div>

                    </form>
                </div>
                <div class="card-footer p-0">
                </div>
            </div>

        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('template_lte/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        function lihat(parameter_file) {
            // console.log(parameter_file);
            var storage = "{{ asset('storage/uploads/file_tw1/') }}/";
            $('#file').attr('src', storage + parameter_file);
            $('#modal-xl').modal('show')
        }
    </script>
    <script>
        $(function() {
            // Summernote
            $('#summernote').summernote({
                height: 270,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['view', ['fullscreen']]
                ]
            })
        })
    </script>
@endsection
