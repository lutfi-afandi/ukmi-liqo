@extends('layout_lte/main')
@section('subjudul')
    {{ $title }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('admin.user.index') }}" class="btn btn-success"><i class="fa fa-arrow-left"></i>
                        kembali</a>
                </div>

                <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                    @method('post')
                    @csrf
                    <div class="card-body">

                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="name" placeholder="Masukan name" autofocus autocomplete="false"
                                value="{{ old('name') }}">
                            @error('name')
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
                            <label for="password">Password</label>
                            <input type="text" name="password"
                                class="form-control @error('password') is-invalid @enderror" id="password"
                                placeholder="Masukan password">
                            @error('password')
                                <span class="error invalid-feedback"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select name="level" id="level" class="form-control @error('level') is-invalid @enderror">
                                <option value="" hidden>-Pilih Level-</option>
                                <option value="admin" {{ old('level') == 'admin' ? 'selected' : '' }}>admin</option>
                                <option value="lpm" {{ old('level') == 'lpm' ? 'selected' : '' }}>lpm</option>
                                <option value="divisi" {{ old('level') == 'divisi' ? 'selected' : '' }}>divisi</option>
                            </select>
                            @error('level')
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
@section('js')
    <script>
        $('.form-control').click(function(e) {
            $(this).removeClass('is-invalid');
        });
    </script>
@endsection
