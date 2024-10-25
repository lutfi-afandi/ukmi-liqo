@extends('layout_lte.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Form Mutabaah
                    <div class="card-tools">
                        <a href="{{ route('anggota.dashboard.index') }}" class="btn btn-sm btn-primary">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('anggota.peserta-pertemuan.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="pertemuan_id" value="{{ $pertemuan->id }}">
                        <input type="hidden" name="anggota_id" value="{{ $anggota->id }}">

                        <div class="form-group">
                            <label for="jam_kehadiran">Jam Kehadiran</label>
                            <input type="time" class="form-control @error('jam_kehadiran') is-invalid @enderror"
                                id="jam_kehadiran" name="jam_kehadiran" value="{{ old('jam_kehadiran') }}" required>
                            @error('jam_kehadiran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="sholat_wajib">Sholat Wajib</label>
                            <input type="number" class="form-control @error('sholat_wajib') is-invalid @enderror"
                                id="sholat_wajib" name="sholat_wajib" value="{{ old('sholat_wajib') }}" required>
                            @error('sholat_wajib')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tilawah_quran">Tilawah Quran</label>
                            <input type="number" class="form-control @error('tilawah_quran') is-invalid @enderror"
                                id="tilawah_quran" name="tilawah_quran" value="{{ old('tilawah_quran') }}" required>
                            @error('tilawah_quran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="sholat_jamaah">Sholat Jamaah</label>
                            <input type="number" class="form-control @error('sholat_jamaah') is-invalid @enderror"
                                id="sholat_jamaah" name="sholat_jamaah" value="{{ old('sholat_jamaah') }}" required>
                            @error('sholat_jamaah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="qiyamull_lail">Qiyamull Lail</label>
                            <input type="number" class="form-control @error('qiyamull_lail') is-invalid @enderror"
                                id="qiyamull_lail" name="qiyamull_lail" value="{{ old('qiyamull_lail') }}" required>
                            @error('qiyamull_lail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="sholat_dhuha">Sholat Dhuha</label>
                            <input type="number" class="form-control @error('sholat_dhuha') is-invalid @enderror"
                                id="sholat_dhuha" name="sholat_dhuha" value="{{ old('sholat_dhuha') }}" required>
                            @error('sholat_dhuha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="sholat_rawatib">Sholat Rawatib</label>
                            <input type="number" class="form-control @error('sholat_rawatib') is-invalid @enderror"
                                id="sholat_rawatib" name="sholat_rawatib" value="{{ old('sholat_rawatib') }}" required>
                            @error('sholat_rawatib')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="dzikir">Dzikir</label>
                            <input type="number" class="form-control @error('dzikir') is-invalid @enderror" id="dzikir"
                                name="dzikir" value="{{ old('dzikir') }}" required>
                            @error('dzikir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="istighfar">Istighfar</label>
                            <input type="number" class="form-control @error('istighfar') is-invalid @enderror"
                                id="istighfar" name="istighfar" value="{{ old('istighfar') }}" required>
                            @error('istighfar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="shaum_sunnah">Shaum Sunnah</label>
                            <input type="number" class="form-control @error('shaum_sunnah') is-invalid @enderror"
                                id="shaum_sunnah" name="shaum_sunnah" value="{{ old('shaum_sunnah') }}" required>
                            @error('shaum_sunnah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="almatsurat">Al-Matsurat</label>
                            <input type="number" class="form-control @error('almatsurat') is-invalid @enderror"
                                id="almatsurat" name="almatsurat" value="{{ old('almatsurat') }}" required>
                            @error('almatsurat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="baca_buku_islam">Baca Buku Islam</label>
                            <input type="number" class="form-control @error('baca_buku_islam') is-invalid @enderror"
                                id="baca_buku_islam" name="baca_buku_islam" value="{{ old('baca_buku_islam') }}"
                                required>
                            @error('baca_buku_islam')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="riyadhoh">Riyadhoh</label>
                            <input type="number" class="form-control @error('riyadhoh') is-invalid @enderror"
                                id="riyadhoh" name="riyadhoh" value="{{ old('riyadhoh') }}" required>
                            @error('riyadhoh')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
