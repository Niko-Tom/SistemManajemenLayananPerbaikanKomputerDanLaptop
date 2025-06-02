<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Layanan Perbaikan Komputer dan Laptop</title>

  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">


  <style>
  .content-wrapper {
    height: calc(100vh - 114px);
    overflow-y: auto;
    padding-bottom: 2rem;
  }
</style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Loader -->
<div id="loader-overlay">
  <img src="{{ asset('dist/img/servicecomputer.jpg') }}" alt="Loading..." height="100">
</div>

<div class="wrapper">
  
  {{-- Navbar dan Sidebar --}}
  @include('partials.navbar')
  @include('partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper p-4">
    @yield('content')
  </div>

  <!-- Main Footer -->
  <footer class="main-footer text-center">
    <strong>&copy; {{ date('Y') }} Sistem Manajemen Layanan Perbaikan Komputer dan Laptop / 231220011</strong>
  </footer>

</div>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const loader = document.getElementById('loader-overlay');

    // Deteksi jika halaman berasal dari back/forward cache
    window.addEventListener('pageshow', function (event) {
      if (event.persisted) {
        loader.classList.add('hidden');
      } else {
        // Tampilkan loader selama 2 detik jika bukan dari back/forward
        setTimeout(() => {
          loader.classList.add('hidden');
        }, 500);
      }
    });

    // Tampilkan loading saat klik link
    document.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', function (e) {
        const href = link.getAttribute('href');
        if (href && !href.startsWith('#') && !href.startsWith('javascript:')) {
          const loader = document.getElementById('loader-overlay');
          if (loader) {
            loader.classList.remove('hidden');
          }
        }
      });
    });
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.getElementById('theme-toggle');
    const body = document.body;
    const icon = toggle?.querySelector('i');

    // Apply saved theme on page load
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
      body.classList.add('dark-mode');
      if (icon) {
        icon.classList.remove('fa-moon');
        icon.classList.add('fa-sun');
      }
    }

    // Toggle on click
    toggle?.addEventListener('click', (e) => {
      e.preventDefault();
      const isDark = body.classList.toggle('dark-mode');

      if (icon) {
        icon.classList.toggle('fa-moon', !isDark);
        icon.classList.toggle('fa-sun', isDark);
      }

      localStorage.setItem('theme', isDark ? 'dark' : 'light');
    });
  });
</script>
@push('scripts')
<script>
  $(function () {
    $("#transaksiTable").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script>
@endpush
</body>
</html>
