@extends('pages.home.layouts.master')

@section('hero')
    <section class="hero-section d-flex justify-content-center align-items-center" id="section_1">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-12 mx-auto">
                    <h2 class="text-white text-center">Sejarah Singkat PKB GTM</h2>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('content')
    {{-- khusus home --}}
    <section class="featured-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-12 mb-4 mb-lg-0">
                    <div class="custom-block bg-white shadow-lg">
                        <a href="topics-detail.html">
                            <div class="d-flex">
                                <div>
                                    <h5 class="mb-3">PKB GTM</h5>
                                </div>
                            </div>

                            <img src="{{ asset('home_assets') }}/images/pkb.png" class="img-fluid" alt="">
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 col-12">
                    <div class="custom-block custom-block-overlay">
                        <div class="d-flex flex-column h-200">
                            <img src="{{ asset('home_assets') }}/images/pkb.png" class="custom-block-image img-fluid"
                                alt="">

                            <div class="custom-block-overlay-text d-flex">
                                <div>
                                    <h5 class="text-white mb-2">Sejarah Singkat</h5>
                                    <p class="text-white">
                                        Persekutuan Kaum Bapak Gereja Toraja Mamasa disingkat PKB-GTM adalah wadah
                                        yang dibentuk khusus untuk
                                        mempersekutukan dan memperlengkapi warga Gereja Toraja Mamasa (GTM) kategori
                                        laki-laki dewasa untuk
                                        melaksanakan fungsinya sebagai bapa, bersaksi, bersekutu, dan melayani dalam
                                        mewujudkan Visi-Misi Gereja
                                        Toraja Mamasa (Utuh, Mandiri dan Misioner) Berdasarkan pada Alkitab dan Tata
                                        Dasar dan tata Rumah Tangga
                                        Gereja Toraja Mamasa (TD/TRT GTM). Dengan demikian PKB-GTM merupakan
                                        persekutuan kategori dan bagian
                                        yang tidak terpisahkan dari persekutuan GTM pada semua lingkup, yakni
                                        Jemaat, Klasis dan Sinode.
                                    </p>
                                    <p class="text-white">
                                        Persekutuan Kaum Bapak Gereja Toraja Mamasa (PKB-GTM) pada lingkup sinodal
                                        dibentuk dalam Pertemuan AM I
                                        PKB-GTM yang berlangsung pada tanggal 31 Mei s/d 2 Juni 2018 di Aula Eran
                                        Maelo Saelako Tondok Tallu
                                        Sumarorong berdasarkan Amanat Keputusan Sidang Majelis Sinode Am GTM XIX
                                        Tahun 2016.
                                    </p>

                                </div>
                            </div>
                            <div class="section-overlay"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
