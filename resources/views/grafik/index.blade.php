@extends('dashboard.layouts.main')
@section('container')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="container">
<!-- <script>
        var combinedData = @json($combinedData);
        var labels = combinedData.map(data => data.keterangan); // Ganti 'label' dengan nama kolom yang sesuai
        var values = combinedData.map(data => data.jml_penjualan); // Ganti 'value' dengan nama kolom yang sesuai

        var ctx = document.getElementById('combinedChart').getContext('2d');
        var combinedChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Penjualan',
                    data: values,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
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
    </script> -->

    <div style="display: inline-block; width: 20px; height: 20px; background-color: rgba(75, 192, 192, 0.6); margin-right: 5px;"></div>
    <span>Training</span>

    <!-- Kotak petunjuk warna untuk Prediksi -->
    <div style="display: inline-block; width: 20px; height: 20px; background-color: rgba(255, 99, 132, 0.6); margin-right: 5px;"></div>
    <span>Prediksi</span>
   
    <canvas id="combinedChart" width="400" height="200"></canvas>

    <script>
        var combinedData = @json($combinedData);
        var labels = combinedData.map(data => data.keterangan);
        var values = combinedData.map(data => data.jml_penjualan);
        var sources = combinedData.map(data => data.sumber); // Kolom sumber untuk identifikasi sumber data

        // Fungsi untuk mengatur warna berdasarkan sumber data
        function getColor(source) {
            return source === 'Training' ? 'rgba(75, 192, 192, 0.6)' : 'rgba(255, 99, 132, 0.6)';
        }

        var backgroundColors = sources.map(source => getColor(source));

        var ctx = document.getElementById('combinedChart').getContext('2d');
        var combinedChart = new Chart(ctx, {
            type: 'line', // Ganti dengan jenis grafik yang sesuai
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Penjualan',
                    data: values,
                    backgroundColor: backgroundColors, // Menggunakan warna yang sesuai berdasarkan sumber data
                    borderColor: backgroundColors, // Menggunakan warna yang sesuai berdasarkan sumber data
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
<br>

<div class="alert alert-dark" role="alert">
  <h4 class="alert-heading">Keterangan !</h4>
  <p>Grafik di atas menjelaskan warna-warna yang digunakan untuk mengidentifikasi sumber data: <br> <br>

1.<strong>Warna biru </strong>pada grafik ini melambangkan data training yang di ambil dari rentang waktu  <strong>Januari 2023-September 2023</strong> . Data training adalah data historis yang mencakup informasi penjualan dari periode sebelumnya. Warna biru ini membantu kita memvisualisasikan tren dan pola dari data yang telah terjadi sebelumnya. <br>


2.<strong>Warna merah</strong> pada grafik ini melambangkan data prediksi yang di ambil dari rentang waktu  <strong>{{date('F-Y',strtotime($dataawal))}}</strong>  sampai <strong> {{date('F-Y',strtotime($dataakir))}}</strong>. Data prediksi adalah hasil peramalan atau perkiraan penjualan untuk periode di masa depan. Warna merah ini membantu kita membedakan antara data historis (biru) dan perkiraan (merah) dalam grafik..</p>
  <hr>
  
</div>


@endSection