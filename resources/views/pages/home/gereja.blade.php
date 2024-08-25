@extends('pages.home.layouts.master')

@section('hero')
    <section class="hero-section d-flex justify-content-center align-items-center" id="section_1">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-12 mx-auto">
                    <h2 class="text-white text-center">{{ $gereja->nama_jemaat }}</h2>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('content')
    <?php
    use Carbon\Carbon;
    ?>

    <section class="explore-section section-padding" id="section_2">
        <div class="container">
            <div class="col-lg-6 col-12">
                <h6 class="mb-4">Detail {{ $gereja->nama_jemaat }}</h6>
            </div>
            <div class="row">


                <div class="col-lg-6 col-md-6 col-12 mb-4 mb-lg-3">
                    <div class="custom-block bg-white shadow-lg">
                        <a href="topics-detail.html">
                            <div class="d-flex">
                                <div>
                                    {{-- <h5 class="mb-2">Visi</h5>
                                    <p class="mb-0">Mewujudkan gereja yg utuh mandiri dan misioner</p> --}}
                                </div>

                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-12">
                    <div class="custom-block bg-white shadow-lg">
                        <a href="topics-detail.html">
                            <div class="d-flex">
                                <div>
                                    <h5 class="mb-4">Detail Gereja :</h5>

                                    <p>Nama Gereja : <span class="fw-bold">{{ $gereja->nama_jemaat }}</span></p>
                                    <p>Klasis : <span class="fw-bold">{{ $gereja->klasis->nama_klasis }}</span></p>
                                    <p>Pelayan/Pendeta : <span class="fw-bold">{{ $gereja->pelayan }}</span></p>
                                    <p>Alamat : <span class="fw-bold">{{ $gereja->alamat }}</span></p>

                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="faq-section section-padding">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-12">
                    <h2 class="mb-4">Jadwal Ibadah</h2>
                </div>

                <div class="clearfix"></div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Anggota</th>
                            <th scope="col">Kelompok</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Pelayan Firman</th>
                            <th scope="col">Tempat Ibadah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwal_ibadah as $d)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $d->anggota->nama_anggota }}</td>
                                <td>{{ $d->kelompok }}</td>
                                <td>{{ Carbon::parse($d->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ $d->pelayan_firman }}</td>
                                <td>{{ $d->tempat_ibadah }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
