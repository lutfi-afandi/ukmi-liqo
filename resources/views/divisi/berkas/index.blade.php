@extends('layout_lte.main')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="info-box p-2 pl-3">

                <div class="info-box-content m">
                    <h4 class="info-box-number mb-0">Data Berkas</h4>
                    <h5 class="info-box-text font-weight-light">Lembaga Penjamin Mutu</h5>
                </div>
                <div class="info-box-button pt-2 pr-3">
                    <a href="{{ route('divisi.dashboard.index') }}" class="btn btn-info"><i class="fas fa-home"></i>
                        Beranda</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">

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
                                    <th>#</th>
                                    <th>Nama </th>
                                    <th>Kategori</th>
                                    <th>File</th>
                                    <th>upload</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($berkaslpm as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_berkas }}</td>
                                        <td>{{ $item->kategori->nama_kategori }}</td>
                                        <td>
                                            <button onclick="lihat_berkas('{{ $item->file }}')"
                                                class="btn btn-sm btn-warning"><i class="fas fa-eye"></i>
                                                {{ $item->file }}</button>
                                        </td>
                                        <td>{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>

                                    </tr>
                                @endforeach
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
            var dir = "{{ asset('storage/uploads/file_berkas') }}";
            $('#modal-file').modal('show');
            $('#modal-title').html(nama_file);
            $('#frame-file').attr('src', dir + "/" + nama_file);
        }

        function hapus(id) {
            var url = "{{ route('admin.berkas.show', ':id') }}";
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
