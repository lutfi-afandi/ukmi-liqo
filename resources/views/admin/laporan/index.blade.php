@extends('layout_lte/main')
@section('subjudul')
    {{ $title }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
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
                                    <th>Nama Bagian</th>
                                    <th class="text-center">Progja</th>
                                    <th width="15%" class="text-center">Sarmut</th>
                                    <th width="15%" class="text-center">Triwulan 1</th>
                                    <th width="15%" class="text-center">Triwulan 2</th>
                                    <th width="15%" class="text-center">Triwulan 3</th>
                                    <th width="15%" class="text-center">Triwulan 4</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $u)
                                    <tr>
                                        <td>{{ $u->name }}</td>
                                        @php
                                            $pro_div = $laporans->where('user_id', $u->id)->first()->progja ?? '';
                                        @endphp
                                        <td class="{{ $pro_div == '' ? 'bg-danger' : 'bg-success' }}">
                                            {{ $pro_div }}
                                        </td>
                                        <td>
                                            {{ $laporans->where('user_id', $u->id)->first()->sarmut ?? '' }}
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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


        }
    </script>
@endsection
