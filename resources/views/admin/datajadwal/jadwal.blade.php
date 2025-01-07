@extends('layouts.main')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jadwal | Pantau Mesin</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>

    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="http://momentjs.com/downloads/moment.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        {{-- Navbar --}}
        @include('admin/header')

        {{-- Sidebar --}}
        @include('admin/sidebar')

        {{-- Content --}}


        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            {{-- <div class="content-header">
                <div class="container-fluid">
                    <div class="row mt-3 " style="margin-left: 26px">
                        <h4>Data Mesin</h4>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div> --}}
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    {{-- <div class="mt-2" style="margin-left: 40px">
                        <a href="{{ route('jadwal.create') }}" class="btn btn-md mb-3"
                            style="background-color: #FF9B50; color: #FFFFFF; border-radius: 25px;">Tambah Data</a>
                    </div> --}}
                    <div class="row ml-4 mr-4">
                        <div class="col-md-12 mt-3">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-md-12">
                            <div class="card border-0 mt-2 mb-4"
                                style="border-radius: 15px !important; box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);">
                                <div class="card-body">
                                    <h5>Kalender</h5>

                                    <!-- Dropdown Filter Pilih Mesin -->

                                    <div class="col-md-6 form-group mt-3">
                                        <label class="font-weight-bold">Pilih Mesin</label>
                                        <select class="form-control" id="mesin_id" name="mesin_id" required>
                                            <option value="" disabled selected>Pilih Mesin</option>
                                            @foreach ($data_mesins as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_mesin }}</option>
                                            @endforeach
                                        </select>

                                        <label class="font-weight-bold mt-2">Pilih Tanggal</label>
                                        <input type="date" class="form-control" id="event_date" required>

                                        <label class="font-weight-bold mt-2">Jenis Jasa</label>
                                        <select class="form-control" id="service_type" required>
                                            <option value="" disabled selected>Pilih Jenis Jasa</option>
                                            <option value="maintenance">Perawatan</option>
                                            <option value="repair">Perbaikan</option>
                                        </select>

                                        <button type="button" class="btn btn-primary mb-2 mt-2" id="tampilkanBtn">Tampilkan</button>
                                    </div>
                                    <div id='calendar'></div>
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
                                                    <h5 class="text-center">BUAT JADWAL <br> SERVIS ANDA!</h>
                                                </b>
                                            </div>
                                            <div class="mt-4 text-center">
                                                <li class="dropdown">
                                                    <a class="nav-links dropdown-toggle mr-lg-2 btn btn-success btn-md mb-3"
                                                        href="#" id="alertsDropdown" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false"
                                                        style=" color: #FFFFFF; border-radius: 25px;">
                                                        Tambah Data
                                                    </a>
                                                    <!-- start dropdown -->
                                                    <div class="dropdown-menu mr-5 mt-3"
                                                        aria-labelledby="alertsDropdown"
                                                        style="border-radius: 10px; border:0;">
                                                        <a class="dropdown-item"
                                                            href="{{ route('data-perawatan.create') }}"
                                                            id="data_perawatan">
                                                            <span class="text-primary">
                                                                <strong>
                                                                    <i class="fas fa-plus"></i>
                                                                    Data Perawatan</strong>
                                                            </span>
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('data-perbaikan.create') }}"
                                                            id="data_perawatan">
                                                            <span class="text-primary">
                                                                <strong>
                                                                    <i class="fas fa-plus"></i>
                                                                    Data Perbaikan</strong>
                                                            </span>
                                                        </a>
                                                    </div><!-- end dropdown -->
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


    <!-- jQuery -->
    <script src="{{ asset('/lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/lte/dist/js/adminlte.min.js') }}"></script>

    <script src="/https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="/cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function confirmDelete(form) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Jika pengguna mengkonfirmasi, kirim form
                }
            });
        }
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: '', // No buttons on the left
                center: 'title', // Title in the center
                right: 'dayGridMonth,timeGridWeek,timeGridDay' // View buttons on the right
            },
            navLinks: true,
            editable: true,
            eventClick: function(info) {
                alert('Event: ' + info.event.title + '\nDescription: ' + info.event.extendedProps.description);
            }
        });

        // Render the calendar
        calendar.render();

        // Event listener for the "Tampilkan" button
        document.getElementById('tampilkanBtn').addEventListener('click', function() {
            var mesinSelect = document.getElementById('mesin_id');
            var mesinId = mesinSelect.value; // Get the selected machine ID
            var eventDate = document.getElementById('event_date').value; // Get the selected date
            var serviceType = document.getElementById('service_type').value; // Get the selected service type

            // Check if a machine, date, and service type are selected
            if (mesinId && eventDate && serviceType) {
                // Get the machine name
                var mesinName = mesinSelect.options[mesinSelect.selectedIndex].text; // Get the machine name

                // Create the event title based on the service type
                var eventTitle = (serviceType === 'maintenance') ? 'Perawatan Mesin: ' + mesinName : 'Perbaikan Mesin: ' + mesinName;

                // Add an event to the calendar
                calendar.addEvent({
                    title: eventTitle, // Event title
                    start: eventDate, // Use the selected date
                    allDay: true, // Set to true for all-day events
                    extendedProps: {
                        description: 'Jasa: ' + (serviceType === 'maintenance' ? 'Perawatan' : 'Perbaikan') + ' untuk ' + mesinName // Optional description
                    }
                });

                // Optionally, you can send an AJAX request to store the event in the database
                /*
                $.ajax({
                    url: '/events', // Your endpoint to store events
                    method: 'POST',
                    data: {
                        title: eventTitle,
                        start: eventDate,
                        _token: '{{ csrf_token() }}' // Include CSRF token
                    },
                    success: function(response) {
                        console.log('Event saved:', response);
                    }
                });
                */

                alert('Event untuk ' + mesinName + ' pada tanggal ' + eventDate + ' dengan jenis jasa ' + (serviceType === 'maintenance' ? 'Perawatan' : 'Perbaikan') + ' telah ditambahkan ke kalender.');
            } else {
                alert('Silahkan pilih mesin, tanggal, dan jenis jasa terlebih dahulu.');
            }
        });
    });
</script>

<script>
    document.getElementById('tampilkanBtn').addEventListener('click', function() {
        var mesinSelect = document.getElementById('mesin_id');
        var mesinId = mesinSelect.value; // Ambil ID mesin yang dipilih

        // Cari nama mesin berdasarkan ID
        var mesinName = '';
        @foreach ($data_mesins as $item)
            if (mesinId == '{{ $item->id }}') {
                mesinName = '{{ $item->nama_mesin }}';
            }
        @endforeach
    });
</script>
</body>

</html>
