@extends('layout_lte.main')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="info-box p-2 pl-3">

                <div class="info-box-content m">
                    <h4 class="info-box-number mb-0">Unggah Laporan</h4>
                    <h5 class="info-box-text font-weight-light">Lembaga Penjamin Mutu</h5>
                </div>
                <div class="info-box-button pt-2 pr-3">
                    <a href="{{ route('admin.laporan.index') }}" class="btn btn-info"><i class="fas fa-home"></i>
                        Beranda</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="" id="form-search" method="post">

                <div class="row">
                    <div id="alert">
                        @if (session()->has('msgs'))
                            <div class="alert {{ session('class') }}">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ session('msgs') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-4 mt-1">
                        <select name="user_id" id="user_id" class="form-control select2bs4" style="width: 100%;" required>
                            <option value="" hidden>-Pilih Bagian-</option>
                            @foreach ($divisis as $divisi)
                                <option value="{{ $divisi->id }}">{{ $divisi->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4 mt-1">
                        <select name="periode_id" id="periode_id" class="form-control" required>
                            <option value="">-Pilih Periode-</option>
                            @foreach ($periode as $item)
                                <option value="{{ $item->id }}">{{ $item->tahun }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4 mt-1">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
            </form>
        </div>
    </div>
    </div>


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

        $('#form-search').submit(function(e) {
            e.preventDefault();

        });
    </script>
@endsection
