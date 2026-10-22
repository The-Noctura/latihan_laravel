<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h2 {
            margin: 0;
            padding: 0;
            color: #1a5276;
        }

        .header p {
            margin: 5px 0 0 0;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid #bdc3c7;
        }

        th {
            background-color: #1a5276;
            color: white;
            padding: 8px;
            text-align: left;
        }

        td {
            padding: 6px;
        }

        tr:nth-child(even) {
            background-color: #f8f9f9;
        }

        .footer {
            text-align: right;
            margin-top: 30px;
            font-size: 10px;
            color:
                #7f8c8d;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>LAPORAN DATA INDUK SISWA</h2>
        <p>Sistem Informasi Administrasi Akademik Sekolah Resmi</p>
    </div>
    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 15%">NISN</th>
                <th>Nama Lengkap</th>
                <th style="width: 15%">Jenis Kelamin</th>
                <th>Alamat</th>
                <th style="width: 15%">Nomor HP</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($daftarSiswa as $siswa)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $siswa->nisn }}</td>
                    <td>{{ $siswa->nama }}</td>
                    <td>{{ $siswa->jenis_kelamin }}</td>
                    <td>{{ $siswa->alamat }}</td>
                    <td>{{ $siswa->nomor_telepon }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak otomatis melalui sistem pada: {{ date('d-m-Y H:i:s') }} WIB</p>
    </div>
</body>

</html>
