
<nav class="header navbar navbar-expand">
    <!-- Form Pencarian dengan Ikon dalam Tombol -->
    <div class="search-container">
        <input type="text" placeholder="Cari..." class="search-input">
      </div>

    <!-- navigasi header -->
    <ul class="navbar-nav ml-auto">
        <!-- heder user -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" href="#" id="alertsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-user"></i>
            <span class="d-lg-none">
              <span class="badge badge-pill badge-warning"></span>
            </span>
            Budiman
          </a>
          <!-- start dropdown -->
          <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <!-- start ubah data pribadi -->
            <a class="dropdown-item" href="?cs=Ubah-Data" id="mn_ubahdata">
              <span class="text-primary">
                <strong>
                  <i class="fa fa-edit"></i>
                  Ubah Data Pribadi</strong>
              </span>
            </a><!-- end ubah data pribadi -->

            <!-- start ubah sandi -->
            <a class="dropdown-item" href="?cs=Ubah-Sandi">
              <span class="text-success">
                <strong>
                    <i class="fa-solid fa-key"></i>
                  Ubah Kata Sandi</strong>
              </span>
            </a> <!-- end ubah sandi -->
            <div class="dropdown-divider"></div> <!-- Divider antara menu -->
            <form action="/logout" method="post" class="dropdown-item">
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
