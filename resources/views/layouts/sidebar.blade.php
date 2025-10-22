<!-- Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:#1e1b4b;">

    <!-- Logo + Judul -->
    <a href="{{ url('/') }}" class="brand-link text-center py-3 d-flex align-items-center justify-content-center">
        <img src="{{ asset('images/logo-pengayoman.png') }}" 
             alt="Logo Pengayoman" 
             class="brand-image img-circle elevation-3 me-2"
             style="opacity: .9; width: 32px; height: 32px;">
        <span class="brand-text font-weight-bold text-white">Sistem KGB</span>
    </a>

  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" role="menu">

        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('pegawai.index') }}" class="nav-link {{ request()->is('pegawai*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>Pegawai</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('surat.index') }}" class="nav-link {{ request()->is('surat*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>Surat</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('pengaturan.index') }}" class="nav-link {{ request()->is('pengaturan*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-cogs"></i>
            <p>Pengaturan</p>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</aside>
