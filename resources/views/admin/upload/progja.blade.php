<div class="modal fade" id="modal-progja">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-navy d-flex justify-content-center">
                <div class="modal-title">{{ $title }}</div>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.upload.saveprogja') }}" method="POST">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label>Link File Progja</label>
                        <input type="hidden" class="form-control" name="user_id" value="{{ $user_id }}"
                            placeholder="link">
                        <input type="hidden" class="form-control" name="periode_id" value="{{ $periode_id }}"
                            placeholder="link">
                        <input type="text" class="form-control" name="progja" placeholder="link"
                            value="{{ $laporan->progja ?? '' }}">
                        @if (isset($laporan->progja))
                            <a href="{{ $laporan->progja ?? '' }}" target="_blank"><i
                                    class="fas fa-share-square"></i></a>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="konf_progja" id="konf_progja" class="form-control">
                            <option value="" hidden>-Pilih Status-</option>
                            @if ($laporan != null)
                                <option value="sedang" {{ $laporan->konf_progja == 'sedang' ? 'selected' : '' }}>
                                    diperiksa
                                </option>
                                <option {{ $laporan->konf_progja == 'diterima' ? 'selected' : '' }}>diterima</option>
                                <option {{ $laporan->konf_progja == 'ditolak' ? 'selected' : '' }}>ditolak</option>
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
