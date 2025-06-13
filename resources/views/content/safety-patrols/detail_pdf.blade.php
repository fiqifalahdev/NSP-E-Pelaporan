<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Temuan Safety Patrol</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #000;
        }

        h2 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 8px 10px;
            border: 1px solid #000;
            vertical-align: top;
            text-align: left;
        }

        .label {
            width: 200px;
            font-weight: bold;
            background-color: #f0f0f0;
        }

        .value {
            background-color: #fff;
        }

        .temuan-img {
            max-width: 100%;
            height: auto;
            border: 1px solid #666;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <h2>Detail Temuan Safety Patrol</h2>

    <table>
        <tr>
            <td class="label">Tanggal</td>
            <td class="value">{{ \Carbon\Carbon::parse($data->tanggal)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td class="label">Kriteria</td>
            <td class="value">{{ $data->kriteria }}</td>
        </tr>
        <tr>
            <td class="label">Lokasi</td>
            <td class="value">{{ $data->lokasi }}</td>
        </tr>
        <tr>
            <td class="label">Temuan</td>
            <td class="value">{{ $data->temuan }}</td>
        </tr>
        <tr>
            <td class="label">Kesesuaian</td>
            <td class="value">{{ $data->kesesuaian }}</td>
        </tr>
        <tr>
            <td class="label">Risiko</td>
            <td class="value">{{ $data->risiko }}</td>
        </tr>
        <tr>
            <td class="label">Tindak Lanjut</td>
            <td class="value">{{ $data->tindak_lanjut }}</td>
        </tr>
        <tr>
            <td class="label">Foto Temuan</td>
            <td class="value">
                @if ($data->foto_temuan)
                    <img src="{{ public_path('storage/foto_temuan/' . $data->foto_temuan) }}" alt="Foto Temuan"
                        class="temuan-img">
                @else
                    Tidak ada foto temuan.
                @endif
            </td>
        </tr>
    </table>
</body>

</html>
