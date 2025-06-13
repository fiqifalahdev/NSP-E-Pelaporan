<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Detail Toolbox Meeting</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: left;
        }

        th,
        td {
            padding: 8px 10px;
            border: 1px solid #000;
            vertical-align: top;
            text-align: left;

        }

        .title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .section-title {
            font-weight: bold;
            margin: 10px 0 5px;
        }
    </style>
</head>

<body>
    <div class="title">Detail Toolbox Meeting</div>

    <table>
        <tr>
            <th>Tanggal</th>
            <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th>Penanggung Jawab</th>
            <td>{{ $data->penanggung_jawab }}</td>
        </tr>
        <tr>
            <th>Jabatan</th>
            <td>{{ $data->jabatan }}</td>
        </tr>
        <tr>
            <th>Uraian Aktivitas</th>
            <td>{{ $data->uraian_aktivitas }}</td>
        </tr>
        <tr>
            <th>Keterangan</th>
            <td>{{ $data->keterangan }}</td>
        </tr>
    </table>

    <div class="section-title">Kehadiran</div>
    <table id="kehadiran">
        <thead>
            <tr>
                <th style="width: 50px; text-align:center;">No</th>
                <th>Nama</th>
            </tr>
        </thead>
        <tbody>
            @php
                $listKehadiran = is_array($data->kehadiran)
                    ? $data->kehadiran
                    : json_decode($data->kehadiran ?? '[]', true);
            @endphp

            @forelse ($listKehadiran as $index => $nama)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ $nama }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">(Tidak ada data kehadiran)</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
