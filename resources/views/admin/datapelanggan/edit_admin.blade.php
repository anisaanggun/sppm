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
    <title>Edit Data Pelanggan | Mesinify</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/Logo.png') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
                        <h4>Edit Data Pelanggan</h4>
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
                                        <form action="{{ route('pelanggan_admin.update', $data_pelanggans2->id) }}"
                                            method="POST" enctype="multipart/form-data" class="needs-validation"
                                            novalidate>
                                            @method('PUT')
                                            <div class="container mt-2">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Nama</label>
                                                        <input type="text" class="form-control" name="nama"
                                                            value="{{ old('nama', $data_pelanggans2->nama) }}"
                                                            placeholder="Masukkan nama pelanggan" required>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">No Hp</label>
                                                        <input type="text" class="form-control" name="no_hp"
                                                            value="{{ old('no_hp', $data_pelanggans2->no_hp) }}"
                                                            placeholder="Masukkan no hp" required>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Alamat</label>
                                                        <input type="text" class="form-control" name="alamat"
                                                            value="{{ old('alamat', $data_pelanggans2->alamat) }}"
                                                            placeholder="Masukkan alamat" required>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Email</label>
                                                        <input type="text" class="form-control" name="email"
                                                            value="{{ old('email', $data_pelanggans2->email) }}"
                                                            placeholder="Masukkan email" required>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Teknisi</label>
                                                        <select class="form-control" id="user_id" name="user_id"
                                                            required>
                                                            <option value="" disabled>Pilih Teknisi
                                                            </option>
                                                            @foreach ($teknisis as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ old('user_id', isset($data_pelanggans2) ? $data_pelanggans2->user_id : null) == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right mt-3 mb-3">
                                                <button type="submit" class="btn btn-md btn-success">Edit</button>
                                                <a href="{{ route('pelanggan_admin.index') }}"
                                                    class="btn btn-md btn-danger">Batal</a>
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
