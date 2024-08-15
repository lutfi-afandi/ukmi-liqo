<div class="modal fade" id="modal-delete">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <div class="modal-title">Hapus Berkas?</div>
            </div>
            <div class="modal-body">
                <div class="callout callout-danger">
                    <h5>Perintah tidak dapat dikembalikan!</h5>
                    <p>Yakin hapus sub_dokumen <strong>{{ $sub_dokumen->nama_subdok }}</strong></p>
                </div>
                <form action="{{ route('admin.sub_dokumen.destroy', $sub_dokumen->id) }}" method="post" class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus</button>
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            </div>

        </div>

    </div>
</div>
