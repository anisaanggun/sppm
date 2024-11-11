<!-- Main Sidebar Container -->
  <aside class="main-sidebar" >
    <!-- Brand Logo -->
    <a href="" class="brand-link" style="text-align: center;">
      <img src="/img/Logo2.png" alt="">
    </a>


    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('/admin') }}" class="nav-link {{ Request::segment(1) == 'admin'? 'active-link' : 'nonactive-link' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Beranda
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/jadwal') }}" class="nav-link {{ Request::segment(1) == 'jadwal'? 'active-link' : 'nonactive-link' }}">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Jadwal
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{ url('/data') }}" class="nav-link {{ Request::segment(1) == 'data'? 'active-link' : 'nonactive-link' }}">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/data-mesin') }}" class="nav-link {{ Request::segment(1) == 'data-mesin'? 'active-link' : 'nonactive-link' }}">
                  <i class="far fa- nav-icon"></i>
                  <p>Mesin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/data-perawatan') }}" class="nav-link {{ Request::segment(1) == 'data-perawatan'? 'active-link' : 'nonactive-link' }}">
                  <i class="far fa- nav-icon"></i>
                  <p>Perawatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/data-perbaikan') }}" class="nav-link {{ Request::segment(1) == 'data-perbaikan'? 'active-link' : 'nonactive-link' }}">
                  <i class="far fa- nav-icon"></i>
                  <p>Perbaikan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item ">
            <a href="{{ url('/laporan') }}" class="nav-link {{ Request::segment(1) == 'laporan'? 'active-link' : 'nonactive-link' }}">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Laporan
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
