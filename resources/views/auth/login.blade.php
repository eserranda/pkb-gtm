<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login - PKB Gereja Toraja Mamasa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Sistem Informasi Persekutuan Kaum Bapak Gereja Toraja Mamasa" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/favicon.ico">

    <!-- App css -->
    <link href="{{ asset('assets') }}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets') }}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets') }}/css/app.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="authentication-bg bg-gradient">

    <div class="account-pages mt-5  ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-pattern">
                        <div class="card-body p-4">
                            <div class="text-center w-100 m-auto">
                                <a href="/login">
                                    <h4 class="mt-2 font-size-16 fw-bold">SELAMAT DATANG</h4>
                                </a>
                                <p class="text-center font-bold mt-0 ">Silahkan masukkan username dan
                                    password</p>
                            </div>

                            @error('login')
                                <div class="text-dark alert alert-danger" role="alert">
                                    <b>{{ $message }}</b>
                                </div>
                            @enderror

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group mb-3">
                                    <label>Username atau Email</label>
                                    <input class="form-control" type="text" name="login"
                                        placeholder="Masukkan username atau email" value="{{ old('login') }}">
                                </div>

                                <div class="form-group mb-3">
                                    {{-- <a href="/forgot-password" class="text-muted float-right">
                                        <small>Lupa Password?</small>
                                    </a> --}}

                                    <label for="password">Password</label>
                                    <input class="form-control" type="password" name="password"
                                        placeholder="Masukkan password">
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-gradient btn-block" type="submit"> Log In </button>
                                </div>

                            </form>

                            <div class="row mt-3 justify-content-end">
                                <div class="col-sm-12">
                                    <a href="/forgot-password" class="text-dark float-right">
                                        <b>Lupa Password?</b>
                                    </a>
                                </div>
                            </div>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- Vendor js -->
    <script src="{{ asset('assets') }}/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="{{ asset('assets') }}/js/app.min.js"></script>

</body>

</html>
