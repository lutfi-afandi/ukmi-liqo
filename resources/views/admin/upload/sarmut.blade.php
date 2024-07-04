<div class="modal fade" id="modal-sarmut">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-navy d-flex justify-content-center">
                <div class="modal-title">{{ $title }}</div>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.upload.simpansarmut') }}" method="POST">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label>Link File Sasaran Mutu</label>
                        <input type="hidden" class="form-control" name="laporan_id" placeholder="link"
                            value="{{ $laporan_id ?? '' }}">
                        <input type="text" class="form-control" name="sarmut" placeholder="link"
                            value="{{ $laporan->sarmut ?? '' }}">
                        @if (isset($laporan->sarmut))
                            <a href="{{ $laporan->sarmut ?? '' }}" target="_blank"><i
                                    class="fas fa-share-square"></i></a>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="konf_sarmut" id="konf_sarmut" class="form-control">
                            <option value="" hidden>-Pilih Status-</option>
                            @if ($laporan != null)
                                <option value="sedang" {{ $laporan->konf_sarmut == 'sedang' ? 'selected' : '' }}>
                                    diperiksa
                                </option>
                                <option {{ $laporan->konf_sarmut == 'diterima' ? 'selected' : '' }}>diterima</option>
                                <option {{ $laporan->konf_sarmut == 'ditolak' ? 'selected' : '' }}>ditolak</option>
                            @else
                                <option value="sedang">diperiksa</option>
                                <option>diterima</option>
                                <option>ditolak</option>
                            @endif

                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
