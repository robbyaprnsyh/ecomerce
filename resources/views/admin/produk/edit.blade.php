@extends('admin.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-7">
            <form action="{{ route('produk.update', $produks->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                {{-- <div class="card mb-4 shadow-lg rounded card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Data Produk</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Name Kategori</label>
                        <select name="kategori_id" id="kategori"
                            class="form-select @error('kategori_id') is-invalid @enderror">
                            @foreach ($kategoris as $kategori)
                            @if (old('kategori_id', $kategori->id) == $produks->kategori->id)
                            <option value="{{ $kategori->id }}" selected>
                                {{ $kategori->name }}</option>
                            @else
                            <option value="{{ $kategori->id }}">{{ $kategori->name }}
                            </option>
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
                        <label class="form-label">Sub Kategori</label>
                        <select name="sub_kategori_id" id="sub_kategori"
                            class="form-select @error('sub_kategori_id') is-invalid @enderror">
                            @foreach ($subKategoris as $subKategori)
                            @if (old('sub_kategori_id', $subKategori->id) == $produks->subKategori->id)
                            <option value="{{ $subKategori->id }}" selected>
                                {{ $subKategori->name }}</option>
                            @else
                            <option value="{{ $subKategori->id }}">{{ $subKategori->name }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                        @error('sub_kategori_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="nama_produk"
                            class="form-control mb-2  @error('nama_produk') is-invalid @enderror"
                            placeholder="Nama Produk" value="{{ $produks->nama_produk }}">
                        @error('nama_produk')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hpp Produk</label>
                        <input type="number" name="hpp" class="form-control mb-2  @error('hpp') is-invalid @enderror"
                            placeholder="hpp Pr numbersoduk" value="{{ $produks->hpp }}">
                        @error('hpp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga Produk</label>
                        <input type="number" name="harga"
                            class="form-control numbers mb-2  @error('harga') is-invalid @enderror"
                            placeholder="Harga Produk" value="{{ $produks->harga }}">
                        @error('harga')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stok Produk</label>
                        <input type="number" name="stok" class="form-control mb-2  @error('stok') is-invalid @enderror"
                            placeholder="stok P numbersroduk" value="{{ $produks->stok }}">
                        @error('stok')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Diskon Produk</label>
                        <div class="input-group mb-3">
                            <input type="number" name="diskon"
                                class="form-control numbers mb-2  @error('diskon') is-invalid @enderror"
                                placeholder="diskon Produk" value="{{ $produks->diskon }}">
                            <button class="btn btn-secondary mb-2" type="button">%</button>
                            @error('diskon')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="required form-label">Deskripsi Produk</label>
                        <input id="deskripsi" value="{!! $produks->deskripsi !!}" type="hidden" name="deskripsi">
                        <trix-editor input="deskripsi"></trix-editor>
                        @error('deskripsi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div> --}}
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
                                            @if (old('kategori_id', $kategori->id) == $produks->kategori->id)
                                                <option value="{{ $kategori->id }}" selected>
                                                    {{ $kategori->name }}</option>
                                            @else
                                                <option value="{{ $kategori->id }}">{{ $kategori->name }}
                                                </option>
                                            @endif
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
                                        @foreach ($subKategoris as $subKategori)
                                            @if (old('sub_kategori_id', $subKategori->id) == $produks->subKategori->id)
                                                <option value="{{ $subKategori->id }}" selected>
                                                    {{ $subKategori->name }}</option>
                                            @else
                                                <option value="{{ $subKategori->id }}">{{ $subKategori->name }}
                                                </option>
                                            @endif
                                        @endforeach
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
                                        placeholder="Nama Produk" value="{{ $produks->nama_produk }}">
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
                                            <option value="{{ $ukuran->id }}"
                                                {{ in_array($ukuran->id, $produks->ukuran->pluck('id')->toArray()) ? 'selected' : null }}>
                                                {{ $ukuran->ukuran }}</option>
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
                                        placeholder="hpp Produk" value="{{ $produks->hpp }}">
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
                                        placeholder="Harga Produk" value="{{ $produks->harga }}">
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
                                            placeholder="diskon Produk" value="{{ $produks->diskon }}">
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
                            <input id="deskripsi" value="{!! $produks->deskripsi !!}" type="hidden" name="deskripsi">
                            <trix-editor input="deskripsi"></trix-editor>
                            @error('deskripsi')
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
            </form>
        </div>
        <div class="col-lg-5">
            <div class="card mb-4 shadow-lg overflow-scroll rounded card" style="height: 500px">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><b>Image Produk</b></h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('image.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="produk_id" value="{{ $produks->id }}">
                        <div class="mb-3">
                            <label class="form-label">gambar produk</label>
                            <input type="file" class="form-control mb-2  @error('gambar_produk') is-invalid @enderror"
                                name="gambar_produk[]" value="{{ old('gambar_produk') }}" multiple>
                            @error('gambar_produk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Simpan</span>
                            </button>
                        </div>
                    </form>
                    <div class="row mb-2">
                        @foreach ($images as $image)
                            <div class="col-md-6 col-lg-6 mb-4">
                                <div class="card h-100">
                                    <img class="card-img-top" src="{{ asset("images/gambar_produk/" . $image->gambar_produk) }}"
                                        alt="Card image cap" />
                                    <div class="card-body text-center">
                                        <form action="{{ route('image.destroy', $image->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#modalCenter{{ $image->id }}"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                </svg>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="modalCenter{{ $image->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalCenterTitle">Apakah Anda
                                                                Yakin?
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">
                                                                Kembali
                                                            </button>
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
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
        $(".numbers").keypress(function(event) {
            return /\d/.test(String.fromCharCode(event.keyCode));
        });

        $(document).ready(function() {
            $('#ukuran').select2({});
        });
    </script>
@endsection
