 <!-- Topbar -->
 <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>

<!-- Topbar Search -->

 <!-- <div class="running-text-container">
        <img src="img/logo.png" alt="Gambar" width="27" height="27">
        Thirft shop & Kaos band
    </div> -->
<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

    <!-- Nav Item - Messages -->
    <li class=" no-arrow mx-1">
        
        <div class="medsos pt-4">

            <a href="https://www.instagram.com/toko99sub/"><i class="bi bi-instagram text-danger"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
        </div>
        
    </li>

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        @auth
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth()->user()->nama}}</span>
        <img class="img-profile rounded-circle"
        src="img/undraw_profile.svg">
    </a>
    @endauth
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            @can('admin')
            <a class="dropdown-item" href="/user/{{Auth()->user()->id}}/edit">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profile
            </a>
            <div class="dropdown-divider"></div>
            @endcan
            <form action="/logout" method="post">
            @csrf
            <button class="dropdown-item"><i class="bi bi-box-arrow-right mx-1"></i>Logout</button>
                
            </form>
        </div>
    </li>
    
</ul>
</nav>
@if(Request::is('training'))
<div class="d-sm-flex align-items-center justify-content-end mb-4 mr-5">
                <a href="/truncate" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"> <i class="bi bi-x-square"></i> Kosongakan Tabel</a>
            </div>
@endif
<!-- End of Topbar -->