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
    <title>Edit Data Perawatan | Mesinify</title>
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
                        <h4>Edit Data Perawatan</h4>
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
                                                        <label class="font-weight-bold">Pelanggan</label>
                                                        <select class="form-control" id="pemilik_id" name="pemilik_id"
                                                            required>
                                                            <option value="" disabled selected>Pilih Pelanggan
                                                            </option>
                                                            @foreach ($data_pelanggans as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ old('pemilik_id', $data_perawatans->pemilik_id) == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Tanggal</label>
                                                        <input type="date" class="form-control"
                                                            name="tanggal_perawatan"
                                                            value="{{ old('tanggal_perawatan', $data_perawatans->tanggal_perawatan) }}"
                                                            placeholder="Masukan tanggal perawatan" required>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Aktivitas</label>
                                                        <input type="text" class="form-control" name="aktivitas"
                                                            value="{{ old('aktivitas', $data_perawatans->aktivitas) }}"
                                                            placeholder="Masukan aktivitas" required>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Nama Mesin</label>
                                                        <select name="mesin_id" id="mesin_id"
                                                            class="form-control @error('mesin_id') is-invalid @enderror">
                                                            <option value="">Pilih Mesin</option>
                                                            <!-- Mesin yang terkait dengan pelanggan yang dipilih akan dimuat di sini -->
                                                            {{-- @foreach ($data_mesins as $mesin)
                                                                <option value="{{ $mesin->id }}"
                                                                    {{ $mesin->id == $data_perawatans->mesin_id ? 'selected' : '' }}
                                                                    class="mesin-option-{{ $mesin->pemilik_id }}">
                                                                    {{ $mesin->nama_mesin }}
                                                                </option>
                                                            @endforeach --}}
                                                        </select>
                                                        @error('mesin_id')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Status Perawatan</label>
                                                        <select class="form-control" id="status_perawatan"
                                                            name="status_perawatan" required>
                                                            <option value="" disabled>Pilih Status</option>
                                                            <option value="3"
                                                                {{ old('status_perawatan', $data_perawatans->status_perawatan) == 3 ? 'selected' : '' }}>
                                                                Menunggu Konfirmasi</option>
                                                            <option value="2"
                                                                {{ old('status_perawatan', $data_perawatans->status_perawatan) == 2 ? 'selected' : '' }}>
                                                                Sedang Diproses</option>
                                                            <option value="1"
                                                                {{ old('status_perawatan', $data_perawatans->status_perawatan) == 1 ? 'selected' : '' }}>
                                                                Selesai</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Catatan</label>
                                                        <textarea class="form-control" id="catatan" name="catatan" rows="4" placeholder="Masukan catatan mesin anda"
                                                            value="{{ old('catatan') }}">{{ old('catatan', $data_perawatans->catatan) }}</textarea>
                                                    </div>
                                                    <div class="text-right mt-3 mb-3">
                                                        <button type="submit"
                                                            class="btn btn-md btn-success">Edit</button>
                                                        <a href="{{ route('data-perawatan.index') }}"
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
        document.addEventListener('DOMContentLoaded', function() {
            let pemilikSelect = document.getElementById('pemilik_id');
            let mesinSelect = document.getElementById('mesin_id');
            let selectedMesinId = '{{ $data_perawatans->mesin_id }}'; // Ambil nilai mesin_id yang sudah ada

            // Fungsi untuk memuat mesin berdasarkan pemilik_id
            function loadMesins() {
                let selectedPemilikId = pemilikSelect.value;

                // Jika pemilik_id dipilih
                if (selectedPemilikId) {
                    // Lakukan request AJAX untuk mendapatkan data mesin berdasarkan pemilik_id
                    fetch(`/get-mesins/${selectedPemilikId}`)
                        .then(response => response.json())
                        .then(data => {
                            // Bersihkan opsi mesin yang ada
                            mesinSelect.innerHTML = '<option value="">Pilih Mesin</option>';

                            // Looping untuk menambahkan opsi mesin ke dalam select
                            data.forEach(function(mesin) {
                                let option = document.createElement('option');
                                option.value = mesin.id;
                                option.textContent = mesin.nama_mesin;

                                // Cek apakah mesin_id saat ini sama dengan id mesin di looping
                                if (mesin.id == selectedMesinId) {
                                    option.selected = true; // Set opsi yang terpilih
                                }

                                mesinSelect.appendChild(option);
                            });
                        })
                        .catch(error => {
                            console.log('Error:', error);
                        });
                }
            }

            // Load mesin berdasarkan pemilik_id yang sudah ada saat halaman dimuat pertama kali
            loadMesins();

            // Event listener untuk perubahan pada pemilik_id
            pemilikSelect.addEventListener('change', function() {
                loadMesins(); // Panggil fungsi untuk memuat mesin setelah pemilik_id dipilih
            });
        });
    </script>
</body>

</html>
