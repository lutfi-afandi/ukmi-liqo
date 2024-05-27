@extends('layout_lte/main')
@section('subjudul')
    {{ $title }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('admin.penetapan.index') }}" class="btn btn-success"><i class="fa fa-arrow-left"></i>
                        kembali</a>
                </div>

                <form action="{{ route('admin.penetapan.store') }}" method="POST" enctype="multipart/form-data">
                    @method('post')
                    @csrf
                    <div class="card-body">

                        <div class="form-group">
                            <label for="nama_standar">Nama Dokumen</label>
                            <input type="text" name="nama_standar"
                                class="form-control @error('nama_standar') is-invalid @enderror" id="nama_penetapan"
                                nama_standar placeholder="Masukan nama_standar" autofocus autocomplete="false"
                                value="{{ old('nama_standar') }}">
                            @error('nama_standar')
                                <span class="error invalid-feedback"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tgl_penetapan">Tanggal Penetapan</label>
                            <input type="date" name="tgl_penetapan"
                                class="form-control @error('tgl_penetapan') is-invalid @enderror" id="tgl_penetapan"
                                placeholder="Masukan tgl_penetapan" value="{{ old('tgl_penetapan') }}">
                            @error('tgl_penetapan')
                                <span class="error invalid-feedback"> {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kategori_id">Kategori</label>
                            <select name="kategori_id" id="kategori_id"
                                class="form-control select2bs4 @error('kategori_id') is-invalid @enderror">
                                <option value="" hidden>-Pilih Kategori-</option>
                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}"
                                        {{ old('kategori_id') == $kat->id ? 'selected' : '' }} {}>{{ $kat->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <span class="error invalid-feedback"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="file_standar">File Standar</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="form-control " name="file_standar" accept=".pdf">
                                </div>

                            </div>
                            @error('file_standar')
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
