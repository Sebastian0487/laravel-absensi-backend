<!DOCTYPE html>
<html>
<head>
    <title>Laporan Absensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Laporan Absensi</h2>
    <h4>Filter: {{ ucfirst(str_replace('-', ' ', $filter)) }}</h4>
    <table>
        <thead>
            <tr>
                <th>Nama Pegawai</th>
                <th>Tanggal</th>
                <th>Waktu Masuk</th>
                <th>Waktu Keluar</th>
                <th>Latlong Masuk</th>
                <th>Latlong Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
            <tr>
                <td>{{ $attendance->user->name }}</td>
                <td>{{ $attendance->date }}</td>
                <td>{{ $attendance->time_in }}</td>
                <td>{{ $attendance->time_out }}</td>
                <td>{{ $attendance->latlon_in }}</td>
                <td>{{ $attendance->latlon_out }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
