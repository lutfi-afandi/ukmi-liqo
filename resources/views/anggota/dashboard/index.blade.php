@extends('layout_lte.main')
@section('content')
    <style>
        .pulse {
            animation: pulse 1.8s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(.9);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>
    @php
        // dd($kehadiran->isEmpty());
    @endphp

    <div class="row">
        <div class="col-md-12">
            <div class="callout callout-info">
                <h5> <i class="fas fa-bullhorn"></i> Selamat Datang!</h5>

                <p class="text-info">{{ $anggota->nama }} - {{ $anggota->npm }}</p>
            </div>
        </div>
        <div class="col-md-4 col-sm-12 col-12">
            @if ($kehadiran->isEmpty())
                <a href="{{ route('anggota.peserta-pertemuan.show', $pertemuan->id) }}">
            @endif
            <div class="info-box {{ $kehadiran->isEmpty() ? 'pulse' : '' }}">
                <span class="info-box-icon bg-{{ $kehadiran->isEmpty() ? 'danger' : 'success' }}">
                    <i class="fas fa-exclamation"></i>
                </span>

                <div class="info-box-content">
                    <span class="info-box-text text-navy">Kode : {{ $peserta->kelompok->kode }}</span>
                    <span class="info-box-number py-0 mt-0">
                        {{ \Carbon\Carbon::parse($pertemuan->tgl)->translatedFormat('l, j F Y') }}</span>
                    <span class="info-box-number mt-0">{{ $pertemuan->tempat }}

                        <span class="text-xs badge badge-{{ $kehadiran->isEmpty() ? 'danger' : 'success' }}">
                            <i class=" fa fa-{{ $kehadiran->isEmpty() ? 'times' : 'check' }}"></i>
                            {{ $kehadiran->isEmpty() ? 'belum isi' : 'sudah isi' }}</span>

                    </span>
                </div>
            </div>
            @if ($kehadiran->isEmpty())
                </a>
            @endif
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Daftar Absen
                </div>
                <div class="card-body">
                    <div class=""id="alert">
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-striped" id="datatableku" style="width: 100%;">
                            <thead class="bg-info">
                                <tr>
                                    <th class="align-middle text-center" rowspan="2">No</th>
                                    <th class="align-middle" rowspan="2">Tanggal</th>
                                    <th class="align-middle text-center" rowspan="2">Jam Kehadiran</th>
                                    <th class="text-center align-middle" colspan="12">Target Ibadah</th>
                                </tr>
                                <tr>
                                    <th class="text-center align-middle">Sholat Wajib
                                        {{-- <span class="text-xs">(35x)</span> --}}
                                    </th>
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
                                @foreach ($pertemuans as $item)
                                    <tr>
                                        <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                        <td class="align-middle text-nowrap">
                                            {{ \Carbon\Carbon::parse($item->tgl)->translatedFormat('j F Y') }}
                                        </td>
                                        <td class="align-middle text-center">{{ $item->jam_kehadiran }}</td>
                                        <td class="align-middle text-center">{{ $item->sholat_wajib }}</td>
                                        <td class="align-middle text-center">{{ $item->tilawah_quran }}</td>
                                        <td class="align-middle text-center">{{ $item->sholat_jamaah }}</td>
                                        <td class="align-middle text-center">{{ $item->qiyamull_lail }}</td>
                                        <td class="align-middle text-center">{{ $item->sholat_dhuha }}</td>
                                        <td class="align-middle text-center">{{ $item->sholat_rawatib }}</td>
                                        <td class="align-middle text-center">{{ $item->dzikir }}</td>
                                        <td class="align-middle text-center">{{ $item->istighfar }}</td>
                                        <td class="align-middle text-center">{{ $item->shaum_sunnah }}</td>
                                        <td class="align-middle text-center">{{ $item->almatsurat }}</td>
                                        <td class="align-middle text-center">{{ $item->baca_buku_islam }}</td>
                                        <td class="align-middle text-center">{{ $item->riyadhoh }}</td>
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
                    "responsive": false,
                });
            });
        });
    </script>
@endpush
