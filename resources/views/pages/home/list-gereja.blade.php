@extends('pages.home.layouts.master')

@section('hero')
    <section class="hero-section d-flex justify-content-center align-items-center" id="section_1">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-12 mx-auto">
                    <h2 class="text-white text-center">Daftar Gereja </h2>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('content')
    <section class="faq-section section-padding" id="section_4">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-12">
                    <h2 class="mb-4">Daftar Gereja</h2>
                </div>

                <div class="clearfix"></div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Klasis</th>
                            <th scope="col">Nama Jemaat</th>
                            <th scope="col">Pelayan/Pendeta</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gereja as $d)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $d->klasis->nama_klasis }}</td>
                                <td>{{ $d->nama_jemaat }}</td>
                                <td>{{ $d->pelayan }}</td>
                                <td>{{ $d->alamat }}</td>
                                <td><a href="{{ route('home.detail-gereja', $d->id) }}" class="btn btn-primary">Detail</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
