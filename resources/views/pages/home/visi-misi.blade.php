@extends('pages.home.layouts.master')

@section('hero')
    <section class="hero-section d-flex justify-content-center align-items-center" id="section_1">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-12 mx-auto">
                    <h2 class="text-white text-center">Selamat Datang</h2>

                    <h5 class="text-center">Persekutuan Kaum Bapak Gereja Toraja Mamasa</h5>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="explore-section section-padding" id="section_2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12 mb-4 mb-lg-3">
                    <div class="custom-block bg-white shadow-lg">
                        <a href="topics-detail.html">
                            <div class="d-flex">
                                <div>
                                    <h5 class="mb-2">Visi</h5>
                                    <p class="mb-0">Mewujudkan gereja yg utuh mandiri dan misioner</p>
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
                                    <h5 class="mb-2">Misi</h5>

                                    <ul>
                                        <li>
                                            Menjadi wadah pelayanan untuk membangun persekutuan dengan tujuan meningkatkan
                                            persekutuan kamu bapak pada lingkup jemaat, klasis dan sinode
                                        </li>

                                        <li>
                                            Mengembangkan organisasi PKB GTM berdasarkan prinsip-prinsip eklesiologi GTM
                                        </li>

                                        <li>
                                            Mewujudkan kemandirian teologi kontekstual warga jemaat untuk menjawab berbagai
                                            tantangan
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
