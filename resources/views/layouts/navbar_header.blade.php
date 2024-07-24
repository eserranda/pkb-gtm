  <!-- Topbar Start -->
  <div class="navbar-custom">
      <div class="container-fluid">
          <ul class="list-unstyled topnav-menu float-right mb-0">

              <li class="dropdown notification-list">
                  <!-- Mobile menu toggle-->
                  <a class="navbar-toggle nav-link">
                      <div class="lines">
                          <span></span>
                          <span></span>
                          <span></span>
                      </div>
                  </a>
                  <!-- End mobile menu toggle-->
              </li>
              <li class="dropdown notification-list">
                  <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown"
                      href="#" role="button" aria-haspopup="false" aria-expanded="false">
                      <img src="{{ asset('assets') }}/images/users/avatar-1.jpg" alt="user-image"
                          class="rounded-circle">
                      <span class="ml-1">Indra <i class="mdi mdi-chevron-down"></i> </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                      <!-- item-->
                      <div class="dropdown-header noti-title">
                          <h6 class="text-overflow m-0">Welcome !</h6>
                      </div>

                      <!-- item-->
                      <a href="javascript:void(0);" class="dropdown-item notify-item">
                          <i class="fe-user"></i>
                          <span>Profile</span>
                      </a>

                      <!-- item-->
                      <a href="javascript:void(0);" class="dropdown-item notify-item">
                          <i class="fe-settings"></i>
                          <span>Settings</span>
                      </a>

                      <!-- item-->
                      <a href="javascript:void(0);" class="dropdown-item notify-item">
                          <i class="fe-lock"></i>
                          <span>Lock Screen</span>
                      </a>

                      <div class="dropdown-divider"></div>

                      <!-- item-->
                      <a href="javascript:void(0);" class="dropdown-item notify-item">
                          <i class="fe-log-out"></i>
                          <span>Logout</span>
                      </a>

                  </div>
              </li>

          </ul>

          <!-- LOGO -->
          <div class="logo-box">
              <a href="index.html" class="logo text-center">
                  <span class="logo-lg">
                      {{-- <img src="{{ asset('assets') }}/images/logo-light.png" alt="" height="16"> --}}
                      <span class="logo-lg-text-light">PKM - GTM</span>
                  </span>
                  <span class="logo-sm">
                      <!-- <span class="logo-sm-text-dark">U</span> -->
                      <img src="{{ asset('assets') }}/images/logo-sm.png" alt="" height="24">
                  </span>
              </a>
          </div>

      </div> <!-- end container-fluid-->
  </div>
  <!-- end Topbar -->
