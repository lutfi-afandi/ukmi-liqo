@extends('templateAdminLTE/home')
@section('sub-breadcrumb', 'Halaman Perbarui profil')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Perbarui Profil</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('perbaruiprofil_new') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-2 control-label">Email</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-sm" readonly
                                    value="{{ $user->email }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label">Username</label>
                            <div class="col-md-6">
                                <input type="text"
                                    class="form-control form-control-sm @error('username') is-invalid @enderror"
                                    name="username" value="{{ old('username', $user->username) }}">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label">Nama</label>
                            <div class="col-md-6">
                                <input type="text"
                                    class="form-control form-control-sm @error('nama_pegawai') is-invalid @enderror"
                                    name="nama_pegawai" placeholder="Nama"
                                    value="{{ old('nama_pegawai', $user->pegawai->nama_pegawai) }}">
                                @error('nama_pegawai')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label">Bagian/Divisi</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-sm" readonly
                                    value="{{ $user->pegawai->posisi->nama_posisi }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 control-label">NIK</label>
                            <div class="col-md-6">
                                <input type="text"
                                    class="form-control form-control-sm @error('nik') is-invalid @enderror" name="nik"
                                    placeholder="Nik" value="{{ old('nik', $user->pegawai->nik) }}">
                                @error('nik')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label">No Telpon</label>
                            <div class="col-md-6">
                                <input type="text"
                                    class="form-control form-control-sm @error('telepon_pegawai') is-invalid @enderror"
                                    name="telepon_pegawai" placeholder="No Telepon"
                                    value="{{ old('telepon_pegawai', $user->pegawai->telepon_pegawai) }}">
                                @error('telepon_pegawai')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label">Alamat</label>
                            <div class="col-md-6">
                                <input type="text"
                                    class="form-control form-control-sm @error('alamat_pegawai') is-invalid @enderror"
                                    name="alamat_pegawai" placeholder="Alamat"
                                    value="{{ old('alamat_pegawai', $user->pegawai->alamat_pegawai) }}">
                                @error('alamat_pegawai')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="{{ route('home.index') }}" class="btn btn-xs btn-default"><i
                                        class="fa fa-arrow-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-xs btn-warning">
                                    <i class="fa fa-edit"></i> Perbarui Profil
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
