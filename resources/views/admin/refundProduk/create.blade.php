@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
        <form action="{{ route('refundProduk.store') }}" method="POST">
            @csrf
            < class="col-lg-12">
                <div class="card mb-4 shadow-lg rounded card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Data Refund Produk</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">User</label>
                            <select name="user_id" class="form-select @error('user_id') is-invalid @enderror">
                                @foreach ($users as $user)
                                    <option value="" hidden>Pilih User</option>
                                    <option value="{{ $user->id }}">{{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">kode transaksi</label>
                            <select name="detailTransaksi_id"
                                class="form-select @error('detailTransaksi_id') is-invalid @enderror">
                                @foreach ($detailTransaksis as $detailTransaksi)
                                    <option value="" hidden>Pilih Kode Produk</option>
                                    <option value="{{ $detailTransaksi->id }}">
                                        {{ $detailTransaksi->keranjang->produk->nama_produk }}
                                    </option>
                                @endforeach
                            </select>
                            @error('detailTransaksi_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">alasan</label>
                            <textarea name="alasan" cols="30" rows="7" class="form-control mb-2  @error('alasan') is-invalid @enderror"
                                placeholder="alasan" value="{{ old('alasan') }}"></textarea>
                            @error('alasan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex float-start">
                    <a href="/admin/refundProduk" class="btn btn-danger me-3"> Kembali</a>
                </div>
                <div class="d-flex float-end">
                    <div class="col">
                        <button type="reset" class="btn btn-secondary mx-3">
                            <span class="indicator-label"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                    fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                                    <path
                                        d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                                </svg> Reset </span>
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Kirim</span> 
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
