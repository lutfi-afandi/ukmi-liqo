@extends('layout_lte.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success  ">
                    <h5 class="card-title">Anggota Kelompok : {{ $kelompok->tutor->nama }} [{{ $kelompok->kode }}]
                    </h5>
                    <div class="card-tools">
                        <a href="{{ route('admin.kelompok.index') }}" class="btn btn-sm btn-warning"><i
                                class="fa fa-arrow-left"></i> kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <div id="alert">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                    </div>

                    <table class="table table-bordered table-sm" id="datatableku" width="100%">
                        <thead class="bg-success">
                            <tr>

                                <th><input type="checkbox" id="pilihAll">No</th>
                                <th>NPM</th>
                                <th>Nama Anggota</th>
                                <th>Jurusan</th>
                                <th>Tahun Masuk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rombels as $rombel)
                                <tr>
                                    <!-- Checkbox per baris -->
                                    <td><input type="checkbox" class="checkbox" data-id="{{ $rombel->id }}"> |
                                        {{ $loop->iteration }}</td>
                                    <td>{{ $rombel->anggota->npm }}</td>
                                    <td>{{ $rombel->anggota->nama }}</td>
                                    <td>{{ $rombel->anggota->jurusan->nama }}</td>
                                    <td>{{ $rombel->anggota->tahun_masuk }}</td>
                                    <td>

                                        <form action="{{ route('admin.anggota-kelompok.destroy', $rombel->id) }}"
                                            method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Anggota Ar-Rahman</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>

                </div>

                <div class="card-body">
                    <form action="{{ route('admin.anggota-kelompok.add_anggota', $id_kelompok) }}" method="POST">
                        @csrf
                        <table class="table table-bordered" id="datatableku2" width="100%">
                            <thead class="bg-primary">
                                <tr>

                                    <th>NPM</th>
                                    <th>Nama Anggota</th>
                                    <th>Jurusan</th>
                                    <th>Tahun Masuk</th>
                                    <th><input type="checkbox" id="checkAll"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($anggotas_tanpa_kelompok as $anggota)
                                    <tr>

                                        <td>{{ $anggota->npm }}</td>
                                        <td>{{ $anggota->nama }}</td>
                                        <td>{{ $anggota->jurusan->nama }}</td>
                                        <td>{{ $anggota->tahun_masuk }}</td>
                                        <td>
                                            {{ $loop->iteration }}. <input type="checkbox" name="anggota_id[]"
                                                value="{{ $anggota->id }}" class="anggota-checkbox">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success">Tambahkan Anggota ke Kelompok
                            {{ $kelompok->kode }}</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        setTimeout(function() {
            document.getElementById('alert').innerHTML = '';
        }, 2000);

        // Fungsi untuk select semua checkbox
        $('#checkAll').click(function() {
            $('input[type="checkbox"]').prop('checked', this.checked);
        });

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
            $(function() {
                $('#datatableku2').DataTable({
                    "pageLength": 30,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "responsive": true,
                });
            });

            // css 
            // Handler untuk checkbox per baris anggota
            // Table anggota tanpa kelompok
            $('.anggota-checkbox').on('change', function() {
                // Jika checkbox dicentang
                if ($(this).is(':checked')) {
                    $(this).closest('tr').addClass('table-primary'); // Tambahkan class untuk warna biru
                } else {
                    $(this).closest('tr').removeClass(
                        'table-primary'); // Hapus class jika checkbox tidak dicentang
                }
            });

            // Handler untuk checkbox select all
            $('#checkAll').on('change', function() {
                if ($(this).is(':checked')) {
                    $('.anggota-checkbox').prop('checked', true).closest('tr').addClass('table-primary');
                } else {
                    $('.anggota-checkbox').prop('checked', false).closest('tr').removeClass(
                        'table-primary');
                }
            });

            $('#datatableku2 tbody tr').click(function() {
                // Temukan checkbox di dalam baris tersebut
                var checkbox = $(this).find('.anggota-checkbox');

                // Jika checkbox tidak dipilih, pilih checkbox, dan ubah warna baris
                if (!checkbox.is(':checked')) {
                    checkbox.prop('checked', true);
                    $(this).addClass('table-primary');
                } else {
                    // Jika checkbox sudah dipilih, hilangkan pilihan dan warna baris
                    checkbox.prop('checked', false);
                    $(this).removeClass('table-primary');
                }
            });

            // Supaya tidak terjadi double klik di checkbox
            $('.anggota-checkbox').click(function(e) {
                e.stopPropagation();
            });
            // Table anggota tanpa kelompok

            // table anggota dengan kelompok
            // Klik baris untuk memilih tanpa harus klik langsung checkbox
            $('#datatableku tbody').on('click', 'tr', function(e) {
                if (e.target.type !== 'checkbox') {
                    var checkbox = $(this).find('input.checkbox');
                    checkbox.prop('checked', !checkbox.prop('checked'));
                }
                $(this).toggleClass('table-success');
            });

            // Pilih semua checkbox
            $('#pilihAll').on('click', function() {
                var checked = $(this).is(':checked');
                $('.checkbox').prop('checked', checked);
                $('#datatableku tbody tr').toggleClass('table-success', checked);
            });

            // Pilih semua checkbox jika checkbox pilih semua diklik
            $('#pilihAll').click(function() {
                $('.checkbox').prop('checked', this.checked);
                $('.checkbox').closest('tr').toggleClass('table-success', this.checked);
            });

            // Hapus data yang terpilih
            $('#deleteSelected').click(function(e) {
                e.preventDefault();

                // Ambil ID anggota yang dipilih
                var selectedIds = $('.checkbox:checked').map(function() {
                    return $(this).data('id');
                }).get();

                if (selectedIds.length === 0) {
                    alert('Pilih setidaknya satu anggota untuk dihapus.');
                    return;
                }

                // Kirim permintaan penghapusan menggunakan AJAX
                $.ajax({
                    url: "{{ route('admin.anggota-kelompok.hapus') }}", // Rute untuk penghapusan
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}", // Token CSRF untuk keamanan
                        ids: selectedIds
                    },
                    success: function(response) {
                        alert('Data berhasil dihapus.');
                        location.reload(); // Segarkan halaman setelah penghapusan
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                });
            });
        });
    </script>
@endpush
