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

    <style>
        .fc-dot {
            background-color: blue !important;
            border-radius: 50% !important;
            width: 10px !important;
            height: 10px !important;
        }
    </style>
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
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="filterModalLabel">Filter Jadwal</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="GET" action="{{ route('jadwal.index') }}">
                                                        <div class="form-group">
                                                            <label for="mesin_id">Pilih Mesin:</label>
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

                                                        <div class="form-group">
                                                            <label for="tgl_mulai">Tanggal Mulai:</label>
                                                            <input type="date" name="tgl_mulai" id="tgl_mulai"
                                                                class="form-control" value="{{ $tgl_mulai }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="tgl_selesai">Tanggal Selesai:</label>
                                                            <input type="date" name="tgl_selesai" id="tgl_selesai"
                                                                class="form-control" value="{{ $tgl_selesai }}">
                                                        </div>



                                                        <button type="submit" class="btn btn-primary"
                                                            id="applyFilter">Terapkan
                                                            Filter</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="calendar"></div>

                                </div>
                            </div>
                            <div class="card border-0 mt-2"
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
                            </div>
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

            calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                navLinks: true, // Enable link for opening events
                editable: true,
                events: @json($events)
                // events: function(fetchInfo, successCallback, failureCallback) {
                //     // Ambil filter dari input di modal
                //     var mesin_id = document.getElementById('mesin_id').value;
                //     var tgl_mulai = document.getElementById('tgl_mulai').value;
                //     var tgl_selesai = document.getElementById('tgl_selesai').value;

                //     // Siapkan URL dengan query parameters untuk filter
                //     var url = '{{ route('jadwal.events') }}' + '?mesin_id=' + mesin_id +
                //         '&tgl_mulai=' + tgl_mulai + '&tgl_selesai=' + tgl_selesai;

                //     // Ambil data jadwal dari server
                //     fetch(url)
                //         .then(response => response.json())
                //         .then(data => {
                //             // console.log(data, 'data_jadwal')
                //             var events = data.map(jadwal => {
                //                 // Periksa apakah tanggal ada
                //                 var startDate = jadwal.start ? moment(jadwal.start).format(
                //                     'YYYY-MM-DDTHH:mm:ss') : null;
                //                 var endDate = jadwal.start ? moment(jadwal.start).format(
                //                     'YYYY-MM-DDTHH:mm:ss') : null;

                //                 return {
                //                     title: 'Jadwal untuk Mesin ' + jadwal.title,
                //                     start: startDate,
                //                     end: endDate,
                //                     extendedProps: {
                //                         description: 'Pemilik: ' + jadwal.extendedProps
                //                             .description
                //                     },
                //                     className: 'dot-event'
                //                 };
                //             });

                //             successCallback(events); // Kirim events yang sudah diformat
                //         })
                //         .catch(error => {
                //             failureCallback(error); // Tangani jika ada error
                //         });
                // },

                // eventClassNames: function(event) {
                //     // Periksa apakah class 'dot-event' ada dalam array classNames
                //     if (event.classNames.includes('dot-event')) {
                //         return [
                //             'fc-dot'
                //         ]; // Kelas 'fc-dot' akan ditambahkan untuk acara yang diberi 'dot-event'
                //     }
                //     return [];
                // }

                // eventClassNames: function(event) {
                //     return event.extendedProps.className ? ['fc-dot'] : [];
                // }

                // eventClassNames: function(event) {
                //     return event.classNames.includes('dot-event') ? ['fc-dot'] : [];
                // }

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
