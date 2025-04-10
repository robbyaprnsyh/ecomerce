@extends('admin.layouts.admin')

@section('content')
<div class="card shadow-lg rounded card p-2">
    <div class="card-header" id="#atas">
        <span class="fs-4 fw-700"><b>Data Pembelian Produk</b></span>
        {{-- <a href="{{ route('transaksi.create') }}" class="btn btn-sm btn-primary float-end"><svg
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
                        <th>Pembeli</th>
                        <th>Jumlah Produk</th>
                        <th>Voucher</th>
                        <th>Metode Pembayaran</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-1">
                    @if (count($transaksis))
                    @foreach ($transaksis as $transaksi)
                    <tr>
                        <td>
                            <div class="d-flex">
                                {{ $loop->iteration }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $transaksi->kode_transaksi }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $transaksi->user->name }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $transaksi->detailTransaksi->count() }}
                            </div>
                        </td>
                        <td>
                            @if ($transaksi->voucher == '')
                            <div class="d-flex">
                                0%
                            </div>
                            @else
                            <div class="d-flex">
                                {{ $transaksi->voucher->diskon }}%
                            </div>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $transaksi->metodePembayaran->metodePembayaran }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                Rp. {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                            </div>
                        </td>
                        <td>
                            <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <a href="{{ route('transaksi.show', $transaksi->id) }}" class="btn btn-sm btn-info"
                                    data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                    data-bs-html="true"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                        <path
                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                    </svg>
                                </a> |
                                @if ($transaksi->status == 'proses')
                                <a href="javascript:void(0)" class="btn btn-sm btn-danger" id="btn-notif"
                                    data-id="{{ $transaksi->id }}" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                    data-bs-placement="top" data-bs-html="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                </a>
                                @else
                                <a href="javascript:void(0)" class="btn btn-sm btn-danger" id="btn-delete"
                                    data-id="{{ $transaksi->id }}" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                    data-bs-placement="top" data-bs-html="true" title="<span>Hapus Data</span>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                </a>
                                @endif
                            </form>
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