@extends('admin.layouts.admin')

@section('content')
<div class="card shadow-lg rounded card p-2 pb-3">
    <div class="card-header" id="#atas">
        <span class="fs-4 fw-700"><b>Data Review</b></span>
        {{-- <a href="{{ route('reviewProduk.create') }}" class="btn btn-sm btn-primary float-end"><svg
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
                        <th>Nama Pembeli</th>
                        <th>Nama Produk</th>
                        <th>Rating</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-1">
                    @if (count($reviewProduks))
                    @foreach ($reviewProduks as $reviewProduk)
                    <tr>
                        <td>
                            <div class="d-flex">
                                {{ $loop->iteration }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $reviewProduk->user->name }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $reviewProduk->detailTransaksi->keranjang->produk->nama_produk }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $reviewProduk->rating }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $reviewProduk->created_at->format('Y-m-d') }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $reviewProduk->created_at->format('h:i:s A') }}
                            </div>
                        </td>
                        <td>
                            <form action="{{ route('reviewProduk.destroy', $reviewProduk->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalCenter{{ $reviewProduk->id }}"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="modalCenter{{ $reviewProduk->id }}" tabindex="-1"
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