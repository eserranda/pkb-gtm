@extends('layouts.master')
@section('page_title')
    Dashboard
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card-box tilebox-one">
                <i class="fe-box float-right"></i>
                <h5 class="text-muted text-uppercase mb-3 mt-0">Klasis</h5>
                <h3 class="mb-3" data-plugin="counterup">{{ $data_klasis }}</h3>
                <span class="vertical-middle">Data klasis </span>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card-box tilebox-one">
                <i class="fe-layers float-right"></i>
                <h5 class="text-muted text-uppercase mb-3 mt-0">Jemaat</h5>
                <h3 class="mb-3" data-plugin="counterup">> {{ $data_jemaat }}</h3>
                <span class="vertical-middle">Data Jemaat </span>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card-box tilebox-one">
                <i class="fe-tag float-right"></i>
                <h5 class="text-muted text-uppercase mb-3 mt-0">Anggota Jemaat</h5>
                <h3 class="mb-3" data-plugin="counterup">> {{ $anggota_jemaat }}</h3>
                <span class="vertical-middle">Anggota Jemaat Terdaftar </span>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card-box tilebox-one">
                <i class="fe-briefcase float-right"></i>
                <h5 class="text-muted text-uppercase mb-3 mt-0">Anggota PKB</h5>
                <h3 class="mb-3" data-plugin="counterup">{{ $anggota_pkb }}</h3>
                <span class="vertical-middle">Anggota PKB terdaftar</span>
            </div>
        </div>
    </div>
@endsection
