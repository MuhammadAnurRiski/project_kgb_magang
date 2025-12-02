<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4" style="background-color:#2e2f6e;">
  <!-- Brand Logo -->
  <a href="#" class="brand-link d-flex align-items-center justify-content-center" style="gap:6px; border-bottom: none;">
    <img src="{{ asset('image/logo_kemenkum.png') }}" alt="Logo" style="width:25px; height:auto;">
    <span class="brand-text font-weight-bold" style="color:#fff;">KGB</span>
    <span class="brand-text" style="color:#b8b8d4;">Kemenkum</span>
  </a>

  <hr style="border-color:#444; width:80%; margin: 10px auto;">

  <!-- Sidebar -->
  <div class="sidebar" style="padding-top:20px;">

    <!-- User Panel -->
    <div class="user-panel d-flex flex-column align-items-center text-center mb-3">
      <img src="{{ asset('image/AdminLTELogo.png') }}" class="img-circle elevation-2 mb-2" style="width:60px; height:60px; object-fit:cover;" alt="User Image">
      <a href="#" class="d-block text-white font-weight-bold">Admin</a>
    </div>

    <hr style="border-color:#444; width:80%; margin: 10px auto;">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" role="menu">

        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link text-white">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('pegawai.index') }}" class="nav-link text-white">
            <i class="nav-icon fas fa-user"></i>
            <p>Profil Pegawai</p>
          </a>
        </li>

        <hr style="border-color:#444; width:80%; margin: 10px auto;">

        <li class="nav-item">
          <a href="{{ route('surat.index') }}" class="nav-link text-white">
            <i class="nav-icon fas fa-print"></i>
            <p>Cetak Surat</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('dokumen.index') }}" class="nav-link text-white">
            <i class="nav-icon fas fa-folder-open"></i>
            <p>Manajemen Dokumen</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('pengaturan.index') }}" class="nav-link text-white">
            <i class="nav-icon fas fa-ellipsis-h"></i>
            <p>Pengaturan</p>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</aside>

<!-- Custom CSS -->
<style>
.main-sidebar {
  border-right: none !important;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.nav-sidebar > .nav-item > .nav-link {
  border-radius: 10px;
  margin: 4px 12px;
  transition: all 0.2s ease-in-out;
}

.nav-sidebar > .nav-item > .nav-link:hover {
  background-color: #3a3b8f;
}

.nav-sidebar > .nav-item > .nav-link.active {
  background-color: #4546a3;
  font-weight: bold;
}

hr {
  opacity: 0.3;
}
</style>
