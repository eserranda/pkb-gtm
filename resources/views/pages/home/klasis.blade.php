@extends('pages.home.layouts.master')

@section('hero')
    <section class="hero-section d-flex justify-content-center align-items-center" id="section_1">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-12 mx-auto">
                    <h2 class="text-white text-center">Data Klasis GTM</h2>
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
                    <h2 class="mb-4">Daftar Klasis</h2>
                </div>

                <div class="clearfix"></div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Klasis</th>
                            <th scope="col">Wilayah</th>
                            <th scope="col">Koordinator</th>
                            <th scope="col">No Telp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($klasis as $d)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $d->nama_klasis }}</td>
                                <td>{{ $d->wilayah }}</td>
                                <td>{{ $d->koordinator }}</td>
                                <td>{{ $d->no_telp }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
