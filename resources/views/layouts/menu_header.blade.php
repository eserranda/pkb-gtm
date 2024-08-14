<div class="topbar-menu">
    <div class="container-fluid">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">

                <li class="has-submenu">
                    <a href="/dashboard"><i class="fe-grid"></i>Dashboard</a>
                </li>

                <li class="has-submenu">
                    @if (auth()->user()->hasAnyRole(['super_admin', 'klasis', 'sinode', 'jemaat']))
                        <a href="#">
                            <i class="fe-airplay"></i>
                            Data Administrasi
                        </a>
                    @endif
                    <ul class="submenu">
                        @if (auth()->user()->hasAnyRole(['super_admin', 'sinode']))
                            <li><a href="/surat-masuk-sinode">Surat Masuk</a></li>
                        @endif
                        @if (auth()->user()->hasAnyRole(['super_admin', 'klasis', 'sinode']))
                            <li><a href="/klasis">Data Klasis</a></li>
                            <li><a href="/jemaat">Data Jemaat</a></li>
                        @endif
                        @if (auth()->user()->hasAnyRole(['super_admin', 'jemaat', 'sinode']))
                            <li><a href="/anggota-jemaat">Anggota Jemaat</a></li>
                            <li><a href="/anggota-pkb">Anggota PKB</a></li>
                        @endif
                    </ul>
                </li>


                @if (auth()->user()->hasAnyRole(['super_admin', 'sinode']))
                    <li class="has-submenu">
                        <a href="program"><i class="fe-briefcase"></i>Program Kerja</a>
                    </li>
                @endif

                @if (auth()->user()->hasAnyRole(['super_admin', 'sinode', 'bendahara_sinode']))
                    <li class="has-submenu">
                        <a href="rencana-anggaran"><i class="mdi mdi-spa-outline"></i>Rencana Anggaran</a>
                    </li>
                @endif


                @if (auth()->user()->hasAnyRole(['super_admin', 'jemaat', 'anggota_jemaat']))
                    <li class="has-submenu">
                        <a href="#">
                            <i class="mdi mdi-shield-cross-outline"></i>Jadwal Pelayanan</a>
                        <ul class="submenu">
                            <li><a href="jadwal-ibadah">Jadwal Pelayanan Ibadah</a></li>
                            {{-- <li><a href="ui-cards.html">Pelayanan Diakonia</a></li> --}}
                        </ul>
                    </li>
                @endif

                <li class="has-submenu">
                    <a href="#"><i class="mdi mdi-account-key-outline"></i>Users </a>
                    <ul class="submenu">
                        @if (auth()->user()->hasAnyRole(['super_admin', 'klasis']))
                            <li><a href="/users-klasis">Users Klasis</a></li>
                        @endif
                        @if (auth()->user()->hasAnyRole(['super_admin', 'jemaat']))
                            <li><a href="/users-jemaat">Users Jemaat</a></li>
                        @endif
                        @if (auth()->user()->hasAnyRole(['super_admin', 'sinode']))
                            <li><a href="/users">Users</a></li>
                        @endif
                    </ul>
                </li>

                <li class="has-submenu">
                    <a href="#"> <i class="fe-settings"></i>Pengaturan</a>
                    <ul class="submenu">
                        <li><a href="roles">Role User Akses</a></li>
                    </ul>
                </li>

            </ul>
            <!-- End navigation menu -->

            <div class="clearfix"></div>
        </div>
        <!-- end #navigation -->
    </div>
    <!-- end container -->
</div>
<!-- end navbar-custom -->

</header>
<!-- End Navigation Bar-->
