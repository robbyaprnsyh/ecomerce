@extends('admin.layouts.admin')

@section('content')
<div class="card shadow-lg rounded card p-2">
    <div class="card-header" id="#atas">
        <span class="fs-4 fw-700"><b>Data Pengajuan Refund</b></span>
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
                        <th>Aksi</th>
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
                        {{-- <td>
                            <form action="{{ route('refundProduk.destroy', $refundProduk->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalCenter{{ $refundProduk->id }}"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="modalCenter{{ $refundProduk->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalCenterTitle">Apakah Anda
                                                    Yakin?
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Kembali
                                                </button>
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td> --}}
                        <td>
                            <a href="{{ route('refundProduk.edit', $refundProduk->id) }}"
                                class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                data-bs-placement="top" data-bs-html="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                </svg>
                            </a>
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