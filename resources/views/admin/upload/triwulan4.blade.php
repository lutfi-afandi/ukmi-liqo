<div class="modal fade" id="modal-triwulan4">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-navy d-flex justify-content-center">
                <div class="modal-title">{{ $title }}</div>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.upload.simpantriwulan4') }}" method="POST">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label>Link File Sasaran Mutu</label>
                        <input type="hidden" class="form-control" name="laporan_id" placeholder="link"
                            value="{{ $laporan->id ?? '' }}">
                        <input type="hidden" class="form-control" name="id" placeholder="link"
                            value="{{ $triwulan4->id ?? '' }}">
                        <input type="text" class="form-control" name="file_tw4" placeholder="link"
                            value="{{ $triwulan4->file_tw4 ?? '' }}">
                        @if (isset($triwulan4->file_tw4))
                            <a href="{{ $triwulan4->file_tw4 ?? '' }}" target="_blank"><i
                                    class="fas fa-share-square"></i></a>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="konf" id="konf" class="form-control">
                            <option value="" hidden>-Pilih Status-</option>
                            @if ($triwulan4 != null)
                                <option value="sedang" {{ $triwulan4->konf == 'sedang' ? 'selected' : '' }}>
                                    diperiksa
                                </option>
                                <option {{ $triwulan4->konf == 'diterima' ? 'selected' : '' }}>diterima</option>
                                <option {{ $triwulan4->konf == 'ditolak' ? 'selected' : '' }}>ditolak</option>
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
