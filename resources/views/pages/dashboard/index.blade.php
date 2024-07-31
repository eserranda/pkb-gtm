@extends('layouts.master')
@section('page_title')
    Dashboard
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card-box tilebox-one">
                <i class="fe-box float-right"></i>
                <h5 class="text-muted text-uppercase mb-3 mt-0">Orders</h5>
                <h3 class="mb-3" data-plugin="counterup">1,587</h3>
                <span class="badge badge-primary"> +11% </span> <span class="text-muted ml-2 vertical-middle">From previous
                    period</span>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card-box tilebox-one">
                <i class="fe-layers float-right"></i>
                <h5 class="text-muted text-uppercase mb-3 mt-0">Revenue</h5>
                <h3 class="mb-3">$<span data-plugin="counterup">46,782</span></h3>
                <span class="badge badge-primary"> -29% </span> <span class="text-muted ml-2 vertical-middle">From previous
                    period</span>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card-box tilebox-one">
                <i class="fe-tag float-right"></i>
                <h5 class="text-muted text-uppercase mb-3 mt-0">Average Price</h5>
                <h3 class="mb-3">$<span data-plugin="counterup">15.9</span></h3>
                <span class="badge badge-primary"> 0% </span> <span class="text-muted ml-2 vertical-middle">From previous
                    period</span>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card-box tilebox-one">
                <i class="fe-briefcase float-right"></i>
                <h5 class="text-muted text-uppercase mb-3 mt-0">Product Sold</h5>
                <h3 class="mb-3" data-plugin="counterup">1,890</h3>
                <span class="badge badge-primary"> +89% </span> <span class="text-muted ml-2 vertical-middle">Last
                    year</span>
            </div>
        </div>
    </div>
@endsection
