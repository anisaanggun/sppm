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
    <title>Edit Data Perbaikan | Mesinify</title>
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
    <!-- Font Iconify Icons -->
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
                        <h4>Edit Data Perbaikan</h4>
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
                                        <form action="{{ route('data-perbaikan_admin.update', $data_perbaikans->id) }}"
                                            method="POST" enctype="multipart/form-data" class="needs-validation"
                                            novalidate>
                                            @method('PUT')
                                            <div class="container mt-2">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Pelanggan</label>
                                                        <select class="form-control" id="pemilik_id" name="pemilik_id"
                                                            required>
                                                            <option value="" disabled selected>Pilih Pelanggan
                                                            </option>
                                                            @foreach ($data_pelanggans as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ old('pemilik_id', $data_perbaikans->pemilik_id) == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Tanggal</label>
                                                        <form>
                                                            <input type="date" class="form-control" name="tanggal"
                                                                value="{{ old('tanggal', $data_perbaikans->tanggal) }}"
                                                                required>
                                                        </form>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Kerusakan</label>
                                                        <input type="text" class="form-control" name="kerusakan"
                                                            value="{{ old('kerusakan', $data_perbaikans->kerusakan) }}"
                                                            placeholder="Masukan kerusakan" required>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Nama Mesin</label>
                                                        <select class="form-control" id="mesin_id" name="mesin_id"
                                                            required>
                                                            <option value="" disabled>Pilih Mesin</option>
                                                            @foreach ($data_mesins as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ old('mesin_id', $data_perbaikans->mesin_id) == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->nama_mesin }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Status Perbaikan</label>
                                                        <select class="form-control" id="status_perbaikan"
                                                            name="status_perbaikan" required>
                                                            <option value="" disabled>Pilih Status</option>
                                                            <option value="3"
                                                                {{ old('status_perbaikan', $data_perbaikans->status_perbaikan) == 3 ? 'selected' : '' }}>
                                                                Menunggu Konfirmasi</option>
                                                            <option value="2"
                                                                {{ old('status_perbaikan', $data_perbaikans->status_perbaikan) == 2 ? 'selected' : '' }}>
                                                                Sedang Diproses</option>
                                                            <option value="1"
                                                                {{ old('status_perbaikan', $data_perbaikans->status_perbaikan) == 1 ? 'selected' : '' }}>
                                                                Selesai</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Teknisi</label>
                                                        <select class="form-control" id="user_id" name="user_id"
                                                            required>
                                                            <option value="" disabled>Pilih Teknisi
                                                            </option>
                                                            @foreach ($teknisis as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ old('user_id', isset($data_perbaikans) ? $data_perbaikans->user_id : null) == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Catatan</label>
                                                        <textarea class="form-control" id="catatan" name="catatan" rows="4" placeholder="Masukan catatan mesin anda"
                                                            value="{{ old('catatan') }}">{{ old('catatan', $data_perbaikans->catatan) }}</textarea>
                                                    </div>
                                                    <div class="text-right mt-3 mb-3">
                                                        <button type="submit"
                                                            class="btn btn-md btn-success">Edit</button>
                                                        <a href="{{ route('data-perbaikan_admin.index') }}"
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
