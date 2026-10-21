
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Laporan - SI PANTAU TPS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background: #f4f6f9;
            color: #222;
        }
        h1 { color: #166534; }
        .container {
            background: white;
            padding: 24px;
            border-radius: 10px;
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th { background: #166534; color: white; }
        tr:nth-child(even) { background: #f8fafc; }
        .status { font-weight: bold; }
        .empty { padding: 20px; text-align: center; }
        a {
            display: inline-block;
            background: #166534;
            color: white;
            padding: 10px 14px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>SI PANTAU TPS</h1>
        <h2>Daftar Laporan</h2>

        <a href="{{ url('/laporan/buat') }}">+ Buat Laporan</a>

        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif

        @if ($laporan->isEmpty())
            <p class="empty">Belum ada laporan yang tersedia.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kategori Masalah</th>
                        <th>Tingkat Kondisi</th>
                        <th>Tingkat Urgensi</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Waktu Lapor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($laporan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kategori_masalah }}</td>
                            <td>{{ $item->tingkat_kondisi }}</td>
                            <td>{{ $item->tingkat_urgensi }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td class="status">{{ $item->status }}</td>
                            <td>{{ $item->waktu_lapor }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
