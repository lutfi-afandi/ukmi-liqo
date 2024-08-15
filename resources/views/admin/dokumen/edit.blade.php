<div class="modal fade" id="modal-ubah">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div class="modal-title">Ubah Data</div>
            </div>
            <div class="modal-body">
                {{-- <div class="callout callout-primary">
                    <h5>Perintah tidak dapat dikembalikan!</h5>
                    <p>Yakin hapus dokumen <strong>{{ $dokumen->nama_dokumen }}</strong></p>
                </div> --}}
                <form action="{{ route('admin.dokumen.update', $dokumen->id) }}" method="post" class="d-inline">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_dokumen">Nama Dokumen</label>
                        <input type="text" class="form-control" name="nama_dokumen"
                            value="{{ $dokumen->nama_dokumen }}">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            </div>

        </div>

    </div>
</div>
