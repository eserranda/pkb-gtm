<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>PKB-GTM | Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
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
    <div class="account-pages pt-5 ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-pattern">

                        <div class="card-body p-4">

                            <div class="text-center m-auto">
                                <a href="index.html">
                                    {{-- <span><img src="{{ asset('assets') }}/images/logo-dark.png" alt="" height="20"></span> --}}
                                    <span>
                                        <H4>Reset Password</H4>
                                    </span>
                                </a>
                                <p class="text-muted sub-header mb-3 mt-3">Masukkan alamat email yang terdaftar untuk
                                    menerima instruksi pengaturan ulang password Anda,</p>
                            </div>
                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form action="{{ route('password.email') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="emailaddress">Email</label>
                                    <input class="form-control" type="email" id="email" name="email"
                                        placeholder="john@gmail.com">
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-gradient btn-block" type="submit">
                                        Reset Password
                                    </button>
                                </div>
                            </form>

                            <div class="row mt-4">
                                <div class="col-sm-12 text-center">
                                    <p class="text-muted mb-0">Kembali ke
                                        <a href="/login" class="text-dark ml-1">
                                            <b>Login</b>
                                        </a>
                                    </p>
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
