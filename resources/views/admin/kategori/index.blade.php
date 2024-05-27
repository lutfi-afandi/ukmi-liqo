@extends('layout_lte/main')
@section('subjudul')
    {{ $title }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus"></i>
                        Tambah
                        Kategori</a>
                </div>

                <div class="card-body">
                    <div id="alert">
                        @if (session()->has('msg'))
                            <div class="alert {{ session('class') }}">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ session('msg') }}
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table table-sm table-bordered" id="tablekategori" width="100%">
                            <thead class="bg-navy">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataKategori as $kat)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kat->nama_kategori }}</td>
                                        <td>
                                            <a type="button" class="btn btn-info btn-sm"
                                                onclick="edit('{{ $kat->id }}')"><i class="far fa-edit"></i></a>
                                            <form action="{{ route('admin.kategori.destroy', $kat->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.kategori.store') }}" method="post">
                    @method('post')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_kategori">Nama Kategori</label>
                            <input type="text" name="nama_kategori" class="form-control"
                                placeholder="Masukan nama_kategori" autofocus autocomplete="false"
                                value="{{ old('nama_kategori') }}">

                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div id="tempat-modal"></div>
@endsection
@section('js')
    <script>
        setTimeout(function() {
            document.getElementById('alert').innerHTML = '';
        }, 2000);
        $(document).ready(function() {
            $(function() {
                $('#tablekategori').DataTable({
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "responsive": true,
                });
            });
        });

        function edit(id) {
            var url = "{{ route('admin.kategori.show', ':id_data') }}";
            url = url.replace(":id_data", id);
            $.ajax({
                    method: "GET",
                    url: url,
                })
                .done(function(data) {
                    $('#tempat-modal').html(data.html);
                    $('#modal-edit').modal('show');
                })
        }
    </script>
@endsection
