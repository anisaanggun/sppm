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
    <title>Edit Data Perawatan | Pantau Mesin</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/Logo.png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="/assets/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="/assets/style.css">

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
                        <h4>Data Perawatan</h4>
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
                                    style="border-radius: 15px !important; box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);">
                                    <div class="card-body">
                                        <form action="{{ route('data-perawatan.update', $data_perawatans->id) }}"
                                            method="POST" enctype="multipart/form-data" class="needs-validation"
                                            novalidate>
                                            @method('PUT')
                                            <div class="container mt-2">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Pemilik</label>
                                                        <input type="text" class="form-control" name="pemilik"
                                                            value="{{ old('pemilik', $data_perawatans->pemilik) }}"
                                                            placeholder="Masukan nama pemilik" required>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Tanggal</label>
                                                        <input type="date" class="form-control"
                                                            name="tanggal_perawatan"
                                                            value="{{ old('tanggal_perawatan', $data_perawatans->tanggal_perawatan) }}"
                                                            placeholder="Masukan tanggal perawatan" required>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Teknisi</label>
                                                        <input type="text" class="form-control" name="teknisi"
                                                            value="{{ old('teknisi', $data_perawatans->teknisi) }}"
                                                            placeholder="Masukan nama teknisi" required>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Aktivitas</label>
                                                        <input type="text" class="form-control" name="aktivitas"
                                                            value="{{ old('aktivitas', $data_perawatans->aktivitas) }}"
                                                            placeholder="Masukan aktivitas" required>
                                                    </div>

                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Nama Mesin</label>
                                                        <select class="form-control" id="mesin_id" name="mesin_id"
                                                            required>
                                                            <option value="" disabled selected>Pilih Mesin
                                                            </option>
                                                            @foreach ($data_mesins as $item)
                                                                <option value="{{ $item->id }}">
                                                                    {{ $item->nama_mesin }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Catatan</label>
                                                        <textarea class="form-control" id="catatan" name="catatan" rows="4" value="{{ old('catatan') }}"
                                                            placeholder="Masukan catatan mesin anda" required>
                                                            {{ old('catatan', $data_perawatans->catatan) }}
                                                        </textarea>
                                                    </div>
                                                    <div class="text-right mt-3 mb-3">
                                                        <button type="submit"
                                                            class="btn btn-md btn-success">Edit</button>
                                                        <a href="/data-perawatan"
                                                            class="btn btn-md btn-danger">Batal</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
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
    <script src="/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/assets/dist/js/adminlte.min.js"></script>

    <script src="/assets/https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/assets/https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="/assets/cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>

</html>
