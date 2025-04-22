@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
        <form action="{{ route('refundProduk.update', $refundProduks->id) }}" method="post">
            @csrf
            @method('put')
            <div class="col-lg-12">
                <div class="card mb-4 shadow-lg rounded card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Tambah refundProduk</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="" hidden>Pilih Status</option>
                                <option value="disetujui">disetujui</option>
                                <option value="ditolak">ditolak</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex float-start">
                    <a href="/admin/refundProduk" class="btn btn-danger me-3">Kembali</a>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Simpan </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
