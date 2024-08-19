@extends('layout_lte.main')
@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-file-alt"></i>
                <span class="judul">{{ $subsop->sop->nama_sop }}</span>
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-5 col-sm-3">
                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                        @foreach ($daftarsop as $sub)
                            <a class="nav-link {{ request()->segment(3) == $sub->id ? 'active' : '' }}"
                                id="vert-tabs-subsop-tab" href="{{ route('divisi.subsop.show', $sub->id) }}" role="tab"
                                aria-controls="vert-tabs-subsop">{{ $loop->iteration }}. {{ $sub->nama_subsop }}
                            </a>
                        @endforeach

                    </div>
                </div>
                <div class="col-7 col-sm-9">
                    <div class="tab-content" id="vert-tabs-tabContent">
                        <div class="tab-pane text-left fade active show" id="vert-tabs-subsop">
                            <div class="callout callout-info">
                                <h5><i class="fas fa-file-signature"></i> {{ $subsop->nama_subsop }}</h5>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <iframe id="frame-file" src="{{ $subsop->file_subsop }}" frameborder="0" width="100%"
                                        height="820px"></iframe>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- /.card -->
    </div>
@endsection
@section('js')
@endsection
