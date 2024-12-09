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
    <title>LaporanPerawatan | Pantau Mesin</title>
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
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
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
</body>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['1', '2', '3', '4', '5', '6'],
        datasets: [{
          label: 'Laporan Perawatan',
          data: [34, 19, 20, 10, 32, 5],
          backgroundColor: [
            'rgba(255, 255, 0, 0.2)',
            'rgba(255, 255, 0, 0.2)',
            'rgba(255, 255, 0, 0.2)',
            'rgba(255, 255, 0, 0.2)',
            'rgba(255, 255, 0, 0.2)',
            'rgba(255, 255, 0, 0.2)'
          ],
          borderColor: [
            'rgba(255, 255, 0, 0.2)',
            'rgba(255, 255, 0, 0.2)',
            'rgba(255, 255, 0, 0.2)',
            'rgba(255, 255, 0, 0.2)',
            'rgba(255, 255, 0, 0.2)',
            'rgba(255, 255, 0, 0.2)'
          ],
          borderWidth: 1,
          barThickness: 50
        }]
      },
      options: {
        responsive:true,
        maintainAspectRatio:false,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
</html>
