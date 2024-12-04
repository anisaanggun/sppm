@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Grafik Penjualan Produk</h1>

    <canvas id="salesChart" width="400" height="200"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($productNames) !!},
                datasets: [{
                    label: 'Penjualan',
                    data: {!! json_encode($productSales) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</div>
@endsection
