@extends('admin.layouts.admin')

@section('content')
<div class="card shadow-lg rounded card p-2">
    <div class="card-header" id="#atas">
        <span class="fs-4 fw-700"><b>Data Refund Produk</b></span>
        {{-- <a href="{{ route('refundProduk.create') }}" class="btn btn-sm btn-primary float-end"><svg
                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
            </svg>Tambah Data</a> --}}
    </div>
    <div class="table-responsive text-nowrap">
        <div class="container">
            <table class="table table-hover table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Kode Transaksi</th>
                        <th>Nama Pembeli</th>
                        <th>Nama Produk</th>
                        <th>Alasan</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-1">
                    @if (count($refundProduks))
                    @foreach ($refundProduks as $refundProduk)
                    <tr>
                        <td>
                            <div class="d-flex">
                                {{ $loop->iteration }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $refundProduk->detailTransaksi->transaksi->kode_transaksi }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $refundProduk->user->name }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $refundProduk->detailTransaksi->keranjang->produk->nama_produk }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $refundProduk->alasan }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                @if ($refundProduk->status == 'disetujui')
                                <div class="badge rounded-pill bg-success w-100">
                                    {{ $refundProduk->status }}
                                </div>
                                @elseif ($refundProduk->status == 'pengajuan refund')
                                <div class="badge rounded-pill bg-warning w-100">
                                    {{ $refundProduk->status }}
                                </div>
                                @elseif ($refundProduk->status == 'ditolak')
                                <div class="badge rounded-pill bg-danger w-100">
                                    {{ $refundProduk->status }}
                                </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $refundProduk->created_at->format('Y-m-d') }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $refundProduk->created_at->format('h:i:s A') }}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection