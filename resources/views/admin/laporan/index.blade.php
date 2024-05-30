@extends('layout_lte/main')
@php
    $helper = new \App\Helpers\Helper();
@endphp
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-gradient-primary">
                    <h3 class="card-title">{{ $title }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
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

                    <div class="table-responsive" id="data">
                        <table class="table table-bordered" id="tableperiode" width="100%">
                            <thead class="bg-navy">
                                <tr>
                                    <th class="text-nowrap">Nama Bagian</th>
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
                                        <td class="text-nowrap">{{ $u->name }}</td>
                                        @php
                                            $id_laporan = $laporans->where('user_id', $u->id)->first()->id ?? '';
                                            $progja = $laporans->where('user_id', $u->id)->first()->progja ?? '';
                                            $konf_progja =
                                                $laporans->where('user_id', $u->id)->first()->konf_progja ?? '';

                                            $sarmut = $laporans->where('user_id', $u->id)->first()->sarmut ?? '';
                                            $tw1 = $laporans->where('user_id', $u->id)->first()->tw1 ?? '';
                                            $tw2 = $laporans->where('user_id', $u->id)->first()->tw2 ?? '';
                                            $tw3 = $laporans->where('user_id', $u->id)->first()->tw3 ?? '';
                                            $tw4 = $laporans->where('user_id', $u->id)->first()->tw4 ?? '';

                                            $tw1 = $laporans->where('user_id', $u->id)->first()->tw1 ?? '';
                                            $tw2 = $laporans->where('user_id', $u->id)->first()->tw2 ?? '';
                                            $tw3 = $laporans->where('user_id', $u->id)->first()->tw3 ?? '';
                                            $tw4 = $laporans->where('user_id', $u->id)->first()->tw4 ?? '';

                                            $konf_sarmut =
                                                $laporans->where('user_id', $u->id)->first()->konf_sarmut ?? '';
                                            $konf_tw1 = $laporans->where('user_id', $u->id)->first()->konf_tw1 ?? '';
                                            $konf_tw2 = $laporans->where('user_id', $u->id)->first()->konf_tw2 ?? '';
                                            $konf_tw3 = $laporans->where('user_id', $u->id)->first()->konf_tw3 ?? '';
                                            $konf_tw4 = $laporans->where('user_id', $u->id)->first()->konf_tw4 ?? '';
                                        @endphp
                                        <td class="bg-{{ $helper->bg($konf_progja) }}">
                                            <a href="/progja/{{ $id_laporan }}">{{ $progja }} -
                                                {{ $id_laporan }}</a>
                                        </td>
                                        <td class="bg-{{ $helper->bg($konf_sarmut) }}">
                                            {{ $sarmut }}
                                        </td>
                                        <td class="bg-{{ $helper->bg($konf_tw1) }}">
                                            {{ $tw1 }}
                                        </td>
                                        <td class="bg-{{ $helper->bg($konf_tw2) }}">
                                            {{ $tw2 }}
                                        </td>
                                        <td class="bg-{{ $helper->bg($konf_tw3) }}">
                                            {{ $tw3 }}
                                        </td>
                                        <td class="bg-{{ $helper->bg($konf_tw4) }}">
                                            {{ $tw4 }}
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
