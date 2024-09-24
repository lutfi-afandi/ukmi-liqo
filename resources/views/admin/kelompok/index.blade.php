@extends('layout_lte.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-body">
                    <form id="form-kelompok" method="post" class="row">
                        @csrf {{-- Token CSRF Laravel --}}
                        <div class="form-group col-md-12">
                            <label for="">Kode Kelompok</label>
                            <input type="text" class="form-control" name="kode" id="kode" readonly>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">Tutor</label>
                            <select class="form-control select2bs4" name="tutor_id" id="tutor_id" width="100%">
                                <option value="" hidden>-Pilih Tutor-</option>
                                @foreach ($tutors as $tutor)
                                    <option value="{{ $tutor->id }}" data-jk="{{ $tutor->jenis_kelamin }}">
                                        {{ $tutor->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="error-tutor_id"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Tahun Masuk</label>
                            <select name="tahun_dibentuk" class="form-control" id="tahun_dibentuk">
                                <option value="" hidden>-Pilih Tahun Masuk-</option>
                                @for ($tahun = date('Y'); $tahun >= 2015; $tahun--)
                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                @endfor
                            </select>
                            <div class="invalid-feedback" id="error-tahun_dibentuk"></div>
                        </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('js')
    <script>
        function generateKode(jenisKelamin, tahunDibentuk) {
            if (jenisKelamin && tahunDibentuk) {

                var url = "{{ route('admin.kelompok.generate-kode', ['jk' => ':jk', 'tahun' => ':tahun']) }}";
                url = url.replace(':jk', jenisKelamin).replace(':tahun', tahunDibentuk);

                // console.log(jenisKelamin, tahunDibentuk);

                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    success: function(response) {
                        // console.log(response.data);
                        $('#kode').val(response.data);
                    }
                });
            }
        }

        $('#tutor_id').change(function() {
            var selectedOption = $(this).find(':selected');
            var jenisKelamin = selectedOption.data('jk');
            var tahunDibentuk = $('#tahun_dibentuk').val();
            generateKode(jenisKelamin, tahunDibentuk);
        });

        $('#tahun_dibentuk').change(function() {
            var tahunDibentuk = $(this).val();
            var selectedOption = $('#tutor_id').find(':selected');
            var jenisKelamin = selectedOption.data('jk');
            generateKode(jenisKelamin, tahunDibentuk);
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#form-kelompok').on('submit', function(e) {
                e.preventDefault();

                // Bersihkan pesan error sebelumnya
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').text('');

                // Ambil data form
                var formData = {
                    kode: $('#kode').val(),
                    tutor_id: $('#tutor_id').val(),
                    tahun_dibentuk: $('#tahun_dibentuk').val(),
                    _token: '{{ csrf_token() }}'
                };

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.kelompok.store') }}",
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Kelompok berhasil disimpan!');
                            $('#form-kelompok')[0].reset();

                            // Optional: jika menggunakan select2, reset kembali select2
                            $('#tutor_id').val(null).trigger('change');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) { // Validasi error
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('#' + key).addClass('is-invalid');
                                $('#error-' + key).text(value[0]);
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
