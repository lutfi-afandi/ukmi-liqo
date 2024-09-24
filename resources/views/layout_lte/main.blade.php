<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout_lte.head')

</head>


<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand bg-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>

            @include('layout_lte.navbar')
        </nav>

        <aside class="main-sidebar sidebar-light-primary elevation-2">
            <a href="#" class="brand-link bg-primary text-primary">
                <img src="{{ asset('logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle ">
                <span class="brand-text font-weight-bold">LiQo</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('user.png') }}" class="img-circle elevation-2 mt-2" alt="User Image">

                    </div>
                    <div class="info">
                        <b>{{ auth()->user()->name }}</b>
                        <a href="#" class="d-block">{{ auth()->user()->level }}</a>
                    </div>
                </div>


                <nav class="mt-2">
                    @include('layout_lte.sidebar')
                </nav>
            </div>

        </aside>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    @yield('subjudul')</h1>
                </div>
            </section>

            <section class="content mt-2">
                @yield('content')
            </section>
        </div>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.1.0
            </div>
            <strong>Copyright &copy; 2024 <a href="https://teknokrat.ac.id/">PutTIK Teknokrat</a>.</strong>
        </footer>

        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>



    @include('layout_lte.js')
</body>

</html>
