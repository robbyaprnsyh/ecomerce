@extends('admin.layouts.admin')

@section('content')
    <div class="card shadow-lg rounded card p-2 mb-3">
        <div class="card-header" id="#atas">
            <span class="fs-4 fw-700">Detail Pembelian Produk
                {{ $detailTransaksis[0]->transaksi->kode_transaksi }}</span>
        </div>
        <div class="table-responsive text-nowrap">
            <div class="container">
                <table class="table mb-3">
                    <tbody>
                        <tr>
                            <td>
                                <strong>Nama Lengkap</strong>
                            </td>
                            <td>{{ $alamats->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Nama Produk</strong>
                            </td>
                            <td>{{ $alamats->no_telepon }}</td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Provinsi</strong>
                            </td>
                            <td>{{ $alamats->provinsi->provinsi }}</td>
                        </tr>
                        <tr>
                            <td>
                                <strong>kota/kabupaten</strong>
                            </td>
                            <td>{{ $alamats->kota->kota }}</td>
                        </tr>
                        <tr>
                            <td>
                                <strong>kecamatan</strong>
                            </td>
                            <td>{{ $alamats->kecamatan->kecamatan }}</td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Alamat Lengkap</strong>
                            </td>
                            <td>{{ $alamats->alamat_lengkap }}</td>
                        </tr>
                        @if (!$alamats->detail_lainnya == '')
                            <tr>
                                <td>
                                    <strong>Detail lainnya</strong>
                                </td>
                                <td>{{ $alamats->detail_lainnya }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td>
                                <strong>Label Alamat</strong>
                            </td>
                            <td>{{ $alamats->label_alamat }}</td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-hover table-bordered mb-3">
                    <thead>
                        <tr>
                            <th>NO</th>
                            {{-- <th>Kode Transaksi</th> --}}
                            {{-- <th>Pembeli</th> --}}
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Status</th>
                            {{-- <th>Metode Pembayaran</th> --}}
                            {{-- <th>Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-1">
                        @if (count($detailTransaksis))
                            @foreach ($detailTransaksis as $detailTransaksi)
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            {{ $loop->iteration }}
                                        </div>
                                    </td>
                                    {{-- <td>
                                        <div class="d-flex">
                                            {{ $detailTransaksi->transaksi->kode_transaksi }}
                                        </div>
                                    </td> --}}
                                    {{-- <td>
                                        <div class="d-flex">
                                            {{ $detailTransaksi->transaksi->user->name }}
                                        </div>
                                    </td> --}}
                                    <td>
                                        <div class="d-flex">
                                            {{ $detailTransaksi->keranjang->produk->nama_produk }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            {{ $detailTransaksi->keranjang->jumlah }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            Rp. {{ number_format($detailTransaksi->keranjang->total_harga, 0, ',', '.') }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            @if ($detailTransaksi->status == 'sukses')
                                                <div class="badge rounded-pill bg-success w-100">
                                                    {{ $detailTransaksi->status }}
                                                </div>
                                            @elseif ($detailTransaksi->status == 'proses')
                                                <div class="badge rounded-pill bg-warning w-100">
                                                    {{ $detailTransaksi->status }}
                                                </div>
                                            @elseif ($detailTransaksi->status == 'dikembalikan')
                                                <div class="badge rounded-pill bg-danger w-100">
                                                    {{ $detailTransaksi->status }}
                                                </div>
                                            @elseif ($detailTransaksi->status == 'pengajuan refund')
                                                <div class="badge rounded-pill bg-secondary w-100">
                                                    {{ $detailTransaksi->status }}
                                                </div>
                                            @elseif ($detailTransaksi->status == 'ditolak')
                                                <div class="badge rounded-pill bg-primary w-100">
                                                    {{ $detailTransaksi->status }}
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot class="table-border-bottom-0">
                        <tr>
                            <th colspan="4">Total</th>
                            <th>Rp. {{ number_format($total_harga, 0, ',', '.') }}</th>
                        </tr>
                        @if (!$transaksis->voucher == '')
                            <tr>
                                <th colspan="4">voucher</th>
                                <th>({{ $transaksis->voucher->diskon }}% ) / Rp. {{ number_format($diskon, 0, ',', '.') }}
                                </th>
                            </tr>
                            <tr>
                                <th colspan="4">Total Harga</th>
                                <th>Rp. {{ number_format($total_bayar, 0, ',', '.') }}</th>
                            </tr>
                        @endif
                        <tr>
                            <th colspan="4">Metode Pembayaran</th>
                            <th>{{ $detailTransaksis[0]->transaksi->metodePembayaran->metodePembayaran }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="d-flex">
        <a href="{{ url('/admin/transaksi') }}" class="btn btn-danger me-3"><svg xmlns="http://www.w3.org/2000/svg"
                width="20" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z" />
            </svg> Kembali</a>
    </div>
@endsection
