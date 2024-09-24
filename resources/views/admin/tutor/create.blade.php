@extends('layout_lte/main')
@section('subjudul')
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    {{ $title }}
                    <div class="card-tools">
                        <a href="{{ route('admin.tutor.index') }}" class="btn btn-success"><i class="fa fa-arrow-left"></i>
                            kembali</a>
                    </div>
                </div>

                <form action="{{ route('admin.tutor.store') }}" method="POST" enctype="multipart/form-data">
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

                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control @error('name') is-invalid @enderror"
                                id="nama" placeholder="Masukan nama" autofocus autocomplete="false"
                                value="{{ old('nama') }}">
                            @error('nama')
                                <span class="error invalid-feedback"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username"
                                class="form-control @error('username') is-invalid @enderror" id="username"
                                placeholder="Masukan username" value="{{ old('username') }}">
                            @error('username')
                                <span class="error invalid-feedback"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select type="text" name="jenis_kelamin"
                                class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin"
                                placeholder="Masukan jenis_kelamin" value="{{ old('jenis_kelamin') }}">
                                <option value="" hidden>-Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>
                                    Laki-Laki
                                </option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <span class="error invalid-feedback"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_telepon">Nomor Telepon</label>
                            <input type="text" name="no_telepon"
                                class="form-control @error('no_telepon') is-invalid @enderror" id="no_telepon"
                                placeholder="Masukan no_telepon" value="{{ old('no_telepon') }}">
                            @error('no_telepon')
                                <span class="error invalid-feedback"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" name="password"
                                class="form-control @error('password') is-invalid @enderror" id="password"
                                placeholder="Masukan password">
                            @error('password')
                                <span class="error invalid-feedback"> {{ $message }}</span>
                            @enderror
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
