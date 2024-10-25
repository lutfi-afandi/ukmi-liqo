@extends('layout_lte.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="callout callout-info">
                <h5> <i class="fas fa-bullhorn"></i> {{ $title }}</h5>

                <p class="text-info"></p>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Daftar Anggota
                    <div class="card-tools">
                        <a href="{{ route('tutor.dashboard.index') }}" class="btn btn-sm btn-success">
                            <i class="fa fa-arrow-left"></i> kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered" id="datatableku" width="100%">
                            <thead class="bg-navy">
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Kontak</th>
                                    <th>Tahun Masuk</th>
                                    <th>Jurusan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($anggotas as $row)
                                    <tr class="">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->anggota->npm }}</td>
                                        <td>{{ $row->anggota->nama }}</td>
                                        <td>{{ $row->anggota->jenis_kelamin }}</td>
                                        <td>{{ $row->anggota->no_telepon }}</td>
                                        <td>{{ $row->anggota->tahun_masuk }}</td>
                                        <td>{{ $row->anggota->jurusan->nama ?? '' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $(function() {
                $('#datatableku').DataTable({
                    "pageLength": 30,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "responsive": true,
                });
            });
        });

        function refresh() {
            // 
        }

        function tampilPeserta() {
            // 
        }
    </script>
@endpush
