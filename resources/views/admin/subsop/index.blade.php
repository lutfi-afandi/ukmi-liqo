@extends('layout_lte.main')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="info-box p-2 pl-3">
                <i class="fas fa-folder-open fa-4x text-info"></i>

                <div class="info-box-content m">
                    <h4 class="info-box-number mb-0">Data {{ $title }}</h4>
                    <h5 class="info-box-text font-weight-light">Lembaga Penjamin Mutu</h5>
                </div>
                <div class="info-box-button pt-2 pr-3">
                    <a href="{{ route('admin.sop.index') }}" class="btn btn-info"><i class="fas fa-arrow-alt-circle-left"></i>
                        Kembali</a>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="javascript:;" class="btn btn-success" data-toggle="modal" data-target="#modal-default"><i
                            class="fas fa-plus"></i>
                        Tambah Data</a>
                </div>
                <div class="card-body">
                    <div id="alert">
                        @if (session()->has('msgs'))
                            <div class="alert alert-{{ session('class') }}">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ session('msgs') }}
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive mt-2">
                        <table class="table table-striped table-bordered" id="datatableku" width="100%">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Nama</th>
                                    <th>File</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($subsops->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">Belum ada data!</td>

                                    </tr>
                                @else
                                    @foreach ($subsops as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_subsop }}</td>
                                            <td>
                                                <button onclick="lihat_berkas('{{ $item->file_subsop }}')"
                                                    class="btn btn-sm btn-warning">
                                                    {{ $item->nama_subsop }} <i class="fas fa-share-square"></i></button>
                                            </td>
                                            <td class="text-center">
                                                <button onclick="ubah('{{ $item->id }}')" class="btn btn-sm btn-info"><i
                                                        class="fas fa-pen"></i>
                                                </button>
                                                <button onclick="hapus('{{ $item->id }}')"
                                                    class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-file">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content bg-black">
                <div class="modal-body">
                    <iframe id="frame-file" src="#" frameborder="0" width="100%" height="820px"></iframe>
                </div>
            </div>

        </div>
    </div>
    <div id="tempat-modal"></div>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Tambah</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.subsop.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama {{ $title }}</label>
                            <input type="hidden" name="sop_id" value="{{ $sop->id }}">
                            <input type="text" class="form-control" name="nama_subsop" id="nama_subsop">
                        </div>
                        <div class="form-group">
                            <label for="nama">Link {{ $title }}</label>
                            <input type="text" class="form-control" name="file_subsop" id="file_subsop">
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
@endsection
@section('js')
    <script>
        setTimeout(function() {
            document.getElementById('alert').innerHTML = '';
        }, 2000);
        $(document).ready(function() {
            $(function() {
                $('#datatableku').DataTable({
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "responsive": true,
                });
            });

        });


        function lihat_berkas(nama_file) {
            // console.log(nama_file);
            $('#modal-file').modal('show');
            $('#modal-title').html(nama_file);
            $('#frame-file').attr('src', nama_file);
        }

        function ubah(id) {
            var url = "{{ route('admin.subsop.edit', ':id') }}";
            url = url.replace(":id", id);
            $.ajax({
                type: "get",
                url: url,
                dataType: "json",
                success: function(response) {
                    $('#tempat-modal').html(response.html);
                    $('#modal-ubah').modal('show');
                }
            });

        }

        function hapus(id) {
            var url = "{{ route('admin.subsop.show', ':id') }}";
            url = url.replace(":id", id);
            $.ajax({
                type: "get",
                url: url,
                dataType: "json",
                success: function(response) {
                    $('#tempat-modal').html(response.html);
                    $('#modal-delete').modal('show');
                }
            });

        }
    </script>
@endsection
