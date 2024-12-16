<nav class="main-header navbar navbar-expand">
    <!-- Form Pencarian dengan Ikon dalam Tombol -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <div class="search-container">
        <input type="text" placeholder="Cari..." class="search-input">
    </div>

    <!-- navigasi header -->
    <ul class="navbar-nav ml-auto">
        <!-- heder user -->
        <li class="nav-item dropdown">
            <a class="nav-links dropdown-toggle mr-lg-2" href="#" id="alertsDropdown" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" style="font-weight:bold;">
                <i class="fa fa-fw fa-user"></i>
                <span class="d-lg-none">
                    <span class="badge badge-pill badge-warning"></span>
                </span>
                {{ auth()->user()->name }}
            </a>
            <!-- start dropdown -->
            <div class="dropdown-menu mr-5 mt-3" aria-labelledby="alertsDropdown"
                style="border-radius: 10px; border:0;">
                <!-- start ubah data pribadi -->
                <a class="dropdown-item" href="{{ url('profil') }}" id="mn_ubahdata">
                    <span class="text-primary">
                        <strong>
                            <i class="fa fa-edit"></i>
                            Ubah Data Pribadi</strong>
                    </span>
                </a><!-- end ubah data pribadi -->
                <div class="dropdown-divider"></div> <!-- Divider antara menu -->
                <form action="{{ route('logout') }}" method="post" class="dropdown-item">
                    @csrf
                    <button class="btn text-danger p-0" type="submit">
                        <i class="fa-solid fa-right-from-bracket mr-2"></i> <strong>Logout</strong>
                    </button>
                </form>
                <!-- End Logout -->
            </div><!-- end dropdown -->
        </li><!-- end header user -->
    </ul><!-- end navgiasi header -->
</nav>
