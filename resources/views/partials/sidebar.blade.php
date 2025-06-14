<aside class="main-sidebar sidebar-dark-primary elevation-5">
  <!-- Brand Logo -->
  <a href="/pelanggan" class="brand-link">
    <img src="{{ asset('dist/img/servicecomputer.jpg') }}" alt="Bro CompService Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Bro CompServices</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar d-flex flex-column h-100"> {{-- Tambahkan d-flex & h-100 --}}
    <!-- Sidebar Menu -->
    <nav class="mt-2 flex-grow-1">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ url('/admin') }}" class="nav-link">
            <i class="nav-icon fas fa-user-shield"></i>
            <p>Admin</p>
          </a>
        </li>
        <!-- Tambahkan menu lain jika ada -->
      </ul>
    </nav>

    <!-- Setting dan Logout di bawah -->
    <div class="p-2">
      <ul class="nav nav-pills nav-sidebar flex-column">
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>Setting</p>
          </a>
        </li>
        <li class="nav-item">
          <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Yakin ingin logout?');">
            @csrf
            <button type="submit" class="nav-link btn btn-link text-left text-white w-100" style="border: none;">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</aside>