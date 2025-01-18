<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>CAFE 99</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.min.css">
  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ url('/') }}" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block">Cafe 99</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown mr-3">
        <a class="nav-link nav-profile d-flex align-items-center pe-0 mr-3" href="#" data-bs-toggle="dropdown">
              @if( Session::get('karyawan_foto'))
                  <img src="{{ Session::get('karyawan_foto') }}" alt="Profile Image" class="rounded-circle" >

              @endif
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ session('karyawan_nama') }}</span>
        </a><!-- End Profile Image Icon -->
<!-- End Profile Image Icon -->
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6> {{ session('karyawan_nama') }}</h6>
              <span> {{ session('karyawan_role') }}</span>
            </li>
          
            <li><hr class="dropdown-divider"></li>
            <li>
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="dropdown-item d-flex align-items-center">
            <i class="bi bi-box-arrow-right"></i>
            <span>Sign Out</span>
        </button>
    </form>
</li> 

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->
      </ul>
    </nav><!-- End Icons Navigation --> 
  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        @if(session('karyawan_role') == 'Admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->
        @endif

        @if(session('karyawan_role') == 'User')
            <li class="nav-item">
                <a class="nav-link" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i>
                    <span>Menu</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('menu') }}" class="active">
                            <i class="bi bi-circle"></i>
                            <span>Menu</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Components Nav -->
        @endif

        @if(session('karyawan_role') == 'Admin')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i>
                    <span>Produk</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <a href="{{ route('produk.index') }}">
                        <i class="bi bi-circle"></i>
                        <span>Data Produk</span>
                    </a>
                    <a href="{{ route('produk.create') }}">
                        <i class="bi bi-circle"></i>
                        <span>Tambah Produk</span>
                    </a>
                </ul>
            </li><!-- End Forms Nav -->
        @endif

        @if(session('karyawan_role') == 'Admin')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i>
                    <span>Member</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <a href="{{ route('member.index') }}">
                        <i class="bi bi-circle"></i>
                        <span>Data Member</span>
                    </a>
                    <a href="{{ route('member.create') }}">
                        <i class="bi bi-circle"></i>
                        <span>Tambah Member</span>
                    </a>
                </ul>
            </li><!-- End Tables Nav -->
        @endif
        @if(session('karyawan_role') == 'Admin')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav-t" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i>
                    <span>Transaksi</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav-t" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                  
                    <a href="{{ route('transactions.index') }}">
                        <i class="bi bi-circle"></i>
                        <span>Riwayat Transaksi</span>
                    </a>
                </ul>
            </li><!-- End Tables Nav -->
        @endif

        @if(session('karyawan_role') == 'User')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-gem"></i>
                    <span>Point</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="icons-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('points.index') }}">
                            <i class="bi bi-circle"></i>
                            <span>Point</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Icons Nav -->
        @endif
        
        @if(session('karyawan_role') == 'Admin')
        <li class="nav-heading">Pages</li>
        
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('profil') }}">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->
        @endif
    </ul>
</aside>


  <main id="main" class="main">     @yield('content')</main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Cafe99</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by BerlianaAsyijar
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
  <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.min.js"></script>
  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
