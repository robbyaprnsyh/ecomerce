@extends('admin.layouts.admin')

@section('content')
<form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="col-lg-12">
        <div class="card mb-4 shadow-lg rounded card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><b>Data Produk</b></h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Name Kategori</label>
                            <select name="kategori_id" id="kategori"
                                class="form-select @error('kategori_id') is-invalid @enderror">
                                @foreach ($kategoris as $kategori)
                                <option value="" hidden>Pilih Kategori</option>
                                <option value="{{ $kategori->id }}">{{ $kategori->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Sub Kategori</label>
                            <select name="sub_kategori_id" id="sub_kategori"
                                class="form-select @error('sub_kategori_id') is-invalid @enderror">
                                <option value="" hidden>Pilih Kategori Terlebih dulu</option>
                            </select>
                            @error('sub_kategori_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="nama_produk"
                                class="form-control mb-2  @error('nama_produk') is-invalid @enderror"
                                placeholder="Nama Produk" value="{{ old('name_produk') }}">
                            @error('nama_produk')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Ukuran</label>
                            <select name="ukuran[]" id="ukuran"
                                class="form-control w-100 @error('kategori_id') is-invalid @enderror"
                                data-placeholder="Pilih Ukuran" data-allow-clear="true" multiple="multiple">
                                @foreach ($ukurans as $ukuran)
                                <option value="{{ $ukuran->id }}">{{ $ukuran->ukuran }}
                                </option>
                                @endforeach
                            </select>
                            @error('ukuran')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Hpp Produk</label>
                            <input type="number" name="hpp"
                                class="form-control numbers mb-2  @error('hpp') is-invalid @enderror"
                                placeholder="hpp Produk" value="0" min="0">
                            @error('hpp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Harga Produk</label>
                            <input type="number" name="harga"
                                class="form-control numbers mb-2  @error('harga') is-invalid @enderror"
                                placeholder="Harga Produk" value="0" min="0">
                            @error('harga')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Stok Produk</label>
                            <input type="number" name="stok"
                                class="form-control numbers mb-2  @error('stok') is-invalid @enderror"
                                placeholder="stok Produk" value="0" min="0">
                            @error('stok')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Diskon Produk</label>
                            <div class="input-group mb-3">
                                <input type="number" name="diskon"
                                    class="form-control numbers mb-2  @error('diskon') is-invalid @enderror"
                                    placeholder="diskon Produk" value="0" min="0" max="100">
                                <button class="btn btn-secondary mb-2" type="button">%</button>
                                @error('diskon')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="required form-label">Deskripsi Produk</label>
                    <input id="deskripsi" value="{{ old('deskripsi') }}" type="hidden" name="deskripsi">
                    <trix-editor input="deskripsi"></trix-editor>
                    @error('deskripsi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">gambar produk</label>
                    <input type="file" class="form-control mb-2  @error('gambar_produk') is-invalid @enderror"
                        name="gambar_produk[]" value="{{ old('gambar_produk') }}" multiple>
                    @error('gambar_produk')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="d-flex float-start">
            <a href="/admin/produk" class="btn btn-danger me-2">Kembali</a>
            <button type="submit" class="btn btn-primary">
                <span class="indicator-label">Simpan</span>
            </button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
            $('#kategori').on('change', function() {
                var kategori_id = $(this).val();
                if (kategori_id) {
                    $.ajax({
                        url: '/admin/getSub_kategori/' + kategori_id,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#sub_kategori').empty();
                                $('#sub_kategori').append(
                                    '<option hidden>Pilih Sub Kategori</option>');
                                $.each(data, function(key, sub_kategori) {
                                    $('select[name="sub_kategori_id"]').append(
                                        '<option value="' + sub_kategori.id + '">' +
                                        sub_kategori.name + '</option>');
                                });
                            } else {
                                $('#sub_kategori').empty();
                            }
                        }
                    });
                } else {
                    $('#sub_kategori').empty();
                }
            });
        });
</script>
<script>
    $(document).ready(function() {
        $('#ukuran').select2({
        });
    });
</script>
@endsection