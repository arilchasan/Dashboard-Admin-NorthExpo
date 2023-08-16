<!DOCTYPE html>
<html>
<head>
    <title>Laporan Bulanan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center" >Laporan Bulan {{ $namaBulan }} {{ $namaTempat }}</h1>
    <table >
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Tiket</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($success as $item)
            <tr>
                <td>{{ $item->order_id }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->no_telp }}</td>
                <td>{{ $item->qty }} Tiket</td>   
                <td>Rp{{number_format($item->total,0, ',' , '.')  }}</td>
            </tr>
            @empty
            <tr>
                <td colspan='5'>
                    <div style="text-align: center;">
                        Tidak Ada Data
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
        <tr>
            <th colspan="3" style="text-align: center">Total Keseluruhan</th>
            <th>{{ $totalTiket }} Tiket</th>
            <th>Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</th>
        </tr>
        </tfoot>
    </table>
    <div class="footer">
        Copyright by NorthExpo Kudus - Developed by 4ranger
    </div>
</body>
</html>
