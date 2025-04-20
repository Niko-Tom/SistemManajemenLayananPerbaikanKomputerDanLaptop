<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Layanan Perbaikan Komputer dan Laptop</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- AdminLTE -->
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">

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
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}"></script>

</body>
</html>
