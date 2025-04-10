@extends('admin.layouts.admin')

@section('content')
<form action="{{ route('supplier.store') }}" method="POST">
    @csrf
    <div class="col-lg-12">
        <div class="card mb-4 shadow-lg rounded card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><b>Data Supplier</b></h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Name Produk</label>
                    <select name="produk_id" class="form-select @error('produk_id') is-invalid @enderror">
                        @foreach ($produks as $produk)
                        <option value="" hidden>Pilih produk</option>
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
                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="jumlah"
                        class="form-control numbers mb-2  @error('jumlah') is-invalid @enderror" placeholder="Jumlah"
                        value="{{ old('jumlah') }}">
                    @error('jumlah')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="d-flex float-start">
            <a href="/admin/supplier" class="btn btn-danger me-2"> Kembali</a>
            <button type="submit" class="btn btn-primary">
                <span class="indicator-label">Simpan</span>
            </button>
        </div>
    </div>
</form>
@endsection