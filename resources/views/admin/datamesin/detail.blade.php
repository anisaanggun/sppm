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
                        {{-- <h4>Informasi Mesin</h4> --}}
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row mt-3 ml-4 mr-4">
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
                            <div class="card border-0 shadow-lg rounded-4 overflow-hidden"
                                style="background-color: #ffffff; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);">
                                <div class="card-header text-center"
                                    style="background-color: #297AE6; color: #ffffff; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                                    <h5 class="card-title mb-0 font-weight-bold">Detail Mesin</h5>
                                </div>

                                <div class="card-body">
                                    <div class="row justify-content-between ml-2">
                                        <!-- Detail Mesin -->
                                        <div class="col-md-7 mt-2">
                                            {{-- <h3 class="text-primary font-weight-bold mb-4">Informasi Mesin</h3> --}}

                                            <div class="row mb-4">
                                                <div class="col-md-4"><strong>Nama Mesin</strong></div>
                                                <div class="col-md-8"><span
                                                        class="text-muted">{{ $data_mesin->nama_mesin }}</span></div>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-md-4"><strong>Nama Brand</strong></div>
                                                <div class="col-md-8"><span
                                                        class="text-muted">{{ $data_mesin->brand->brand_name }}</span>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-md-4"><strong>Nama Model</strong></div>
                                                <div class="col-md-8"><span
                                                        class="text-muted">{{ $data_mesin->model }}</span></div>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-md-4"><strong>Deskripsi</strong></div>
                                                <div class="col-md-8"><span
                                                        class="text-muted">{{ $data_mesin->deskripsi ?: 'Tidak ada deskripsi' }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Gambar Mesin -->
                                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                                            <div class="image-container">
                                                <img src="{{ asset('storage/images/' . $data_mesin->image) }}"
                                                    alt="Gambar Mesin"
                                                    class="img-fluid rounded-3 shadow-lg hover-effect"
                                                    style="max-height: 300px; object-fit: cover;">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tombol Kembali -->
                                    <div class="text-right mt-4">
                                        <a href="{{ route('data-mesin.index') }}"
                                            class="btn btn-primary btn-sm px-4 py-2 rounded-pill shadow-sm hover-shadow">Kembali</a>
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
