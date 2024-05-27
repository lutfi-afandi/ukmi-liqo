@extends('layout_lte/main')
@section('subjudul')
    {{ $title }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">


                <div class="card-body">
                    <div id="alert">
                        @if (session()->has('msg'))
                            <div class="alert {{ session('class') }}">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ session('msg') }}
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive" id="data">
                        <table class="table table-bordered" id="tableperiode" width="100%">
                            <thead class="bg-navy">
                                <tr>
                                    <th width="5%" class="text-center">No</th>
                                    <th>Nama Periode</th>
                                    <th class="text-center">Status</th>
                                    <th width="15%" class="text-center">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPeriode as $periode)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $periode->tahun }}</td>
                                        <td class="text-center">
                                            @if ($periode->status == 1)
                                                <p class="badge bg-success">aktif</p>
                                            @else
                                                <form action="{{ route('admin.periode.update', $periode->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit" class="btn btn-secondary btn-sm">Set
                                                        Aktif</button>
                                                </form>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{-- <a type="button" class="btn btn-info btn-sm"
                                                onclick="edit('{{ $periode->id }}')"><i class="far fa-edit"></i></a> --}}
                                            <form action="{{ route('admin.periode.destroy', $periode->id) }}" method="POST"
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
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-primary">
                    Tambah Periode
                </div>
                <form action="{{ route('admin.periode.store') }}" method="post">
                    @method('post')
                    @csrf
                    <div class="card-body">
                        <div id="alert">
                            @if (session()->has('msgs'))
                                <div class="alert {{ session('class') }}">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    {{ session('msgs') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="tahun">Tahun Periode</label>
                            <input type="text" name="tahun" class="form-control" placeholder="Masukan tahun" autofocus
                                autocomplete="false" value="{{ old('tahun') }}">
                        </div>

                    </div>
                    <div class="card-footer justify-content-between">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
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
                $('#tableperiode').DataTable({
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
            var url = "{{ route('admin.periode.show', ':id_data') }}";
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
