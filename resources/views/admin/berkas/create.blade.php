@extends('layout_lte.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="card-title">
                        Form Tambah Berkas
                    </div>
                </div>
                <form action="{{ route('admin.berkas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_berkas">Nama Berkas:</label>
                            <input type="text" class="form-control @error('nama_berkas') is-invalid @enderror"
                                name="nama_berkas" id="nama_berkas" placeholder="..." value="{{ old('nama_berkas') }}">
                            @error('nama_berkas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kategori_id">Kategori:</label>
                            <select name="kategori_id" id="kategori_id"
                                class="form-control @error('kategori_id') is-invalid @enderror">
                                <option value="">-Pilih-</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id }}"
                                        {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="periode_id">Periode:</label>
                            <select name="periode_id" id="periode_id"
                                class="form-control @error('periode_id') is-invalid @enderror">
                                <option value="">-Pilih-</option>
                                @foreach ($periode as $p)
                                    <option value="{{ $p->periode_id }}" {{ $p->tahun == $tahun_ini ? 'selected' : '' }}>
                                        {{ $p->tahun }}</option>
                                @endforeach
                            </select>
                            @error('periode_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="file">File Berkas:</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" name="file"
                                id="file" accept="application/pdf">
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
