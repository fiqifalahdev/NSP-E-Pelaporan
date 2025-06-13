<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Data HIRADC - {{ $data['identifikasi_lokasi'] }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        th,
        td {
            padding: 8px;
            vertical-align: top;
        }

        th {
            text-align: left;
            background-color: #f2f2f2;
        }

        .section-title {
            background-color: #d3d3d3;
            font-weight: bold;
            padding: 6px;
            margin-top: 20px;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #000;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>Data Hasil HIRADC - {{ $data['identifikasi_lokasi'] }}</h2>

    <div class="section-title">Identifikasi Bahaya</div>
    <table class="table-bordered">
        <tr>
            <th>Lokasi</th>
            <td>{{ $data['identifikasi_lokasi'] }}</td>
        </tr>
        <tr>
            <th>Aktifitas</th>
            <td>{{ $data['identifikasi_aktifitas'] }}</td>
        </tr>
        <tr>
            <th>Potensi Bahaya</th>
            <td>{{ $data['identifikasi_potensi_bahaya'] }}</td>
        </tr>
        <tr>
            <th>Dampak Bahaya</th>
            <td>{{ $data['identifikasi_dampak_bahaya'] }}</td>
        </tr>
        <tr>
            <th>PIC</th>
            <td>{{ $data['identifikasi_PIC'] }}</td>
        </tr>
    </table>

    <div class="section-title">Pengendalian Yang Sudah Ada</div>
    <table class="table-bordered">
        <tr>
            <th>Uraian Kontrol</th>
            <td>{{ $data['control_uraian'] }}</td>
        </tr>
        <tr>
            <th>Poin Kemungkinan</th>
            <td>{{ $data['control_poin_kemungkinan'] }}</td>
        </tr>
        <tr>
            <th>Poin Keparahan</th>
            <td>{{ $data['control_poin_keparahan'] }}</td>
        </tr>
        <tr>
            <th>Nilai Risiko</th>
            <td>{{ $data['control_nilai_resiko'] }}</td>
        </tr>
    </table>

    <div class="section-title">Rekomendasi Pengendalian</div>
    <table class="table-bordered">
        <tr>
            <th>Uraian Rekomendasi</th>
            <td>{{ $data['recom_uraian'] }}</td>
        </tr>
        <tr>
            <th>Poin Kemungkinan</th>
            <td>{{ $data['recom_poin_kemungkinan'] }}</td>
        </tr>
        <tr>
            <th>Poin Keparahan</th>
            <td>{{ $data['recom_poin_keparahan'] }}</td>
        </tr>
        <tr>
            <th>Nilai Risiko</th>
            <td>{{ $data['recom_nilai_resiko'] }}</td>
        </tr>
    </table>
</body>

</html>
