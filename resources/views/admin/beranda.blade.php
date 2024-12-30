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
    <title>Beranda | Mesinify</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/img/Logo.png') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('/lte/plugins/fontawesome-free/css/all.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/lte/dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/style.css') }}">
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                <div class="container-fluid" style="display: block; margin: 0 auto;">
                    <div style="margin-left:30px; margin-right:30px;">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <img src="{{ asset('/img/gambar1.png') }}" alt="" class="img-fluid"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row ml-4 mr-4">
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                            <!-- small box -->
                            <div class="small-box">
                                <div class="inner">
                                    <div class="lingkaran">
                                        <span class="iconify" data-icon="gravity-ui:gear-branches"></span>
                                    </div>
                                    <h5><b>Tambah Mesin</b></h5>
                                    <p>Tambahkan mesin baru Anda disini</p>
                                </div>
                                <a href="{{ route('data-mesin.index') }}" class="small-box-footer text-center">
                                    <span>Tambah</span>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                            <!-- small box -->
                            <div class="small-box">
                                <div class="inner">
                                    <div class="lingkaran">
                                        <span class="iconify" data-icon="fa6-solid:gears"></span>
                                    </div>
                                    <h5><b>Catatan Perawatan</b></h5>
                                    <p>Catat perawatan mesin Anda disini</p>
                                </div>
                                <a href="{{ route('data-perawatan.index') }}" class="small-box-footer">Catat</a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                            <!-- small box -->
                            <div class="small-box">
                                <div class="inner">
                                    <div class="lingkaran">
                                        <span class="iconify" data-icon="tabler:manual-gearbox-filled"></span>
                                    </div>
                                    <h5><b>Catatan Perbaikan</b></h5>
                                    <p>Catat perbaikan mesin Anda disini</p>
                                </div>
                                <a href="{{ route('data-perbaikan.index') }}" class="small-box-footer">Catat</a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                            <!-- small box -->
                            <div class="small-box">
                                <div class="inner">
                                    <div class="lingkaran">
                                        <span class="iconify" data-icon="gravity-ui:qr-code"></span>
                                    </div>
                                    <h5><b>Pindai QR-Code</b></h5>
                                    <p>Pindai QR Code mesin Anda disini</p>
                                </div>
                                <a href="#" class="small-box-footer">Pindai</a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-md-6 form-group">
                            <div class="card border-0"
                                style="border-radius: 15px !important; box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);">
                                <div class="card-body">
                                    <div class="container ">
                                        <h5 style="text-align: center; margin-bottom:4%">Jumlah Perawatan Berdasarkan
                                            Tanggal</h5>
                                        <form method="GET" action="{{ route('beranda.index') }}" class="form-inline"
                                            style="margin-bottom:2%">
                                            <div class="form-group mb-2 mr-3">
                                                <label for="bulan_perawatan" class="mr-2">Bulan:</label>
                                                <select name="bulan_perawatan" id="bulan_perawatan"
                                                    class="form-control">
                                                    @for ($i = 1; $i <= 12; $i++)
                                                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}"
                                                            {{ $i == $bulan_perawatan ? 'selected' : '' }}>
                                                            {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <div class="form-group mb-2 mr-3">
                                                <label for="tahun_perawatan" class="mr-2">Tahun:</label>
                                                <select name="tahun_perawatan" id="tahun_perawatan"
                                                    class="form-control">
                                                    @for ($j = date('Y') - 5; $j <= date('Y'); $j++)
                                                        <option value="{{ $j }}"
                                                            {{ $j == $tahun_perawatan ? 'selected' : '' }}>
                                                            {{ $j }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-primary mb-2">Lihat</button>
                                        </form>
                                    </div>
                                    <canvas id="myChart1" width="300" height="250"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 form-group ">
                            <div class="card border-0 "
                                style="border-radius: 15px !important; box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);">
                                <div class="card-body">
                                    <div class="container">
                                        <h5 style="text-align: center; margin-bottom:4%">Jumlah Perbaikan Berdasarkan
                                            Tanggal</h5>
                                        <form method="GET" action="{{ route('beranda.index') }}"
                                            class="form-inline" style="margin-bottom:2%">
                                            <div class="form-group mb-2 mr-3">
                                                <label for="bulan_perbaikan" class="mr-2">Bulan:</label>
                                                <select name="bulan_perbaikan" id="bulan_perbaikan"
                                                    class="form-control">
                                                    @for ($i = 1; $i <= 12; $i++)
                                                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}"
                                                            {{ $i == $bulan_perbaikan ? 'selected' : '' }}>
                                                            {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <div class="form-group mb-2 mr-3">
                                                <label for="tahun_perbaikan" class="mr-2">Tahun:</label>
                                                <select name="tahun_perbaikan" id="tahun_perbaikan"
                                                    class="form-control">
                                                    @for ($j = date('Y') - 5; $j <= date('Y'); $j++)
                                                        <option value="{{ $j }}"
                                                            {{ $j == $tahun_perbaikan ? 'selected' : '' }}>
                                                            {{ $j }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-primary mb-2">Lihat</button>
                                        </form>
                                    </div>
                                    <canvas id="myChart2" width="300" height="250"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
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


    <script>
        const ctx1 = document.getElementById('myChart1').getContext('2d');
        const ctx2 = document.getElementById('myChart2').getContext('2d');

        // Data untuk grafik pertama
        const labels1 = {!! json_encode(array_keys($jumlah_perawatan_per_tanggal)) !!}; // Mengambil tanggal
        const data1 = {!! json_encode(array_values($jumlah_perawatan_per_tanggal)) !!}; // Mengambil jumlah perawatan

        // Debugging data untuk grafik pertama
        console.log(labels1);
        console.log(data1);

        const myChart1 = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: labels1,
                datasets: [{
                    label: 'Jumlah Perawatan',
                    data: data1,
                    backgroundColor: '#FF9B50',
                    borderColor: '#FF9B50',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            // Mengatur agar hanya menampilkan angka bulat
                            callback: function(value) {
                                return Math.floor(value); // Mengembalikan nilai sebagai bilangan bulat
                            }
                        },
                        // Mengatur batas minimum dan maksimum
                        min: 0, // Batas minimum
                        max: Math.max(...data1) + 10 // Batas maksimum, sesuaikan dengan data Anda
                    }
                }
            }
        });

        // Data untuk grafik kedua
        const labels2 = {!! json_encode(array_keys($jumlah_perbaikan_per_tanggal)) !!}; // Mengambil tanggal
        const data2 = {!! json_encode(array_values($jumlah_perbaikan_per_tanggal)) !!}; // Mengambil jumlah perbaikan

        // Debugging data untuk grafik kedua
        console.log(labels2);
        console.log(data2);

        const myChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: labels2,
                datasets: [{
                    label: 'Jumlah Perbaikan',
                    data: data2,
                    backgroundColor: '#FF9B50',
                    borderColor: '#FF9B50',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            // Mengatur agar hanya menampilkan angka bulat
                            callback: function(value) {
                                return Math.floor(value); // Mengembalikan nilai sebagai bilangan bulat
                            }
                        },
                        // Mengatur batas minimum dan maksimum
                        min: 0, // Batas minimum
                        max: Math.max(...data2) + 10 // Batas maksimum, sesuaikan dengan data Anda
                    }
                }
            }
        });
    </script>
</body>


</html>
