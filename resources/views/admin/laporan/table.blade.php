@php
    $helper = new \App\Helpers\Helper();
@endphp
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
                <tr class="text-nowrap">
                    <td>{{ $u->name }}</td>
                    {{-- jika samasekali belum ada laporan --}}
                    @if ($laporans->where('user_id', $u->id)->where('periode_id', $periode_aktif)->first() == null)
                        @for ($i = 0; $i < 6; $i++)
                            <td class="text-center "><i class="fas fa-ban  text-danger"></i> kosong
                            </td>
                        @endfor
                        {{-- end belum ada laporan --}}
                    @else
                        @php
                            $laporan =
                                $laporans
                                    ->where('user_id', $u->id)
                                    ->where('periode_id', $periode_aktif)
                                    ->first() ?? '';
                            // dd($laporan->id);

                            $id_laporan = $laporan->id ?? '';
                            $konf_progja = $laporan->konf_progja ?? '';
                            $konf_sarmut = $laporan->konf_sarmut ?? '';

                            $triwulan1 = $laporan->first()->triwulan1->first() ?? '';
                            $triwulan2 = $laporan->first()->triwulan2->first() ?? '';
                            $triwulan3 = $laporan->first()->triwulan3->first() ?? '';
                            $triwulan4 = $laporan->first()->triwulan4->first() ?? '';

                            $id_tw1 = $triwulan1->id ?? '#';
                            $id_tw2 = $triwulan2->id ?? '#';
                            $id_tw3 = $triwulan3->id ?? '#';
                            $id_tw4 = $triwulan4->id ?? '#';

                            $konf_tw1 = $triwulan1->konf ?? '';
                            $konf_tw2 = $triwulan2->konf ?? '';
                            $konf_tw3 = $triwulan3->konf ?? '';
                            $konf_tw4 = $triwulan4->konf ?? '';
                        @endphp
                        <td class="text-center bg-{{ $helper->bg($konf_progja) }}">
                            <a href="/progja/{{ $id_laporan }}">{!! $helper->icon($konf_progja) !!}</a>
                        </td>

                        <td class="text-center bg-{{ $helper->bg($konf_sarmut) }}">
                            <a href="/sarmut/{{ $id_laporan }}">{!! $helper->icon($konf_sarmut) !!}</a>
                        </td>
                        <td class="text-center bg-{{ $helper->bg($konf_tw1) }}">
                            <a href="{{ $id_tw1 != '#' ? '/triwulan1/' . $id_tw1 : '#' }}">{!! $helper->icon($konf_tw1) !!}</a>
                        </td>
                        <td class="text-center bg-{{ $helper->bg($konf_tw2) }}">
                            <a href="{{ $id_tw2 != '#' ? '/triwulan2/' . $id_tw2 : '#' }}">{!! $helper->icon($konf_tw2) !!}</a>
                        </td>
                        <td class="text-center bg-{{ $helper->bg($konf_tw3) }}">
                            <a href="{{ $id_tw3 != '#' ? '/triwulan3/' . $id_tw3 : '#' }}">{!! $helper->icon($konf_tw3) !!}</a>
                        </td>
                        <td class="text-center bg-{{ $helper->bg($konf_tw4) }}">
                            <a href="{{ $id_tw4 != '#' ? '/triwulan4/' . $id_tw4 : '#' }}">{!! $helper->icon($konf_tw4) !!}</a>
                        </td>


                        {{--  --}}
                    @endif
                </tr>
            @endforeach

        </tbody>
    </table>

</div>
