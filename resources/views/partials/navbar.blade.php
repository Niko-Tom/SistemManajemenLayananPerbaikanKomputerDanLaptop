<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <!-- Hamburger untuk toggle sidebar -->
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item">
      <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
    </li>
    <li class="nav-item">
      <a href="{{ url('/pelanggan') }}" class="nav-link">Pelanggan</a>
    </li>
    <li class="nav-item">
      <a href="{{ url('/layanan') }}" class="nav-link">Layanan</a>
    </li>
    <li class="nav-item">
      <a href="{{ url('/transaksi') }}" class="nav-link">Transaksi</a>
    </li>
    <li class="nav-item">
      <a href="{{ url('/detailTransaksi') }}" class="nav-link">Detail Transaksi</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">

    <!-- Search -->
    <li class="nav-item">
      <a class="nav-link" data-widget="navbar-search" href="#" role="button">
        <i class="fas fa-search"></i>
      </a>
      <div class="navbar-search-block">
        <form class="form-inline">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
              <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li>

    <!-- Messages -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-comments"></i>
        <span class="badge badge-danger navbar-badge">3</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <a href="#" class="dropdown-item">
          <div class="media">
            <img src="{{ asset('dist/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                Bagus Winata
                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">Assalamualaikum, selamat...</p>
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Jam Yang Lalu</p>
            </div>
          </div>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">Lihat Semua Pesan</a>
      </div>
    </li>

    <!-- Notifications -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">15</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">15 Notifikasi</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-envelope mr-2"></i> 4 Pesan Baru
          <span class="float-right text-muted text-sm">3 menit</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">Lihat Semua Notifikasi</a>
      </div>
    </li>

    <!-- Fullscreen -->
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>

    <!-- Theme Toggle -->
    <li class="nav-item">
      <a class="nav-link" href="#" role="button" id="theme-toggle">
        <i class="fas fa-moon"></i>
      </a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->
