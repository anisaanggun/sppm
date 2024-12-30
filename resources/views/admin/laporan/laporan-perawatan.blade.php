@extends('layouts.main')


<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Perawatan | Mesinify</title>
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

    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mt-3 " style="margin-left: 26px">
                        <h4>Laporan Perawatan</h4>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <div class="content">
                <div class="container-fluid">
                    <div class="row ml-4 mr-4 mt-4">
                        <div class="col-md-12 form-group">
                            <div class="card border-0"
                                style="border-radius: 15px !important; box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);">
                                <div class="card-body ml-4 mr-4 mt-3">

                                    <div class="container ">
                                        <h3 style="text-align: center; margin-bottom:4%">Jumlah Perawatan Berdasarkan
                                            Tanggal</h3>
                                        <form method="GET" action="{{ route('laporan-perawatan.index') }}"
                                            class="form-inline" style="margin-bottom:2%">
                                            <div class="form-group mb-2 mr-3">
                                                <label for="bulan" class="mr-2">Bulan:</label>
                                                <select name="bulan" id="bulan" class="form-control">
                                                    @for ($i = 1; $i <= 12; $i++)
                                                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}"
                                                            {{ $i == $bulan ? 'selected' : '' }}>
                                                            {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <div class="form-group mb-2 mr-3">
                                                <label for="tahun" class="mr-2">Tahun:</label>
                                                <select name="tahun" id="tahun" class="form-control">
                                                    @for ($j = date('Y') - 5; $j <= date('Y'); $j++)
                                                        <option value="{{ $j }}"
                                                            {{ $j == $tahun ? 'selected' : '' }}>
                                                            {{ $j }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-primary mb-2">Tampilkan</button>
                                        </form>
                                    </div>

                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
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


    <script>
        const ctx = document.getElementById('myChart').getContext('2d');

        // Data untuk diagram batang
        const labels = {!! json_encode(array_keys($jumlah_perawatan_per_tanggal)) !!}; // Mengambil tanggal
        const data = {!! json_encode(array_values($jumlah_perawatan_per_tanggal)) !!}; // Mengambil jumlah perawatan

        // Debugging data
        console.log(labels);
        console.log(data);

        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Perawatan',
                    data: data,
                    backgroundColor: '#FF9B50',
                    borderColor: '#FF9B50',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            // Mengatur agar hanya menampilkan angka bulat
                            callback: function(value) {
                                return Math.floor(value); // Mengembalikan nilai sebagai bilangan bulat
                            }
                        },
                        // Mengatur batas minimum dan maksimum
                        min: 0, // Batas minimum
                        max: Math.max(...data) + 10 // Batas maksimum, sesuaikan dengan data Anda
                    }
                }
            }
        });
    </script>
</body>

</html>
