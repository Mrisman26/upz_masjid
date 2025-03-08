<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('zakat.index') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">UPZ Masjid <sup>At-Taqwa</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Zakat
    </div>

    <!-- Nav Item - Daftar KK -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kepala-keluarga.index') }}">
            <i class="fas fa-home"></i>
            <span>Daftar Kepala Keluarga</span>
        </a>
    </li>

    <!-- Nav Item - Daftar Muzaki -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('zakat.index') }}">
            <i class="fas fa-users"></i>
            <span>Daftar Muzaki</span>
        </a>
    </li>

    <!-- Nav Item - Daftar Mustahik -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('mustahik.index') }}">
            <i class="fas fa-user"></i>
            <span>Daftar Mustahik</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data RT/RW
    </div>

    <!-- Nav Item - RT/RW -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('rt-rw.index') }}">
            <i class="fas fa-map-marked-alt"></i>
            <span>Data RT/RW</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Nav Item - Rekapitulasi -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRekap" aria-expanded="false"
            aria-controls="collapseRekap">
            <i class="fas fa-chart-bar"></i>
            <span>Rekapitulasi</span>
        </a>
        <div id="collapseRekap" class="collapse" aria-labelledby="headingRekap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Rekap Data:</h6>
                <a class="collapse-item" href="{{ route('rekap-zakat') }}">Rekap Zakat</a>
                <a class="collapse-item" href="{{ route('rekap-mustahik') }}">Rekap Mustahik</a>
                <a class="collapse-item" href="{{ route('rekap-kalkulator') }}">Kalkulator</a>
            </div>
        </div>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
