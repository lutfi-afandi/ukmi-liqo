@extends('layout_lte/main')
@section('subjudul')
    {{ $title }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('admin.penetapan.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                        Tambah
                        Penetapan</a>
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
                        <table class="table table-sm table-bordered" id="tablepenetapan" width="100%">
                            <thead class="bg-navy text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Penetapan</th>
                                    <th>Kategori</th>
                                    <th>Tanggal Penetapan</th>
                                    <th>File Penetapan</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPenetapan as $pen)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $pen->nama_standar }}</td>
                                        <td>{{ $pen->kategori->nama_kategori }}</td>
                                        <td>{{ date('d/m/Y', strtotime($pen->tgl_penetapan)) }}</td>
                                        <td class="text-center">
                                            @php
                                                $file = asset('storage/uploads/penetapan/' . $pen->file_standar);
                                            @endphp
                                            <a type="button" id="file_standar" class="badge bg-warning"
                                                onclick="file('{{ $file }}')"><i class="fa fa-file"></i>
                                                Berkas</a>
                                        </td>
                                        <td>

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

    <div id="tempat-modal"></div>

    <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
            <div class="modal-content  bg-secondary">

                <div class="modal-body">
                    <iframe src="#" id="frames" frameborder="0" style="min-height: 640px; width: 100%"></iframe>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
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
                $('#tablepenetapan').DataTable({
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
            var url = "{{ route('admin.penetapan.show', ':id_data') }}";
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

        function file(file_standar) {
            $('#modal-xl').modal('show');
            $('#frames').attr('src', file_standar + "#toolbar=2");
        }
    </script>
@endsection
