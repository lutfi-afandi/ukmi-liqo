@extends('layout_lte.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="callout callout-info">
                <h5> <i class="fas fa-bullhorn"></i> Selamat Datang!</h5>

                <p class="text-info">{{ $tutor->nama }}</p>
            </div>
        </div>

        @foreach ($kelompoks as $kelompok)
            <div class="col-md-3 col-sm-6 col-12">
                <a href="{{ route('tutor.anggota.show', $kelompok->id) }}">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-users-cog"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text text-navy">Kode : {{ $kelompok->kode }}</span>
                            <span class="info-box-number">Anggota : {{ $kelompok->rombel->count() }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </a>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Daftar Pertemuan
                    <div class="card-tools">
                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-default">
                            <i class="fa fa-plus"></i> Buka Pertemuan</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped" id="datatableku">
                            <thead class="bg-info">
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Tempat</th>
                                    <th>Kelompok</th>
                                    <th>Jumlah Hadir</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pertemuans as $pertemuan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($pertemuan->tgl)->translatedFormat('l, d-m-Y') }}
                                        </td>
                                        <td>{{ $pertemuan->tempat }}</td>
                                        <td>{{ $pertemuan->kelompok->kode }}</td>
                                        <td>
                                            <a href="{{ route('tutor.pertemuan.show', $pertemuan->id) }}"
                                                class="badge badge-primary text-sm badge-sm">
                                                {{ $pertemuan->pesertapertemuan->count() }}/{{ $pertemuan->kelompok->rombel->count() }}
                                                {{-- @foreach ($pertemuan->pesertapertemuan as $item)
                                                    {{ $item->anggota->nama }}
                                                @endforeach --}}
                                            </a>
                                        </td>
                                        <td>
                                            @if ($pertemuan->status == 1)
                                                <a href="/tutor/pertemuan/ubahstatus/{{ $pertemuan->id }}"
                                                    class="badge badge-success text-sm badge-sm">
                                                    <i class="fa fa-toggle-on"></i>
                                                </a>
                                            @else
                                                <a href="/tutor/pertemuan/ubahstatus/{{ $pertemuan->id }}"
                                                    class="badge badge-danger text-sm badge-sm">
                                                    <i class="fa fa-toggle-off"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Buka Pertemuan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('tutor.pertemuan.store') }}" method="POST" id="formPertemuan">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kelompok_id">Kelompok</label>
                            <select class="form-control" id="kelompok_id" name="kelompok_id" required>
                                <option value="">Pilih Kelompok</option>
                                @foreach ($kelompoks as $kelompok)
                                    <option value="{{ $kelompok->id }}">{{ $kelompok->kode }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Silakan pilih kelompok.</div>
                        </div>
                        <div class="form-group">
                            <label for="tgl">Tanggal</label>
                            <input type="datetime-local" class="form-control" id="tgl" name="tgl"
                                value="{{ date('Y-m-d\TH:i') }}" required>
                            <div class="invalid-feedback">Tanggal tidak boleh kosong.</div>
                        </div>
                        <div class="form-group">
                            <label for="tempat">Tempat</label>
                            <input type="text" class="form-control" id="tempat" name="tempat" required>
                            <div class="invalid-feedback">Tempat tidak boleh kosong.</div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    @if (session('info'))
        <script>
            toastr.info("{{ session('info') }}");
        </script>
    @endif

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
    </script>
    <script>
        $(document).ready(function() {
            $('#formPertemuan').on('submit', function(event) {
                event.preventDefault();

                let form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: form.serialize(),
                    success: function(response) {
                        window.location.href = response.redirect; // Redirect jika berhasil
                    },
                    error: function(response) {
                        // Jika validasi gagal, tambahkan kelas 'is-invalid' ke elemen form
                        if (response.status === 422) {
                            let errors = response.responseJSON.errors;
                            $.each(errors, function(key, message) {
                                $('#' + key).addClass('is-invalid');
                                $('#' + key).next('.invalid-feedback').text(message[0]);
                            });
                        } else {
                            alert('Terjadi kesalahan saat menyimpan data.');
                        }
                    }
                });
            });

            // Hapus kelas 'is-invalid' saat user mulai mengetik ulang
            $('#formPertemuan input, #formPertemuan select').on('input change', function() {
                $(this).removeClass('is-invalid');
            });
        });
    </script>
@endpush
