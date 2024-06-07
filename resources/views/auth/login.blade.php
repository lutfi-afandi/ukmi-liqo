<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-SPMI | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template_lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    {{-- <link rel="stylesheet" href="{{ asset('template_lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"> --}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template_lte/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page" style="background-color: rgb(13, 55, 97); min-height: 407.25px;">
    <div class="login-box">
        {{-- <div class="login-logo">
            <img src="{{ asset('logo_asean.png') }}" alt="">
        </div> --}}
        <!-- /.login-logo -->
        <div class="card card-outline card-navy p-2">
            <div class="d-flex justify-content-center align-items-center my-2">
                <div class="text-center">
                    <img src="{{ asset('spmi.png') }}" alt="logo" class="img-fluid">
                </div>
            </div>
            <div class="card-body ">
                <form action="{{ route('login') }}" method="post">
                    @method('post')
                    @csrf
                    <div class="form-group">
                        <label>Username</label>
                        <div class="input-group  mb-3">
                            <input type="text" name="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                placeholder="Username" id="email" autofocus required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @error('email')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Password</label>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control"
                                @error('password') is-invalid @enderror placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-lock"></i>
                                Login</button>
                        </div>
                    </div>
                </form>

            </div>
            <!-- /.login-card-body -->
            <div class="card-footer text-center d-flex flex-column py-2" style="background-color: black">
                <strong style="color: #fff;"> © 2024 </strong>
                <span style="color: #fff;">All rights
                    reserved.
                </span>
                <span style="color: #fff;">Powered by
                    <a data-toggle="modal" data-target="#puskom" style="color: #F00;">Pustik UTI<br></a>
                </span>
            </div>
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('template_lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('template_lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('template_lte/dist/js/adminlte.min.js') }}"></script>
    <script>
        $('#email').click(function(e) {
            e.preventDefault();
            $(this).removeClass('is-invalid');
        });
    </script>
</body>

</html>
