 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <!-- <div class="sidebar-brand-icon ">
       <img src="/img/logo.png" alt="" width="50" height="50">
    </div> -->
    @can('admin')

    <div class="sidebar-brand-text mx-3">Administrator</div>
    @else
    <div class="sidebar-brand-text mx-3">Kasir Toko</div>
    @endcan
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="home">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>DASHBOARD</span></a>
</li>





<!-- Divider -->

<hr class="sidebar-divider">
@can('admin')


           
<li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="bi bi-database-add"></i>
                    <span>DATA MASTER</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        
                        <a class="collapse-item {{ Request::is('produk') ? 'active' : '' }}" href="/produk">Data Produk</a>
                        <a class="collapse-item {{ Request::is('transaksi') ? 'active' : '' }}" href="/transaksi">Data Transaksi</a>
                        <a class="collapse-item {{ Request::is('user') ? 'active' : '' }}" href="/user">Data User</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">
<li class="nav-item {{ Request::is('training') ? 'active' : '' }}">
    <a class="nav-link " href="/training">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>REGRESI LINIER</span></a>
</li>
<li class="nav-item {{ Request::is('prediksi') ? 'active' : '' }}">
    <a class="nav-link " href="/prediksi">
    <i class="bi bi-graph-up-arrow"></i>
        <span>PREDIKSI</span></a>
    </li>
    <li class="nav-item {{ Request::is('presentase') ? 'active' : '' }}">
        <a class="nav-link" href="/presentase">
        <i class="bi bi-percent"></i>
            <span>AKURASI</span></a>
    </li>
    <li class="nav-item {{ Request::is('laporan') ? 'active' : '' }}">
        <a class="nav-link " href="/laporan">
        <i class="bi bi-printer"></i>
            <span>LAPORAN</span></a>
        </li>
        <hr class="sidebar-divider d-none d-md-block">
            @else
<li class="nav-item {{ Request::is('transaksi') ? 'active' : '' }}">
    <a class="nav-link " href="/transaksi">
    <i class="bi bi-cash-coin"></i>
        <span>DATA TRANSAKSI</span></a>
    </li>
    <li class="nav-item {{ Request::is('laporan') ? 'active' : '' }}">
        <a class="nav-link " href="/laporan">
        <i class="bi bi-printer"></i>
            <span>LAPORAN</span></a>
        </li>
        <hr class="sidebar-divider d-none d-md-block">
     @endcan
       
<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->