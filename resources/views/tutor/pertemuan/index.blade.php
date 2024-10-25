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
                    Daftar Pertemuan {{ \Carbon\Carbon::parse($pertemuan->tgl)->translatedFormat('l, d-m-Y') }}
                    <div class="card-tools">
                        <a href="{{ route('tutor.dashboard.index') }}" class="btn btn-sm btn-success">
                            <i class="fa fa-arrow-left"></i> kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped" id="datatableku" style="width: 100%;">
                            <thead class="bg-info">
                                <tr>
                                    <th class="align-middle text-center" rowspan="2">No</th>
                                    <th class="align-middle" rowspan="2">Nama</th>
                                    <th class="align-middle text-center" rowspan="2">Jam Kehadiran</th>
                                    <th class="text-center align-middle" colspan="12">Target Ibadah</th>
                                </tr>
                                <tr>
                                    <th class="text-center align-middle">Sholat Wajib</th>
                                    <th class="text-center align-middle">Tilawah Quran</th>
                                    <th class="text-center align-middle">Sholat Jamaah</th>
                                    <th class="text-center align-middle">Qiyamull Lail</th>
                                    <th class="text-center align-middle">Sholat Dhuha</th>
                                    <th class="text-center align-middle">Sholat Rawatib</th>
                                    <th class="text-center align-middle">Dzikir</th>
                                    <th class="text-center align-middle">Istighfar</th>
                                    <th class="text-center align-middle">Shaum Sunnah</th>
                                    <th class="text-center align-middle">Almatsurat</th>
                                    <th class="text-center align-middle">Baca Buku Islam</th>
                                    <th class="text-center align-middle">Riyadhoh</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesertas as $row)
                                    <tr>
                                        <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                        <td class="align-middle text-nowrap">{{ $row->anggota->nama }}</td>
                                        <td class="align-middle text-center">{{ $row->jam_kehadiran }}</td>
                                        <td class="align-middle text-center">{{ $row->sholat_wajib }}</td>
                                        <td class="align-middle text-center">{{ $row->tilawah_quran }}</td>
                                        <td class="align-middle text-center">{{ $row->sholat_jamaah }}</td>
                                        <td class="align-middle text-center">{{ $row->qiyamull_lail }}</td>
                                        <td class="align-middle text-center">{{ $row->sholat_dhuha }}</td>
                                        <td class="align-middle text-center">{{ $row->sholat_rawatib }}</td>
                                        <td class="align-middle text-center">{{ $row->dzikir }}</td>
                                        <td class="align-middle text-center">{{ $row->istighfar }}</td>
                                        <td class="align-middle text-center">{{ $row->shaum_sunnah }}</td>
                                        <td class="align-middle text-center">{{ $row->almatsurat }}</td>
                                        <td class="align-middle text-center">{{ $row->baca_buku_islam }}</td>
                                        <td class="align-middle text-center">{{ $row->riyadhoh }}</td>
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
