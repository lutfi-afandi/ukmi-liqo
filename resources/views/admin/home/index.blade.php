@extends('layout_lte/main')

@section('content')
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">

                </div>
            </div>
        </div>

    </div>
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Selamat Datang {{ auth()->user()->name }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <table class="table table-bordered">
                <tr>
                    <td class="font-weight-bold">Nama</td>
                    <td>:</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Username</td>
                    <td>:</td>
                    <td>{{ $user->username }}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Level</td>
                    <td>:</td>
                    <td>{{ $user->level }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
