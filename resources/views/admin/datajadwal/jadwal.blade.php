@extends('layouts.main')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jadwal | Mesinify</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/Logo.png') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('/lte/plugins/fontawesome-free/css/all.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/lte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/style.css') }}">
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    {{-- <style>
        .fc-dot {
            background-color: blue !important;
            border-radius: 50% !important;
            width: 10px !important;
            height: 10px !important;
        }
    </style> --}}
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        {{-- Navbar --}}
        @include('admin/header')

        {{-- Sidebar --}}
        @include('admin/sidebar')

        {{-- Content --}}
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row ml-4 mr-4">
                        {{-- <div class="col-md-12 mt-3">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (isset($error))
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                            @endif

                        </div> --}}

                        <div class="col-md-12">
                            <div class="card border-0 mt-2 mb-4"
                                style="border-radius: 15px !important; box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);">
                                <div class="card-body">
                                    <h5>Kalender</h5>

                                    <!-- Tombol untuk membuka modal -->
                                    <button type="button" class="btn btn-success mt-3" data-toggle="modal"
                                        data-target="#filterModal">
                                        Filter Jadwal
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog"
                                        aria-labelledby="filterModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="filterModalLabel">Filter Jadwal</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                    <form method="GET" action="{{ route('jadwal.index') }}">
                                                        <div class="form-group mb-3">
                                                            <label for="mesin_id" class="d-block"
                                                                style="text-align:left">Pilih Mesin</label>
                                                            <select name="mesin_id" id="mesin_id" class="form-control">
                                                                <option value="">Semua Mesin</option>
                                                                @foreach ($data_mesins as $mesin)
                                                                    <option value="{{ $mesin->id }}"
                                                                        {{ isset($mesin_id) && $mesin_id == $mesin->id ? 'selected' : '' }}>
                                                                        {{ $mesin->nama_mesin }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="tgl_mulai" class="d-block"
                                                                style="text-align:left">Tanggal
                                                                Mulai</label>
                                                            <input type="date" name="tgl_mulai" id="tgl_mulai"
                                                                class="form-control" value="{{ $tgl_mulai }}">
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="tgl_selesai" class="d-block"
                                                                style="text-align:left">Tanggal
                                                                Selesai</label>
                                                            <input type="date" name="tgl_selesai" id="tgl_selesai"
                                                                class="form-control" value="{{ $tgl_selesai }}">
                                                        </div>

                                                        <!-- Apply Filter Button -->
                                                        <button type="submit" class="btn btn-primary btn-block mt-3"
                                                            id="applyFilter">Terapkan Filter</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal untuk menampilkan detail acara -->
                                    <div class="modal fade" id="perawatanModal" tabindex="-1" role="dialog" aria-labelledby="perawatanModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="perawatanModalLabel"><b>Detail Perawatan</b></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" style="text-align: left;">
                                                    <h5 id="perawatanTitle"></h5>
                                                    <p id="perawatanDescription"></p>
                                                    <p><strong>Nama Pelanggan:</strong> <span id="nama_pelanggan"></span></p>
                                                    <p><strong>Tanggal:</strong> <span id="tanggal_perawatan"></span></p>
                                                    <p><strong>Aktivitas:</strong> <span id="aktivitas_perawatan"></span></p>
                                                    <p><strong>Status:</strong> <span id="status"></span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="perbaikanModal" tabindex="-1" role="dialog" aria-labelledby="perbaikanModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="perbaikanModalLabel"><b>Detail Perbaikan</b></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" style="text-align: left;">
                                                    <h5 id="perbaikanTitle"></h5>
                                                    <p id="perbaikanDescription"></p>
                                                    <p><strong>Nama Pelanggan:</strong> <span id="nama_pelanggan_perbaikan"></span></p>
                                                    <p><strong>Tanggal:</strong> <span id="tanggal_perbaikan"></span></p>
                                                    <p><strong>Kerusakan:</strong> <span id="kerusakan_perbaikan"></span></p>
                                                    <p><strong>Status:</strong> <span id="status_perbaikan"></span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="calendar"></div>
                                </div>
                            </div>
                            {{-- <div class="card border-0 mt-2"
                                style="border-radius: 15px !important; box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);">
                                <div class="card-body">
                                    <h5>Buat Jadwal</h5>
                                    <div class="row">
                                        <div class="col-md-5 form-group mt-2 text-center">
                                            <div class="d-inline-block" style="margin-left: -20px;">
                                                <img src="{{ asset('/img/ok.png') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group mt-3">
                                            <div>
                                                <b>
                                                    <h5 class="text-center">BUAT JADWAL <br> SERVIS ANDA!</h5>
                                                </b>
                                            </div>
                                            <div class="mt-4 text-center">
                                                <li class="dropdown">
                                                    <a class="nav-links dropdown-toggle mr-lg-2 btn btn-success btn-md mb-3"
                                                        href="#" id="alertsDropdown" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false"
                                                        style="color: #FFFFFF; border-radius: 25px;">
                                                        Tambah Data
                                                    </a>
                                                    <div class="dropdown-menu mr-5 mt-3"
                                                        aria-labelledby="alertsDropdown"
                                                        style="border-radius: 10px; border:0;">
                                                        <a class="dropdown-item"
                                                            href="{{ route('data-perawatan.create') }}">
                                                            <span class="text-primary">
                                                                <strong>
                                                                    <i class="fas fa-plus"></i> Data Perawatan
                                                                </strong>
                                                            </span>
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('data-perbaikan.create') }}">
                                                            <span class="text-primary">
                                                                <strong>
                                                                    <i class="fas fa-plus"></i> Data Perbaikan
                                                                </strong>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </li>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        {{-- Footer --}}
        @include('admin/footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <script src="{{ asset('/lte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/lte/dist/js/adminlte.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>


    <script>
        var calendar;

        document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
            navLinks: true, // Enable link for opening events
            editable: true,
            events: @json($events),

            eventClick: function(info) {
                // console.log(info);

            var eventObj = info.event;
            console.log(eventObj._def.extendedProps.status['class'])

            // Ambil deskripsi dari eventObj
            // var description = eventObj._def.extendedProps.description;
            // var nama_pelanggan = eventObj._def.extendedProps.nama_pelanggan;
            // var aktivitas_perawatan = eventObj._def.extendedProps.aktivitas_perawatan;
            // var status = eventObj._def.extendedProps.status;


            // Update modal dengan informasi acara
        if (eventObj._def.extendedProps.jenis === 'perawatan') {
            document.getElementById('perawatanTitle').innerText = eventObj.title;
            // document.getElementById('eventDescription').innerText = eventObj._def.extendedProps.description;
            document.getElementById('nama_pelanggan').innerText = eventObj._def.extendedProps.nama_pelanggan;
            document.getElementById('tanggal_perawatan').innerText = eventObj._def.extendedProps.created_at;
            document.getElementById('aktivitas_perawatan').innerText = eventObj._def.extendedProps.aktivitas;
            document.getElementById('status').innerHTML = `<span class="badge ${eventObj._def.extendedProps.status['class']} ">${eventObj._def.extendedProps.status['text']}</span>`
            // eventObj._def.extendedProps.status;

            // Tampilkan modal
            $('#perawatanModal').modal('show');

        } else if (eventObj._def.extendedProps.jenis === 'perbaikan') {
            document.getElementById('perbaikanTitle').innerText = eventObj.title;
            // document.getElementById('eventDescription').innerText = eventObj._def.extendedProps.description;
            document.getElementById('nama_pelanggan_perbaikan').innerText = eventObj._def.extendedProps.nama_pelanggan;
            document.getElementById('tanggal_perbaikan').innerText = eventObj._def.extendedProps.created_at;
            document.getElementById('kerusakan_perbaikan').innerText = eventObj._def.extendedProps.kerusakan;
            document.getElementById('status_perbaikan').innerHTML = `<span class="badge ${eventObj._def.extendedProps.status['class']} ">${eventObj._def.extendedProps.status['text']}</span>`
            // eventObj._def.extendedProps.status;

            // Tampilkan modal
            $('#perbaikanModal').modal('show');
        }
        }
    });

    // Render the calendar
    calendar.render();
});



        // Event listener untuk tombol 'Terapkan Filter'
        document.getElementById('applyFilter').addEventListener('click', function() {
            // Ambil nilai dari input di modal filter
            var mesin_id = document.getElementById('mesin_id').value;
            var tgl_mulai = document.getElementById('tgl_mulai').value;
            var tgl_selesai = document.getElementById('tgl_selesai').value;

            // Ubah URL dengan filter baru
            var newUrl = '{{ route('jadwal.index') }}' + '?mesin_id=' + mesin_id +
                '&tgl_mulai=' + tgl_mulai +
                '&tgl_selesai=' + tgl_selesai;

            // Panggil fungsi untuk memperbarui kalender
            window.history.pushState({
                path: newUrl
            }, '', newUrl);
            calendar.refetchEvents(); // Memperbarui kalender dengan filter baru

            // Tutup modal setelah filter diterapkan
            $('#filterModal').modal('hide');
        });
    </script>
</body>

</html>
