@extends('layout_lte/main')
@section('subjudul')
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">{{ $title }}
                    <div class="card-tools">
                        <a href="javascript:;" onclick="create()" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah
                            Tutor</a>

                    </div>
                </div>

                <div class="card-body">
                    <div class=""id="alert">
                        @if (session()->has('msg'))
                            <div class="alert alert-{{ session('class') }}">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ session('msg') }}
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered" id="tabletutor" width="100%">
                            <thead class="bg-navy">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Kode Jurusan</th>
                                    <th>Nama Jurusan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jurusans as $jurusan)
                                    <tr class="">
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $jurusan->kode }}</td>
                                        <td>{{ $jurusan->nama }}</td>

                                        <td>
                                            <button onclick="edit('{{ $jurusan->id }}')" class="btn btn-info btn-sm"><i
                                                    class="far fa-edit"></i></button>
                                            <form action="{{ route('admin.jurusan.destroy', $jurusan->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
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
    <div class="tampil-modal"></div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $(function() {
                $('#tabletutor').DataTable({
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "responsive": true,
                    "pageLength": 20,
                });
            });
        });

        function edit(id) {
            var url = "{{ route('admin.jurusan.edit', ':id_data') }}";
            url = url.replace(":id_data", id);
            $.ajax({
                type: "GET",
                url: url,

                dataType: "json",
                success: function(response) {
                    $('.tampil-modal').html(response.html);
                    $('#modal_show').modal('show');
                }
            });
        }

        function create() {
            var url = "{{ route('admin.jurusan.create') }}";
            // url = url.replace(":id_data", id);
            $.ajax({
                type: "GET",
                url: url,

                dataType: "json",
                success: function(response) {
                    $('.tampil-modal').html(response.html);
                    $('#modal_create').modal('show');
                }
            });
        }
    </script>
@endpush
