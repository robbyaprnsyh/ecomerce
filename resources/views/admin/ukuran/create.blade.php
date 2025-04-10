@extends('admin.layouts.admin')

@section('content')
<form action="{{ route('ukuran.store') }}" method="POST">
    @csrf
    <div class="col-lg-12">
        <div class="card mb-4 shadow-lg rounded card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Tambah Ukuran Produk</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Ukuran</label>
                    <input type="text" name="ukuran" class="form-control mb-2  @error('ukuran') is-invalid @enderror"
                        placeholder="Ukuran Produk" value="{{ old('ukuran') }}">
                    @error('ukuran')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="d-flex float-start">
            <a href="/admin/ukuran" class="btn btn-danger me-2"> Kembali</a>
            <button type="submit" class="btn btn-primary">
                <span class="indicator-label">Simpan</span>
            </button>
        </div>
    </div>
</form>
@endsection