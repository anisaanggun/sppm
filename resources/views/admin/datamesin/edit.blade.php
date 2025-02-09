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
    <title>Edit Data Mesin | Mesinify</title>
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
                        <h4>Edit Data Mesin</h4>
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
                                    <div class="alert alert-danger d-flex justify-content-between">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="card border-0"
                                    style="border-radius: 15px !important; box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);">
                                    <div class="card-body">
                                        <form action="{{ route('data-mesin.update', $data_mesins->id) }}" method="POST"
                                            enctype="multipart/form-data" class="needs-validation" novalidate>
                                            @method('PUT')
                                            <div class="container mt-2">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Brand</label>
                                                        <select class="form-control" id="brand_id" name="brand_id"
                                                            required>
                                                            <option value="" disabled>Pilih Brand</option>
                                                            @foreach ($brands as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ old('brand_id', $data_mesins->brand_id) == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->brand_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Model</label>
                                                        <input type="text" class="form-control" name="model"
                                                            value="{{ old('model', $data_mesins->model) }}"
                                                            placeholder="Masukkan nama model" required>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Pelanggan</label>
                                                        <select class="form-control" id="pemilik_id" name="pemilik_id"
                                                            required>
                                                            <option value="" disabled>Pilih Pelanggan
                                                            </option>
                                                            @foreach ($data_pelanggans as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ old('pemilik_id', $data_mesins->pemilik_id) == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Nama Mesin</label>
                                                        <input type="text" class="form-control" name="nama_mesin"
                                                            value="{{ old('nama_mesin', $data_mesins->nama_mesin) }}"
                                                            placeholder="Masukkan nama mesin" required>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Deskripsi</label>
                                                        <input type="text" class="form-control" name="deskripsi"
                                                            value="{{ old('deskripsi', $data_mesins->deskripsi) }}"
                                                            placeholder="Masukkan deskripsi" required>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Upload Gambar Mesin</label>
                                                        @if ($data_mesins->image)
                                                            <img src="{{ asset('storage/images/' . $data_mesins->image) }}"
                                                                alt="Gambar Mesin" style="width: 100px; height: auto;">
                                                        @else
                                                            <p>Tidak ada gambar</p>
                                                        @endif
                                                        <input type="file" class="form-control mt-2" name="image"
                                                            id="imageInput" accept="image/*">
                                                    </div>
                                                    <div class="text-right mt-3 mb-3">
                                                        <button type="submit"
                                                            class="btn btn-md btn-success">Edit</button>
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
