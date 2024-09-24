@extends('layout_lte/main')
@section('subjudul')
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">{{ $title }}
                    <div class="card-tools">
                        <a href="{{ route('admin.anggota.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah
                            Tutor</a>

                    </div>
                </div>

                <div class="card-body">
                    <div class=""id="alert">
                        @if (session()->has('msg'))
                            <div class="alert {{ session('class') }}">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ session('msg') }}
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered" id="tabletutor" width="100%">
                            <thead class="bg-navy">
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Kontak</th>
                                    <th>Tahun Masuk</th>
                                    <th>Jurusan</th>
                                    <th>Password</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($anggotas as $anggota)
                                    <tr class="">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $anggota->npm }}</td>
                                        <td>{{ $anggota->nama }}</td>
                                        <td>{{ $anggota->jenis_kelamin }}</td>
                                        <td>{{ $anggota->no_telepon }}</td>
                                        <td>{{ $anggota->tahun_masuk }}</td>
                                        <td>{{ $anggota->jurusan->nama ?? '' }}</td>
                                        <td>
                                            <button class="btn btn-sm bg-navy" onclick="reset('{{ $anggota->id }}')"><i
                                                    class="fa fa-key"></i> Reset</button>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.anggota.edit', $anggota->id) }}"
                                                class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
                                            <form action="{{ route('admin.anggota.destroy', $anggota->id) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Yakin hapus data ini?')">
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
                    "pageLength": 25,
                });
            });
        });


        function reset(id) {
            var url = "{{ route('admin.anggota.reset', ':id_data') }}";
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

        // function edit(id) {
        //     var url = "{{ route('admin.anggota.edit', ':id_data') }}";
        //     url = url.replace(":id_data", id);
        //     $.ajax({
        //         type: "GET",
        //         url: url,

        //         dataType: "json",
        //         success: function(response) {
        //             $('.tampil-modal').html(response.html);
        //             $('#modal_show').modal('show');
        //         }
        //     });
        // }
    </script>
@endpush
