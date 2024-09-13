@extends('layout_lte/main')
@section('subjudul')
    {{ $title }}
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('admin.user.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah
                        User</a>
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
                        <table class="table table-sm table-bordered" id="tableuser" width="100%">
                            <thead class="bg-navy">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Password</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="{{ $user->username == auth()->user()->username ? 'table-primary' : '' }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->level }}</td>
                                        <td>
                                            <button class="btn btn-sm bg-navy" onclick="reset('{{ $user->id }}')"><i
                                                    class="fa fa-key"></i> Reset</button>
                                        </td>
                                        <td>
                                            <button onclick="edit('{{ $user->id }}')" class="btn btn-info btn-sm"><i
                                                    class="far fa-edit"></i></button>
                                            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST"
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
                $('#tableuser').DataTable({
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "responsive": true,
                });
            });
        });


        function reset(id) {
            var url = "{{ route('admin.user.reset', ':id_data') }}";
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

        function edit(id) {
            var url = "{{ route('admin.user.edit', ':id_data') }}";
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
    </script>
@endpush
