@extends('admin.layouts.admin')

@section('content')
<div class="card shadow-lg rounded card p-2">
    <div class="card-header">
        <span class="fs-4 fw-700"><b>Data Produk</b></span>
        <a href="{{ route('produk.create') }}" class="btn btn-primary float-end">Tambah Data</a>

        {{-- <button type="button" class="btn btn-sm btn-primary float-end mx-1" data-bs-toggle="modal"
            data-bs-target="#backDropModal">
            Set stok <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-plus-lg" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
            </svg>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="backDropModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Stok Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('riwayatProduk.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label">Nama Produk</label>
                                    <select name="produk_id"
                                        class="form-select @error('produk_id') is-invalid @enderror">
                                        @foreach ($produks as $produk)
                                        <option value="" hidden>Pilih Nama Produk</option>
                                        <option value="{{ $produk->id }}">{{ $produk->nama_produk }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('produk_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-0">
                                    <label class="form-label">type</label>
                                    <select name="type" class="form-select">
                                        <option value="" hidden>Pilih Type</option>
                                        <option value="masuk">masuk</option>
                                        <option value="keluar">keluar</option>
                                    </select>
                                </div>
                                <div class="col mb-0">
                                    <label class="form-label">qty</label>
                                    <input type="number" name="qty" class="form-control mb-2" placeholder="qty">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label">Note</label>
                                    <textarea name="note" cols="30" rows="3"
                                        class="form-control mb-2  @error('note') is-invalid @enderror"
                                        placeholder="note" value="{{ old('note') }}"></textarea>
                                    @error('note')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Kembali
                            </button>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}

    </div>
    <div class="table-responsive text-nowrap">
        <div class="container">
            <table class="table table-hover table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Kategori</th>
                        <th>Sub Kategori</th>
                        <th>Nama produk</th>
                        <th>Hpp</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Diskon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-1">
                    @if (count($produks))
                    @foreach ($produks as $produk)
                    <tr>
                        <td>
                            <div class="d-flex">
                                {{ $loop->iteration }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $produk->subKategori->kategori->name }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $produk->subKategori->name }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $produk->nama_produk }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                Rp. {{ number_format($produk->hpp, 0, ',', '.') }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                Rp. {{ number_format($produk->harga, 0, ',', '.') }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $produk->stok }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $produk->diskon }}%
                            </div>
                        </td>
                        <td>
                            <form id="deleted{{ $produk->id }}" action="{{ route('produk.destroy', $produk->id) }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                @method('delete')
                                <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-sm btn-warning"
                                    data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                    data-bs-html="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                    </svg>
                                </a> |
                                <a href="{{ route('produk.show', $produk->id) }}" class="btn btn-sm btn-info"
                                    data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                    data-bs-html="true"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                        <path
                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                    </svg>
                                </a> |
                                <a href="javascript:void(0)" class="btn btn-sm btn-danger" id="btn-delete"
                                    data-id="{{ $produk->id }}" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                    data-bs-placement="top" data-bs-html="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                </a>
                            </form>
                        </td>
                    </tr>
                    @include('admin.produk.delete')
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection