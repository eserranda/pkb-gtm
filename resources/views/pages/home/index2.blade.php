<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PKB Gereja Toraja Mamasa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        .navbar-custom {
            background: linear-gradient(90deg, #3f51b5, #5c6bc0);
            color: #ffffff;
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #ffffff;
        }

        .navbar-custom .nav-link:hover {
            color: #ffeb3b;
        }

        .btn-custom {
            background-color: #ff5722;
            color: #ffffff;
        }

        .btn-custom:hover {
            background-color: #ff9800;
            color: #ffffff;
        }

        .hero {
            position: relative;
            background-image: url('{{ asset('assets/images/hero.jpg') }}');
            background-size: cover;
            background-position: center;
            padding: 120px 0;
            text-align: center;
            color: #ffffff;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: inherit;
            background-size: inherit;
            background-position: inherit;
            filter: blur(8px);
            z-index: 1;
        }

        .hero .container {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .hero p {
            font-size: 1.25rem;
        }

        .section-title {
            font-size: 2rem;
            margin-bottom: 30px;
            color: #3f51b5;
        }

        .custom-table {
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            {{-- <a class="navbar-brand" href="#">Komunitas Kaum Bapak</a> --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#profile">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kegiatan">Kegiatan</a>
                    </li>
                </ul>
                <a href="login" class="btn btn-custom">Login</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Selamat Datang di Persekutuan Kaum Bapak</h1>
            <h1>Gereja Toraja Mamasa</h1>
            {{-- <p>Memperkuat ikatan antar ayah dalam komunitas yang peduli dan mendukung.</p> --}}
        </div>
    </section>

    <!-- Home Section -->
    <section id="profile" class="py-5">
        <div class="container">
            <h2 class="section-title">Sejarah Singkat</h2>
            <p>
                Persekutuan Kaum Bapak Gereja Toraja Mamasa disingkat PKB-GTM adalah wadah yang dibentuk khusus untuk
                mempersekutukan dan memperlengkapi warga Gereja Toraja Mamasa (GTM) kategori laki-laki dewasa untuk
                melaksanakan fungsinya sebagai bapa, bersaksi, bersekutu, dan melayani dalam mewujudkan Visi-Misi Gereja
                Toraja Mamasa (Utuh, Mandiri dan Misioner) Berdasarkan pada Alkitab dan Tata Dasar dan tata Rumah Tangga
                Gereja Toraja Mamasa (TD/TRT GTM). Dengan demikian PKB-GTM merupakan persekutuan kategori dan bagian
                yang tidak terpisahkan dari persekutuan GTM pada semua lingkup, yakni Jemaat, Klasis dan Sinode.
            </p>
            <p>
                Persekutuan Kaum Bapak Gereja Toraja Mamasa (PKB-GTM) pada lingkup sinodal dibentuk dalam Pertemuan AM I
                PKB-GTM yang berlangsung pada tanggal 31 Mei s/d 2 Juni 2018 di Aula Eran Maelo Saelako Tondok Tallu
                Sumarorong berdasarkan Amanat Keputusan Sidang Majelis Sinode Am GTM XIX Tahun 2016.
            </p>
            <p>
                Untuk memandu dan menata penyelenggaraan pelayanan PKB-GTM pada semua lingkup pelayanan GTM maka
                ditetapkan Pedoman Pelayanan Persekutuan Kaum Bapak Gereja Toraja Mamasa (PP PKB-GTM). Pedoman Pelayanan
                ini mengatur hal-hal yang bersifat teknis sebagai pelaksanaan dari Tata Dasar Tata Tumah Tangga GTM.
            </p>
        </div>
    </section>

    <!-- Profile Section -->
    <section id="profile" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title">Visi & Misi</h2>
            <div class="row">
                <!-- Card for Visi -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Visi</h3>
                            <p class="card-text">
                                Mewujudkan gereja yg utuh mandiri dan misioner.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Card for Misi -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Misi</h3>
                            <ul class="card-text">
                                <li>Menjadi wadah pelayanan untuk membangun persekutuan dengan tujuan meningkatkan
                                    persekutuan kamu bapak pada lingkup jemaat, klasis dan sinode</li>
                                <li> Mengembangkan organisasi PKB GTM berdasarkan prinsip-prinsip eklesiologi GTM</li>
                                <li>Mewujudkan kemandirian teologi kontekstual warga jemaat untuk menjawab berbagai
                                    tantangan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kegiatan Section -->
    <section id="kegiatan" class="py-5">
        <div class="container">
            <h2 class="section-title">Jadwal Ibadah Kaum Bapak</h2>
            <div class="table-responsive">
                <table class="table table-striped custom-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kelompok</th>
                            <th>Pelayan Firman</th>
                            <th>Tempat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->tanggal }}</td>
                                <td>{{ $d->kelompok }}</td>
                                <td>{{ $d->pelayan_firman }}</td>
                                <td>{{ $d->tempat_ibadah }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
