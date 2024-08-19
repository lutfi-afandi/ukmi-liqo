@extends('layout_lte.main')
@section('content')
    <div class="card">
        <div class="card-header">
            <center class="font-weight-bold">{{ $subdok->nama_subdok }}</center>
        </div>
        <div class="card-body">
            <iframe id="frame-file" src="{{ $subdok->file_subdok }}" frameborder="0" width="100%" height="820px"></iframe>

        </div>
    </div>
@endsection
