@extends('layouts.main')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LaporanMesin | Pantau Mesin</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/Logo.png') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('/lte/plugins/fontawesome-free/css/all.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/lte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js">
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
                    <div class="row mt-3 " style="margin-left: 26px">
                        <h4>Laporan Mesin</h4>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->


            <div class="content">
                <div class="container-fluid">
                    <div class="row ml-4 mr-4 mt-4">
                        <div class="col-md-12 form-group">
                            <div class="card border-0"
                                style="border-radius: 15px !important; box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);">
                                <div class="card-body ml-4 mr-4 mt-5">
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>
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

    //Data untuk setiap bulan
    var dataPerBulan = {
        'Januari': [12, 19, 3, 10, 40, 25],
        'Februari': [15, 10, 5, 20, 30, 15],
        'Maret': [20, 25, 15, 10, 5, 30],
        'April': [10, 15, 20, 25, 30, 35],
        'Mei': [5, 10, 15, 20, 25, 30],
        'Juni': [30, 25, 20, 15, 10, 5]
    };

    //inisialisasi grafik
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Mitsubishi', 'HoneyWell', 'LG Window', 'Mito', 'Samsung', 'Toshiba'],
            datasets: [{
                label: 'Laporan Mesin',
                data: dataPerBulan['Januari'], // Data awal
                backgroundColor: '#FF9B50',
                borderColor: '#FF9B50',
                borderWidth: 1,
                fill: true // Mengisi area di bawah garis

            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Fungsi untuk memperbarui grafik
    function updateChart(month) {
        myChart.data.datasets[0].data = dataPerBulan[month];
        myChart.update();
    }

    // Event listener untuk mengklik bulan
    document.addEventListener('click', function(event) {
        const monthClicked = event.target.innerText; // Ambil teks dari elemen yang diklik
        if (dataPerBulan[monthClicked]) {
            updateChart(monthClicked);
        }
    });

    // Menampilkan bulan sebagai tombol
    const months = Object.keys(dataPerBulan);
    months.forEach(month => {
        const button = document.createElement('button');
        button.innerText = month;
        button.onclick = function() {
            updateChart(month);
        };
        document.getElementById('month-buttons').appendChild(button);
    });
</script>

</html>
