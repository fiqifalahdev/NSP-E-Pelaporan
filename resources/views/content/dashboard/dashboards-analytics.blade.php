@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
    @vite('resources/assets/vendor/libs/apex-charts/apex-charts.scss')
@endsection

@section('vendor-script')
    @vite('resources/assets/vendor/libs/apex-charts/apexcharts.js')
@endsection

@section('page-script')
    @vite('resources/assets/js/dashboards-analytics.js')
@endsection

@section('content')
    <div class="row gy-6">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Grafik Risiko per Lokasi</h5>
                </div>
                <div class="card-body">
                    <div id="chart-hiradc"></div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Grafik Hasil Toolbox Meeting</h5>
                </div>
                <div class="card-body">
                    <div id="chartToolboxMeeting"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row gy-6 mt-3">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Grafik Temuan Per Lokasi</h5>
                </div>
                <div class="card-body">
                    <div id="chartTemuanLokasi"></div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Grafik Temuan Per Kondisi</h5>
                </div>
                <div class="card-body">
                    <div id="chartTemuanKondisi"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                series: {!! $series !!},
                xaxis: {
                    categories: {!! $categories !!}
                },
                fill: {
                    opacity: 1
                },
                legend: {
                    position: 'top'
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart-hiradc"), options);
            chart.render();

            const dataLokasi = @json(json_decode($temuanPerLokasi));
            const lokasiLabels = dataLokasi.map(item => item.lokasi);
            const lokasiData = dataLokasi.map(item => item.jumlah_temuan);

            var options1 = {
                chart: {
                    type: 'bar',
                    height: 300
                },
                series: [{
                    name: 'Jumlah Temuan',
                    data: lokasiData
                }],
                xaxis: {
                    categories: lokasiLabels
                },
                colors: ['#90EE90'], // ungu
                title: {
                    text: 'Jumlah Temuan per Lokasi'
                }
            };

            var chart1 = new ApexCharts(document.querySelector("#chartTemuanLokasi"), options1);
            chart1.render();

            const dataKondisi = @json(json_decode($temuanPerKategori));
            const kondisiLabels = dataKondisi.map(item => item.temuan);
            const kondisiData = dataKondisi.map(item => item.jumlah_temuan);

            var options2 = {
                chart: {
                    type: 'bar',
                    height: 300
                },
                series: [{
                    name: 'Jumlah Temuan',
                    data: kondisiData
                }],
                xaxis: {
                    categories: kondisiLabels
                },
                colors: ['#FFD700'],
                title: {
                    text: 'Jumlah Temuan per Kondisi'
                }
            };

            var chart2 = new ApexCharts(document.querySelector("#chartTemuanKondisi"), options2);
            chart2.render();

            const toolboxData = @json(json_decode($toolboxStatusSummary));
            const toolboxLabels = toolboxData.map(item => item.status);
            const toolboxValues = toolboxData.map(item => item.jumlah);

            var options = {
                chart: {
                    type: 'pie',
                    height: 360
                },
                series: toolboxValues,
                labels: toolboxLabels,
                colors: ['#ffb6c1', '#90ee90'], // pink & light green
                legend: {
                    position: 'top'
                },
                title: {
                    text: 'Status Toolbox Meeting'
                }
            };

            var chart = new ApexCharts(document.querySelector("#chartToolboxMeeting"), options);
            chart.render();
        });
    </script>
@endsection
