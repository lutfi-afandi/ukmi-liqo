<div class="modal fade" id="modal-riwayat">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-navy d-flex justify-content-center">
                <div class="modal-title">RIWAYAT UPLOAD</div>
            </div>
            <div class="modal-body">
                @if ($riwayats->count() < 1)
                    <div class="callout callout-info">
                        <h5><i class="far fa-folder-open"></i> Informasi!</h5>
                        <p>Riwayat Tidak Ditemukan</p>
                    </div>
                @else
                    <table class="table table-sm text-center table-bordered">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
                                <th>Tanggal Upload</th>
                                <th>Catatan Auditor</th>
                                <th>File</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayats as $riwayat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d/m/Y H:i:s', strtotime($riwayat->tgl_upload)) }}</td>
                                    <td class="text-left">
                                        {!! $riwayat->ket !!}

                                    </td>
                                    <td>
                                        <a href="{{ $riwayat->file_tw1 }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>

</div>
