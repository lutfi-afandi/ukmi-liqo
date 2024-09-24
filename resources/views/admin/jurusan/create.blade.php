<div class="modal fade modal-alert modal-warning in" id="modal_create" role="dialog" style="padding:0;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                Tambah Data Jurusan
            </div>
            <form action="{{ route('admin.jurusan.store') }}" id="form-edit" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kode">Kode Jurusan</label>
                        <input type="text" name="kode" class="form-control @error('kode') is-invalid @enderror"
                            id="kode" placeholder="Masukan kode" autocomplete="false" value="{{ old('kode') }}">
                        @error('kode')
                            <span class="error invalid-feedback"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Jurusan</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                            id="nama" placeholder="Masukan nama" autofocus autocomplete="false"
                            value="{{ old('nama') }}">
                        @error('nama')
                            <span class="error invalid-feedback"> {{ $message }}</span>
                        @enderror
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
