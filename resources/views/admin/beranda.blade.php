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
    <title>Beranda | Pantau Mesin</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/img/Logo.png') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
                <div class="container-fluid" style="display: block; margin: 0 auto;">
                    <div class="row">
                        <div class="col mb-2">
                            <img src="{{ asset('/img/gambar1.png') }}" alt="" class="img-fluid"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row ml-4 mr-4">
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                            <!-- small box -->
                            <div class="small-box">
                                <div class="inner">
                                    <div class="lingkaran">
                                        <span class="iconify" data-icon="gravity-ui:gear-branches"></span>
                                    </div>
                                    <h5><b>Tambah Mesin</b></h5>
                                    <p>Tambahkan mesin baru Anda disini</p>
                                </div>
                                <a href="{{ route('data-mesin.index') }}" class="small-box-footer text-center">
                                    <span>Tambah</span>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                            <!-- small box -->
                            <div class="small-box">
                                <div class="inner">
                                    <div class="lingkaran">
                                        <span class="iconify" data-icon="fa6-solid:gears"></span>
                                    </div>
                                    <h5><b>Catatan Perawatan</b></h5>
                                    <p>Catat perawatan mesin Anda disini</p>
                                </div>
                                <a href="{{ route('data-perawatan.index') }}" class="small-box-footer">Catat</a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                            <!-- small box -->
                            <div class="small-box">
                                <div class="inner">
                                    <div class="lingkaran">
                                        <span class="iconify" data-icon="tabler:manual-gearbox-filled"></span>
                                    </div>
                                    <h5><b>Catatan Perbaikan</b></h5>
                                    <p>Catat perbaikan mesin Anda disini</p>
                                </div>
                                <a href="{{ route('data-perbaikan.index') }}" class="small-box-footer">Catat</a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                            <!-- small box -->
                            <div class="small-box">
                                <div class="inner">
                                    <div class="lingkaran">
                                        <span class="iconify" data-icon="gravity-ui:qr-code"></span>
                                    </div>
                                    <h5><b>Pindai QR-Code</b></h5>
                                    <p>Pindai QR Code mesin Anda disini</p>
                                </div>
                                <a href="#" class="small-box-footer">Pindai</a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-md-6 form-group">
                            <div class="card border-0"
                                style="border-radius: 15px !important; box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);">
                                <div class="card-body">
                                    <canvas id="myChart1" width="300" height="250"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 form-group ">
                            <div class="card border-0 "
                                style="border-radius: 15px !important; box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);">
                                <div class="card-body">
                                    <canvas id="myChart2" width="300" height="250"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
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
</body>

<script>
    var ctx1 = document.getElementById('myChart1').getContext('2d');
    var ctx2 = document.getElementById('myChart2').getContext('2d');

    // Data untuk grafik pertama
    var myChart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['1', '2', '3', '4', '5', '6'],
            datasets: [{
                label: 'Laporan Perawatan',
                data: [30, 10, 21, 15, 35, 5],
                backgroundColor: '#FF9B50',
                borderColor: '#FF9B50',
                borderWidth: 1,
                fill: true // Mengisi area di bawah garis
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Data untuk grafik kedua
    var myChart2 = new Chart(ctx2, {
        type: 'bar', // Tipe grafik kedua, bisa diubah sesuai kebutuhan
        data: {
            labels: ['1', '2', '3', '4', '5', '6'],
            datasets: [{
                label: 'Laporan Perbaikan',
                data: [15, 25, 10, 30, 20, 5],
                backgroundColor: '#FF9B50',
                borderColor: '#FF9B50',
                borderWidth: 1,
                fill: true // Mengisi area di bawah garis
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</html>
