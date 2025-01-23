    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


    <!-- Main Sidebar Container -->
    <aside class="main-sidebar" id="sidebar">
        <!-- Brand Logo -->
        <a href="#" class="brand-link mb-2 mt-3">
            <div class="row">
                <div class="col-md-3">
                    <img src="{{ asset('/img/logo4.png') }}" alt="">
                </div>
                <div class="col-md-9" id="sidebar-text">
                    <img src="{{ asset('/img/teks.png') }}" alt="">
                </div>
            </div>
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
                        <a href="{{ url('/beranda') }}"
                            class="nav-link {{ Request::segment(1) == 'beranda' ? 'active-link' : 'nonactive-link' }}">
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
                            class="nav-link {{ in_array(Request::segment(1), ['data', 'brand', 'teknisi', 'pelanggan', 'pelanggan_admin', 'data-mesin', 'data-mesin_admin', 'data-perawatan', 'data-perawatan_admin', 'data-perbaikan', 'data-perbaikan_admin']) ? 'active-link' : 'nonactive-link' }}">
                            <span class="iconify mr-2" data-icon="mdi:database" style="font-size: 24px;"></span>
                            <p>
                                Data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            @if (Auth::check() && Auth::user()->role_id == 2)
                                <li class="nav-item">
                                    <a href="{{ url('/brand') }}"
                                        class="nav-link {{ Request::segment(1) == 'brand' ? 'active-link' : 'nonactive-link' }}">
                                        <span class="iconify mr-2 ml-1" data-icon="mdi:flash"
                                            style="font-size: 20px;"></span>
                                        <p>
                                            Brand
                                        </p>
                                    </a>
                                </li>
                            @elseif(Auth::check() && Auth::user()->role_id == 1)
                                {{-- Admin --}}
                                {{-- Tidak menampilkan item brand untuk Admin --}}
                            @endif
                            @if (Auth::check() && Auth::user()->role_id == 2)
                                <li class="nav-item">
                                    <a href="{{ url('/teknisi') }}"
                                        class="nav-link {{ Request::segment(1) == 'teknisi' ? 'active-link' : 'nonactive-link' }}">
                                        <span class="iconify mr-2 ml-1" data-icon="mdi:wrench"
                                            style="font-size: 20px;"></span>
                                        <p>
                                            Teknisi
                                        </p>
                                    </a>
                                </li>
                            @elseif(Auth::check() && Auth::user()->role_id == 1)
                                {{-- Admin --}}
                                {{-- Tidak menampilkan item brand untuk Admin --}}
                            @endif
                            <li class="nav-item">
                                <a href="{{ url('/pelanggan') }}"
                                    class="nav-link {{ (Request::segment(1) == 'pelanggan' || Request::segment(1) == 'pelanggan_admin') && (Auth::user()->role_id == 2 || Auth::user()->role_id == 1) ? 'active-link' : 'nonactive-link' }}">
                                    <span class="iconify mr-2 ml-1" data-icon="flowbite:users-group-solid"
                                        style="font-size: 20px;"></span>
                                    <p>
                                        Pelanggan
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('/data-mesin') }}"
                                    class="nav-link {{ (Request::segment(1) == 'data-mesin' || Request::segment(1) == 'data-mesin_admin') && (Auth::user()->role_id == 2 || Auth::user()->role_id == 1) ? 'active-link' : 'nonactive-link' }}">
                                    <span class="iconify mr-2 ml-1" data-icon="gravity-ui:gear-branches"
                                        style="font-size: 20px;"></span>
                                    <p>
                                        Mesin
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/data-perawatan') }}"
                                    class="nav-link {{ (Request::segment(1) == 'data-perawatan' || Request::segment(1) == 'data-perawatan_admin') && (Auth::user()->role_id == 2 || Auth::user()->role_id == 1) ? 'active-link' : 'nonactive-link' }}">
                                    <span class="iconify mr-2 ml-1" data-icon="fa6-solid:gears"
                                        style="font-size: 18px;"></span>
                                    <p>
                                        Perawatan
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/data-perbaikan') }}"
                                    class="nav-link {{ (Request::segment(1) == 'data-perbaikan' || Request::segment(1) == 'data-perbaikan_admin') && (Auth::user()->role_id == 2 || Auth::user()->role_id == 1) ? 'active-link' : 'nonactive-link' }}">
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

    <script>
        $(document).ready(function() {
            // Event untuk toggle sidebar
            $('#sidebar-text').on('click', function() {
                // Menambah/menghapus kelas 'closed' pada sidebar
                $('#sidebar').toggleClass('closed');
            });
        });
    </script>
