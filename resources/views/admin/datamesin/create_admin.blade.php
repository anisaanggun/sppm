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
    <title>Tambah Data Mesin | Mesinify</title>
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
                        <h4>Tambah Data Mesin</h4>
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
                                        <form action="{{ route('data-mesin.store') }}" method="POST"
                                            enctype="multipart/form-data" class="needs-validation" novalidate>
                                            <div class="container mt-2">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Brand</label>
                                                        <select class="form-control" id="brand_id" name="brand_id"
                                                            required>
                                                            <option value="" disabled selected>Pilih Brand
                                                            </option>
                                                            @foreach ($brands as $item)
                                                                <option value="{{ $item->id }}">
                                                                    {{ $item->brand_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Model</label>
                                                        <input type="text" class="form-control" name="model"
                                                            value="{{ old('model') }}"
                                                            placeholder="Masukkan nama model">
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Pelanggan</label>
                                                        <select class="form-control" id="pemilik_id" name="pemilik_id"
                                                            required>
                                                            <option value="" disabled selected>Pilih Pelanggan
                                                            </option>
                                                            @foreach ($data_pelanggans as $item)
                                                                <option value="{{ $item->id }}">
                                                                    {{ $item->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Nama Mesin</label>
                                                        <input type="text" class="form-control" name="nama_mesin"
                                                            value="{{ old('nama_mesin') }}"
                                                            placeholder="Masukkan nama mesin">
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Deskripsi</label>
                                                        <input type="text" class="form-control" name="deskripsi"
                                                            value="{{ old('deskripsi') }}"
                                                            placeholder="Masukkan deskripsi">
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Upload Gambar Mesin</label>
                                                        <input type="file" class="form-control" name="image"
                                                            placeholder="Masukan gambar mesin">
                                                    </div>
                                                    {{-- <div class="col-md-6 form-group mt-3">
                                                        <label for="brand">Brand</label>
                                                        <select class="form-control" id="brand" name="brand"
                                                            required>
                                                            <option value="">Pilih Brand Mesin</option>
                                                            <option value="Mitsubishi">Mitsubishi</option>
                                                            <option value="LG">LG</option>
                                                            <option value="Honeywell">Honeywell</option>
                                                            <option value="Lainnya">Lainnya</option>
                                                        </select>
                                                    </div> --}}
                                                    {{-- <div class="col-md-6 form-group mt-3">
                                                        <label for="model">Model</label>
                                                        <select class="form-control" id="model" name="model"
                                                            required>
                                                            <option value="">Pilih Model Mesin</option>
                                                            <option value="AC Split">AC Split</option>
                                                            <option value="AC Floor Standing">AC Floor Standing</option>
                                                            <option value="AC Window">AC Window</option>
                                                            <option value="Lainnya">Lainnya</option>
                                                        </select>
                                                    </div> --}}
                                                    {{-- <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Nama Mesin</label>
                                                        @foreach ($nama_mesin as $value => $label)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="nama_mesin" value="{{ $value }}"
                                                                    id="nama_mesin{{ $value }}">
                                                                <label class="form-check-label"
                                                                    for="nama_mesin{{ $value }}">
                                                                    {{ $label }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div> --}}
                                                    <div class="text-right mt-3 mb-3">
                                                        <button type="submit"
                                                            class="btn btn-md btn-success">Buat</button>
                                                        <a href="{{ route('data-mesin.index') }}"
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
