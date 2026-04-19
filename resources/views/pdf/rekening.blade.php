<!DOCTYPE html>
<html>
<head>
    <title>Laporan Rekening</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

<h2>Laporan Master Rekening</h2>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Rekening</th>
            <th>Nama Rekening</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $i => $r)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $r->kode_rekening }}</td>
            <td>{{ $r->nama_rekening }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>