@extends('admin.layouts.admin')

@section('content')
<form action="{{ route('subKategori.update', $subKategoris->id) }}" method="post">
    @csrf
    @method('put')
    <div class="col-lg-12">
        <div class="card mb-4 shadow-lg rounded card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Tambah sub kategori Produk</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Name Kategori</label>
                    <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
                        @foreach ($kategoris as $kategori)
                        @if (old('kategori_id', $kategori->id) == $subKategoris->kategori->id)
                        <option value="{{ $kategori->id }}" selected hidden>{{ $kategori->name }}</option>
                        @else
                        <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('kategori_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama sub kategori</label>
                    <input type="text" name="name" class="form-control mb-2  @error('name') is-invalid @enderror"
                        placeholder="Nama Kategori" value="{{ $subKategoris->name }}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="d-flex float-start">
            <a href="/admin/subKategori" class="btn btn-danger me-2">Kembali</a>
            <button type="submit" class="btn btn-primary">
                <span class="indicator-label">Simpan</span>
            </button>
        </div>
    </div>
</form>
@endsection