@extends('layouts.main')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Mesin | Mesinify</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/Logo.png') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('/lte/plugins/fontawesome-free/css/all.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/lte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js">
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
                        <h4>Laporan Mesin</h4>
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
                                    <h3 style="text-align: center; margin-bottom:4%">Jumlah Mesin Berdasarkan
                                        Brand</h3>
                                    <canvas id="myChart" width="400" height="200"></canvas>
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
        const labels = {!! json_encode(array_keys($jumlah_mesin_per_brand)) !!}; // Mengambil nama brand
        const data = {!! json_encode(array_values($jumlah_mesin_per_brand)) !!}; // Mengambil jumlah mesin per brand

        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Mesin',
                    data: data,
                    backgroundColor: '#FF9B50',
                    borderColor: '#FF9B50',
                    borderWidth: 1
                }]
            },
            options: {
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
