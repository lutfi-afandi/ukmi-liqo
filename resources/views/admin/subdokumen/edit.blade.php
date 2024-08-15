<div class="modal fade" id="modal-ubah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div class="modal-title">Ubah Data</div>
            </div>
            <div class="modal-body">
                {{-- <div class="callout callout-primary">
                    <h5>Perintah tidak dapat dikembalikan!</h5>
                    <p>Yakin hapus dokumen <strong>{{ $sub_dokumen->nama_dokumen }}</strong></p>
                </div> --}}
                <form action="{{ route('admin.sub_dokumen.update', $sub_dokumen->id) }}" method="post" class="d-inline">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_subdok">Nama Dokumen</label>
                        <input type="text" class="form-control" name="nama_subdok"
                            value="{{ $sub_dokumen->nama_subdok }}">
                    </div>
                    <div class="form-group">
                        <label for="file_subdok">File</label>
                        <input type="text" class="form-control" name="file_subdok"
                            value="{{ $sub_dokumen->file_subdok }}" value="{{ $sub_dokumen->file_subdok }}">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            </div>

        </div>

    </div>
</div>
