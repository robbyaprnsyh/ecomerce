<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Type</th>
            <th>Jumlah</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($riwayatProduks as $riwayatProduk)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $riwayatProduk->produk->nama_produk }}</td>
            <td>{{ $riwayatProduk->type }}</td>
            <td>{{ $riwayatProduk->qty }}</td>
            <td>{{ $riwayatProduk->created_at->format('Y-m-d') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>