<div class="modal fade" id="modal-ubah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div class="modal-title">Ubah Data</div>
            </div>
            <div class="modal-body">
                {{-- <div class="callout callout-primary">
                    <h5>Perintah tidak dapat dikembalikan!</h5>
                    <p>Yakin hapus sop <strong>{{ $subsop->nama_sop }}</strong></p>
                </div> --}}
                <form action="{{ route('admin.subsop.update', $subsop->id) }}" method="post" class="d-inline">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_subsop">Nama</label>
                        <input type="text" class="form-control" name="nama_subsop"
                            value="{{ $subsop->nama_subsop }}">
                    </div>
                    <div class="form-group">
                        <label for="file_subsop">File</label>
                        <input type="text" class="form-control" name="file_subsop" value="{{ $subsop->file_subsop }}"
                            value="{{ $subsop->file_subsop }}">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            </div>

        </div>

    </div>
</div>
