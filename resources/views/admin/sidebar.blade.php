    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>


    <!-- Main Sidebar Container -->
    <aside class="main-sidebar">
        <!-- Brand Logo -->
        <a href="#" class="brand-link" style="text-align: center;">
            <img src="{{ asset('/img/Logo2.png') }}" alt="">
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
        

            <!-- Sidebar Menu -->
            <nav class="mt-4">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ url('/admin') }}"
                            class="nav-link {{ Request::segment(1) == 'admin' ? 'active-link' : 'nonactive-link' }}">
                            <span class="iconify mr-2" data-icon="mdi:home" style="font-size: 24px;"></span>
                            <p>
                                Beranda
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/jadwal') }}"
                            class="nav-link {{ Request::segment(1) == 'jadwal' ? 'active-link' : 'nonactive-link' }}">
                            <span class="iconify mr-2" data-icon="mdi:calendar" style="font-size: 24px;"></span>
                            <p>
                                Jadwal
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/') }}"
                            class="nav-link {{ Request::segment(1) == 'data' || Request::segment(1) == 'pemilik-mesin' || Request::segment(1) == 'data-mesin' || Request::segment(1) == 'data-perawatan' || Request::segment(1) == 'data-perbaikan' ? 'active-link' : 'nonactive-link' }}">
                            <span class="iconify mr-2" data-icon="mdi:database" style="font-size: 24px;"></span>
                            <p>
                                Data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/pemilik-mesin') }}"
                                    class="nav-link {{ Request::segment(1) == 'pemilik-mesin' ? 'active-link' : 'nonactive-link' }}">
                                    <span class="iconify mr-2" data-icon="mdi:account" style="font-size: 24px;"></span>
                                    <p>
                                        Pemilik Mesin
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/data-mesin') }}"
                                    class="nav-link {{ Request::segment(1) == 'data-mesin' ? 'active-link' : 'nonactive-link' }}">
                                    <span class="iconify mr-2 ml-1" data-icon="gravity-ui:gear-branches"
                                        style="font-size: 20px;"></span>
                                    <p>
                                        Mesin
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/data-perawatan') }}"
                                    class="nav-link {{ Request::segment(1) == 'data-perawatan' ? 'active-link' : 'nonactive-link' }}">
                                    <span class="iconify mr-2 ml-1" data-icon="fa6-solid:gears"
                                        style="font-size: 18px;"></span>
                                    <p>
                                        Perawatan
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/data-perbaikan') }}"
                                    class="nav-link {{ Request::segment(1) == 'data-perbaikan' ? 'active-link' : 'nonactive-link' }}">
                                    <span class="iconify mr-2 ml-1" data-icon="tabler:manual-gearbox-filled"
                                        style="font-size: 20px;"></span>
                                    <p>
                                        Perbaikan
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/') }}"
                            class="nav-link {{ Request::segment(1) == 'laporan' || Request::segment(1) == 'laporan-mesin' || Request::segment(1) == 'laporan-perawatan' || Request::segment(1) == 'laporan-perbaikan' ? 'active-link' : 'nonactive-link' }}">
                            <span class="iconify mr-2" data-icon="mdi:file-document" style="font-size: 24px;"></span>
                            <p>
                                Laporan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/laporan-mesin') }}"
                                    class="nav-link {{ Request::segment(1) == 'laporan-mesin' ? 'active-link' : 'nonactive-link' }}">
                                    <span class="iconify mr-2" data-icon="gravity-ui:gear-branches"
                                        style="font-size: 20px;"></span>
                                    <p>
                                        Mesin
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/laporan-perawatan') }}"
                                    class="nav-link {{ Request::segment(1) == 'laporan-perawatan' ? 'active-link' : 'nonactive-link' }}">
                                    <span class="iconify mr-2" data-icon="fa6-solid:gears"
                                        style="font-size: 20px;"></span>
                                    <p>
                                        Perawatan
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/laporan-perbaikan') }}"
                                    class="nav-link {{ Request::segment(1) == 'laporan-perbaikan' ? 'active-link' : 'nonactive-link' }}">
                                    <span class="iconify mr-2" data-icon="tabler:manual-gearbox-filled"
                                        style="font-size: 20px;"></span>
                                    <p>
                                        Perbaikan
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
