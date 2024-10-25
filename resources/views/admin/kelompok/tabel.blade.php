<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-bordered" id="datatable-kelompok">
                <thead class="bg-navy">
                    <tr>
                        <th>No</th>
                        <th>Kode Kelompok</th>
                        <th>Tutor</th>
                        <th class="text-center">Anggota</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kelompoks as $kelompok)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kelompok->kode }}</td>
                            <td>{{ $kelompok->tutor->nama }}</td>
                            <td class="text-center">
                                <a
                                    href="{{ route('admin.anggota-kelompok.show', $kelompok->id) }}"class="badge badge-success">
                                    anggota : {{ $kelompok->rombel->count() }}</a>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-danger" onclick="hapus('{{ $kelompok->id }}')"><i
                                        class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
