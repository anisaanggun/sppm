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
                        <h4>Detail Mesin</h4>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="container mt-3 mb-3">
                        <div class="row ml-3 mr-3">
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
                                <div class="card border-0"
                                    style="border-radius: 15px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
                                    <div class="card-header text-center"
                                        style="background-color: #FF9B50; color: white; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                                        <h5 class="card-title"><strong>Informasi Mesin</strong></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <p class="card-text">
                                                <strong>Nama Mesin:</strong>
                                                <span class="badge badge-info">{{ $data_mesin->nama_mesin }}</span>
                                            </p>
                                        </div>
                                        <div class="mb-3">
                                            <p class="card-text">
                                                <strong>Nama Brand:</strong>
                                                <span
                                                    class="badge badge-info">{{ $data_mesin->brand->brand_name }}</span>
                                            </p>
                                        </div>
                                        <div class="mb-3">
                                            <p class="card-text">
                                                <strong>Nama Model:</strong>
                                                <span class="badge badge-info">{{ $data_mesin->model }}</span>
                                            </p>
                                        </div>
                                        <div class="mb-3">
                                            <p class="card-text">
                                                <strong>ID Mesin:</strong>
                                                <span class="badge badge-info">{{ $data_mesin->id }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="{{ route('data-mesin.index') }}" class="btn btn-primary">Kembali</a>
                                    </div>
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
