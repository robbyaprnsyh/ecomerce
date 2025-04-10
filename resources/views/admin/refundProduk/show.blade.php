@extends('admin.layouts.admin')

@section('content')
    {{-- <div class="container-fluid">
        <div class="col-lg-8">
            <div class="card mb-4 shadow-lg rounded card" style="margin: 2%; padding:1% ">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Data review_produk</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">kode_transaksi</label>
                        <input type="text" name="kode_transaksi"
                            class="form-control mb-2  @error('kode_transaksi') is-invalid @enderror"
                            value="{{ $refund_produks->transaksi->kode_transaksi }}" disabled readonly>
                        @error('kode_transaksi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">nama_pembeli</label>
                        <input type="text" name="nama_pembeli"
                            class="form-control mb-2  @error('nama_pembeli') is-invalid @enderror"
                            value="{{ $refund_produks->transaksi->keranjang->user->name }}" disabled readonly>
                        @error('nama_pembeli')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">nama_produk</label>
                        <input type="text" name="nama_produk"
                            class="form-control mb-2  @error('nama_produk') is-invalid @enderror"
                            value="{{ $refund_produks->transaksi->keranjang->produk->nama_produk }}" disabled readonly>
                        @error('nama_produk')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="required form-label">Alasan Refund</label>
                        <textarea name="komen" cols="30" rows="7" class="form-control mb-2  @error('komen') is-invalid @enderror"
                            disabled readonly>{{ $refund_produks->alasan }}</textarea>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ url('/admin/refund_produk') }}" class="btn btn-danger me-3"><svg
                        xmlns="http://www.w3.org/2000/svg" width="20" fill="currentColor"
                        class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z" />
                    </svg> Kembali</a>
            </div>
        </div>
    </div> --}}

    <div class="container-fluid">
        <div class="col-md">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4 my-3 ms-3">
                        <img class="d-block w-100"
                            src="{{ asset($refund_produks->transaksi->keranjang->produk->gambar_produk1) }}" alt="gambar" />
                    </div>
                    <div class="col-md-7">
                        <div class="card-header">
                            <h5> {{ $refund_produks->transaksi->kode_transaksi }} </h5>
                        </div>
                        <div class="card-body m-auto">
                            <p class="card-text">
                                {{ $refund_produks->alasan }}
                            </p>
                        </div>
                        <div class="card-footer">
                            <figure class="float-end">
                                <blockquote class="blockquote">
                                    <p>{{ $refund_produks->transaksi->keranjang->produk->nama_produk }}</p>
                                </blockquote>
                                <figcaption class="blockquote-footer mb-0 text-muted">
                                    <cite
                                        title="Source Title">{{ $refund_produks->transaksi->keranjang->user->name }}</cite>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ url('/admin/refund_produk') }}" class="btn btn-danger me-3"><svg
                        xmlns="http://www.w3.org/2000/svg" width="20" fill="currentColor"
                        class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z" />
                    </svg> Kembali</a>
            </div>
        </div>
    </div>
@endsection
