<!-- Content -->

<div class="wrapper">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">PKB GTRM</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                            <li class="breadcrumb-item">{{ basename(url()->current()) }}</li>
                        </ol>
                    </div>
                    <h4 class="page-title"> @yield('page_title')</h4>
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- end page title -->


    </div> <!-- end container -->
</div>
<!-- Content -->
