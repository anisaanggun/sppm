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
    <title>Tambah Data Perawatan | Mesinify</title>
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
                        <h4>Tambah Data Perawatan</h4>
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
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                @if (session('message'))
                                    <div class="alert alert-danger">
                                        {{ session('message') }}
                                    </div>
                                @endif
                                <div class="card border-0"
                                    style="border-radius: 15px !important; box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);">
                                    <div class="card-body">
                                        <form action="{{ route('data-perawatan_admin.store') }}" method="POST"
                                            enctype="multipart/form-data" class="needs-validation" novalidate>
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
                                                                <option value="{{ $item->id }}">
                                                                    {{ $item->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Tanggal</label>
                                                        <form>
                                                            <input type="date" class="form-control"
                                                                name="tanggal_perawatan"
                                                                value="{{ old('tanggal_perawatan') }}">
                                                        </form>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Aktvitas</label>
                                                        <input type="text" class="form-control" name="aktivitas"
                                                            value="{{ old('aktivitas') }}"
                                                            placeholder="Masukan aktivitas">
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label for="nama_mesin">Nama Mesin</label>
                                                        <select class="form-control" id="mesin_id" name="mesin_id"
                                                            required>
                                                            <option value="" disabled selected>Pilih Mesin
                                                            </option>
                                                            {{-- @foreach ($data_mesins as $item)
                                                                <option value="{{ $item->id }}">
                                                                    {{ $item->nama_mesin }}</option>
                                                            @endforeach --}}
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Status Perawatan</label>
                                                        <select class="form-control" id="status_perawatan"
                                                            name="status_perawatan" required>
                                                            <option value="" disabled selected>Pilih Status
                                                            </option>
                                                            <option value="3">Menunggu Konfirmasi</option>
                                                            <option value="2">Sedang Diproses</option>
                                                            <option value="1">Selesai</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Teknisi</label>
                                                        <select class="form-control" id="user_id" name="user_id"
                                                            required>
                                                            <option value="" disabled selected>Pilih Teknisi
                                                            </option>
                                                            {{-- @foreach ($teknisis as $item)
                                                                <option value="{{ $item->id }}">
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endforeach --}}
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Catatan</label>
                                                        <textarea class="form-control" id="catatan" name="catatan" rows="4" placeholder="Masukan catatan mesin anda"
                                                            value="{{ old('catatan') }}"></textarea>
                                                    </div>
                                                    <div
                                                        class="text-right
                                                            mt-3 mb-3">
                                                        <button type="submit"
                                                            class="btn btn-md btn-success">Buat</button>
                                                        <a href="{{ route('data-perawatan_admin.index') }}"
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

    <script type="text/javascript">
        $(document).ready(function() {
            // Event ketika dropdown pemilik_id berubah
            $('#pemilik_id').on('change', function() {
                var pemilik_id = $(this).val(); // Ambil nilai pemilik_id yang dipilih

                if (pemilik_id) {
                    // Lakukan AJAX request ke route get-mesins dengan pemilik_id di URL
                    $.ajax({
                        url: `/get-mesins/${pemilik_id}`, // Ganti dengan URL yang sesuai
                        type: "GET",
                        success: function(data) {
                            // Kosongkan dropdown mesin_id
                            $('#mesin_id').empty();
                            // Tambahkan opsi default
                            $('#mesin_id').append(
                                '<option value="" disabled selected>Pilih Mesin</option>');

                            // Isi dropdown mesin_id dengan data yang diterima
                            $.each(data, function(key, value) {
                                $('#mesin_id').append('<option value="' + value.id +
                                    '">' + value.nama_mesin + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error("Error: " + error);
                            console.error("Response:", xhr
                                .responseText); // Lihat respons yang diterima
                            alert("Terjadi kesalahan saat mengambil data mesin.\n" + xhr
                                .responseText); // Menampilkan response error
                        }
                    });
                } else {
                    // Jika pemilik_id kosong, kosongkan dropdown mesin_id
                    $('#mesin_id').empty();
                    $('#mesin_id').append('<option value="" disabled selected>Pilih Mesin</option>');
                }
            });

            // Event ketika dropdown mesin_id berubah
            $('#mesin_id').on('change', function() {
                var mesin_id = $(this).val(); // Ambil nilai mesin_id yang dipilih

                if (mesin_id) {
                    // Lakukan AJAX request ke route get-teknisi dengan mesin_id di URL
                    $.ajax({
                        url: `/get-teknisi/${mesin_id}`,
                        type: "GET",
                        success: function(data) {
                            // Kosongkan dropdown user_id
                            $('#user_id').empty();
                            // Tambahkan opsi default
                            $('#user_id').append(
                                '<option value="" disabled>Pilih Teknisi</option>');

                            // Isi dropdown user_id dengan data yang diterima
                            if (data) {
                                $('#user_id').append('<option value="' + data.id +
                                    '" selected>' + data.name + '</option>');
                                $('#user_id').prop('disabled', true);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error: " + error);
                            alert("Terjadi kesalahan saat mengambil data teknisi.");
                        }
                    });
                } else {
                    // Jika mesin_id kosong, kosongkan dropdown user_id
                    $('#user_id').empty();
                    $('#user_id').append('<option value="" disabled selected>Pilih Teknisi</option>');
                }
            });
        });
    </script>


</body>

</html>
