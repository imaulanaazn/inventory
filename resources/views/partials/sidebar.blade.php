<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    @auth
    @if (auth()->user()->role === 'admin')

    <!-- Nav Item - Dashboard -->

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStok"
            aria-expanded="true" aria-controls="collapseStok">
            <i class="fas fa-fw fa-cog"></i>
            <span>Stok</span>
        </a>
        <div id="collapseStok" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item" href="{{route('stok-bahan-baku.show')}}">Bahan Baku</a>
                <a class="collapse-item" href="{{route('stok-barang-setengah-jadi.show')}}">Barang Setengah Jadi</a>
                <a class="collapse-item" href="{{route('stok-barang-jadi.show')}}">Barang Jadi</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePemesanan"
            aria-expanded="true" aria-controls="collapsePemesanan">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Pemesanan</span>
        </a>
        <div id="collapsePemesanan" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('pemesanan-bahan-baku.show')}}">Bahan Baku</a>
                <a class="collapse-item" href="{{route('pemesanan-barang-jadi.show')}}">Knalpot</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBarangMasuk"
            aria-expanded="true" aria-controls="collapseBarangMasuk">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Barang Masuk</span>
        </a>
        <div id="collapseBarangMasuk" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('barang-setengah-jadi-masuk.show')}}">Barang Setengah Jadi</a>
                <a class="collapse-item" href="{{route('barang-jadi-masuk.show')}}">Barang Jadi</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBarangKeluar"
            aria-expanded="true" aria-controls="collapseBarangKeluar">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Barang Keluar</span>
        </a>
        <div id="collapseBarangKeluar" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('bahan-baku-keluar.show')}}">Bahan Baku</a>
                <a class="collapse-item" href="{{route('barang-setengah-jadi-keluar.show')}}">Barang Setengah Jadi</a>
                <a class="collapse-item" href="{{route('barang-jadi-keluar.show')}}">Barang Jadi</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dataBarang"
            aria-expanded="true" aria-controls="dataBarang">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Data</span>
        </a>
        <div id="dataBarang" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('bahan-baku.show')}}">Bahan Baku</a>
                <a class="collapse-item" href="{{route('barang-setengah-jadi.show')}}">Barang Setengah Jadi</a>
                <a class="collapse-item" href="{{route('barang-jadi.show')}}">Barang Jadi</a>
                <a class="collapse-item" href="{{route('customer.show')}}">Customer</a>
                <a class="collapse-item" href="{{route('potongan.show')}}">Potongan</a>
            </div>
        </div>
    </li>

    @endif
    @endauth

    <li class="nav-item">
        <a class="nav-link" href="">
            <span>Download Laporan</span></a>
    </li>

    @auth
    @if (auth()->user()->role === 'manager')
    <li class="nav-item">
        <a class="nav-link" href="">
            <span>Kelola User</span>
        </a>
    </li>
    @endif
    @endauth

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->