@extends('layout_lte/main')
@php
    $helper = new \App\Helpers\Helper();
@endphp
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-gradient-primary d-flex justify-content-center">
                    <center>
                        <h3 class="card-title text-uppercase font-weight-bold">{{ $title }} Periode : <span
                                class="judul"></span></h3>
                    </center>


                </div>

                <div class="card-body">
                    <div class="select-tahun text-center form-group">
                        <label>Periode:</label>
                        <select id="periode_id">
                            <option value="">-Pilih Tahun-</option>
                            @foreach ($periode as $p)
                                <option value="{{ $p->id }}">{{ $p->tahun }}</option>
                            @endforeach
                        </select>
                        <button onclick="reset_periode()" class="bg-info border-0 rounded-sm"><i
                                class="fas fa-sync-alt"></i>
                            reload</button>
                    </div>

                    <div id="alert">
                        @if (session()->has('msg'))
                            <div class="alert {{ session('class') }}">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ session('msg') }}
                            </div>
                        @endif
                    </div>

                    <div id="tabel-laporan"></div>
                </div>
            </div>
        </div>

    </div>

    <div id="tempat-modal"></div>
@endsection
@section('js')
    <script>
        setTimeout(function() {
            document.getElementById('alert').innerHTML = '';
        }, 2000);
        $(document).ready(function() {
            $(function() {
                $('#tableperiode').DataTable({
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "responsive": true,
                });
            });

        });
    </script>
    <script>
        $('.select-tahun').change(function(e) {
            var periode_id = $('#periode_id').val();
            var url = "{{ route('admin.laporan.tampil') }}";
            $.ajax({
                type: "post",
                url: url,
                data: {
                    _token: "{{ csrf_token() }}",
                    periode_id: periode_id
                },
                dataType: "json",
                beforeSend: function() {
                    $('#tabel-laporan').html(
                        '<center><i class="fa fa-spinner fa-spin"></i> Memuat...</center>');
                },
                success: function(response) {
                    // console.log('ok');
                    $('.judul').html(response.periode);
                    $('#tabel-laporan').html(response.html);
                }
            });

        });

        function reset_periode() {
            var periode_id = $('#periode_id').val();
            var url = "{{ route('admin.laporan.tampil') }}";
            if (periode_id != '') {
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        _token: "{{ csrf_token() }}",
                        periode_id: periode_id
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $('#tabel-laporan').html(
                            '<center><i class="fa fa-spinner fa-spin"></i> Memuat...</center>');
                    },
                    success: function(response) {
                        // console.log('ok');
                        $('.judul').html(response.periode);
                        $('#tabel-laporan').html(response.html);
                    }
                });
            } else {

            }

        }
    </script>
@endsection
