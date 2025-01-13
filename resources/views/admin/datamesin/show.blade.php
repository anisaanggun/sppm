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
    <title>Detail Mesin | Mesinify</title>
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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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
                    <div class="row mt-3 " style="margin-left: 28px">
                        <h4>Informasi Mesin</h4>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row mt-3" style="margin-left: 26px; min-height: 60vh;">
                        <div class="col-md-12">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="card border-0" style="border-radius: 15px; box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1); background-color: #f8f9fa;">
                                <div class="card-header text-center" style="background-color: #297AE6; color: white; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                                    <h5 class="card-title mb-1"><strong>Detail Mesin</strong></h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-1">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-4"><strong>Nama Mesin:</strong>  {{ $data_mesin->nama_mesin }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4"><strong>Nama Brand:</strong>  {{ $data_mesin->brand->brand_name }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4"><strong>Nama Model:</strong>  {{ $data_mesin->model }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4"><strong>Deskripsi:</strong>  {{ $data_mesin->deskripsi }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <img src="{{ asset('storage/images/' . $data_mesin->image) }}" alt="Gambar Mesin" style="max-width: 70%; height: auto;">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right p-1">
                                    <a href="{{ route('data-mesin.index') }}" class="btn btn-sm btn-primary mr-2">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

</body>

</html>
