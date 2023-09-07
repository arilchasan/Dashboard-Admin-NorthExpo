<table>
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
            <td>{{ $item->total }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5" align="center">Tidak Ada Data</td>
        </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3">Total Keseluruhan</th>
            <th>{{ $totalTiket }} Tiket</th>
            <th>{{ $totalPendapatan }}</th>
        </tr>
    </tfoot>
</table>
