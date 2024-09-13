@extends('layout_lte/main')

@section('content')
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header">Selamat Datang {{ auth()->user()->name }}</div>
                <div class="card-body">
                    <table class="table table-borderless table-striped" width="60%">
                        <tr>
                            <td class="font-weight-bold" width="25%">Nama</td>
                            <td class="text-right" width="5%">:</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Username</td>
                            <td class="text-right">:</td>
                            <td>{{ $user->username }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Level</td>
                            <td class="text-right">:</td>
                            <td>{{ $user->level }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
