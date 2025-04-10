@extends('admin.layouts.admin')

@section('content')
<form action="{{ route('kategori.update', $kategoris->id) }}" method="post">
    @csrf
    @method('put')
    <div class="col-lg-12">
        <div class="card mb-4 shadow-lg rounded card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Edit Kategori Produk</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="name" class="form-control mb-2  @error('name') is-invalid @enderror"
                        placeholder="Nama Kategori" value="{{ $kategoris->name }}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="d-flex float-start">
            <a href="/admin/kategori" class="btn btn-danger me-2">Kembali</a>
            <button type="submit" class="btn btn-primary">
                <span class="indicator-label">Simpan</span>
            </button>
        </div>
    </div>
</form>
@endsection