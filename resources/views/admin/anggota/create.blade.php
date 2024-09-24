@extends('layout_lte/main')
@section('subjudul')
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    {{ $title }}
                    <div class="card-tools">
                        <a href="{{ route('admin.anggota.index') }}" class="btn btn-success"><i class="fa fa-arrow-left"></i>
                            kembali</a>
                    </div>
                </div>

                <form action="{{ route('admin.anggota.store') }}" method="POST" enctype="multipart/form-data"
                    class="form-horizontal">
                    @method('post')
                    @csrf
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama"
                                    class="form-control @error('name') is-invalid @enderror" id="nama"
                                    placeholder="Masukan nama" autofocus autocomplete="false" value="{{ old('nama') }}">
                                @error('nama')
                                    <span class="error invalid-feedback"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="npm" class="col-sm-2 col-form-label">NPM</label>
                            <div class="col-sm-10">
                                <input type="text" name="npm" class="form-control @error('npm') is-invalid @enderror"
                                    id="npm" placeholder="Masukan npm" value="{{ old('npm') }}">
                                @error('npm')
                                    <span class="error invalid-feedback"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tahun_masuk" class="col-sm-2 col-form-label">Tahun Masuk</label>
                            <div class="col-sm-10">
                                <select name="tahun_masuk" class="form-control @error('tahun_masuk') is-invalid @enderror"
                                    id="tahun_masuk">
                                    <option value="" hidden>-Pilih Tahun Masuk-</option>
                                    @for ($tahun = date('Y'); $tahun >= 2015; $tahun--)
                                        <option value="{{ $tahun }}"
                                            {{ old('tahun_masuk') == $tahun ? 'selected' : '' }}>{{ $tahun }}
                                        </option>
                                    @endfor
                                </select>
                                @error('tahun_masuk')
                                    <span class="error invalid-feedback"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select name="jenis_kelamin"
                                    class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin">
                                    <option value="" hidden>-Pilih Jenis Kelamin</option>
                                    <option value="Laki-Laki" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>
                                        Laki-Laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <span class="error invalid-feedback"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jurusan_id" class="col-sm-2 col-form-label">Jurusan</label>
                            <div class="col-sm-10">
                                <select name="jurusan_id"
                                    class="form-control select2bs4 @error('jurusan_id') is-invalid @enderror"
                                    id="jurusan_id">
                                    <option value="" hidden>-Pilih Jurusan-</option>
                                    @foreach ($jurusans as $jurusan)
                                        <option value="{{ $jurusan->id }}"
                                            {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jurusan_id')
                                    <span class="error invalid-feedback"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="no_telepon" class="col-sm-2 col-form-label">Nomor Telepon</label>
                            <div class="col-sm-10">
                                <input type="text" name="no_telepon"
                                    class="form-control @error('no_telepon') is-invalid @enderror" id="no_telepon"
                                    placeholder="Masukan nomor telepon" value="{{ old('no_telepon') }}">
                                @error('no_telepon')
                                    <span class="error invalid-feedback"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i>
                            Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('.form-control').click(function(e) {
            $(this).removeClass('is-invalid');
        });
    </script>
@endpush
