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
    <link rel="shortcut icon" type="image/x-icon" href="/img/Logo.png">

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
                    <div class="row ">
                        <div class="col">
                            <img src="/img/gambar1.png" alt="" class="img-fluid">
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
                                    <h5><b>Tambah Mesin Baru</b></h5>
                                    <p>Tambahkan mesin baru Anda disini</p>
                                </div>
                                <a href="/data-mesin" class="small-box-footer text-center">
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
                                <a href="/data-perawatan" class="small-box-footer">Catat</a>
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
                                <a href="/data-perbaikan" class="small-box-footer">Catat</a>
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

</html>
