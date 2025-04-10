@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <form action="{{ route('alamats.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-lg-12">
            <div class="card mb-4 shadow-lg rounded card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Data alamat</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Name User</label>
                        <select name="user_id" class="form-select @error('user_id') is-invalid @enderror">
                            @foreach ($users as $user)
                            <option value="" hidden>Pilih user</option>
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
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap"
                            class="form-control mb-2  @error('nama_lengkap') is-invalid @enderror"
                            placeholder="Nama Lengkap" value="{{ old('nama_lengkap') }}">
                        @error('nama_lengkap')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No Telepon</label>
                        <input type="number" name="no_telepon"
                            class="form-control mb-2  @error('no_telepon') is-invalid @enderror"
                            placeholder="No Telepon" value="{{ old('no_telepon') }}">
                        @error('no_telepon')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name provinsi</label>
                        <select name="provinsi_id" id="provinsi"
                            class="form-select @error('provinsi_id') is-invalid @enderror">
                            @foreach ($provinsis as $provinsi)
                            <option value="" hidden>Pilih provinsi</option>
                            <option value="{{ $provinsi->id }}">{{ $provinsi->provinsi }}
                            </option>
                            @endforeach
                        </select>
                        @error('provinsi_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kota</label>
                        <select name="kota_id" id="kota" class="form-select @error('kota_id') is-invalid @enderror">
                            <option value="" hidden>Pilih Provinsi Terlebih dulu</option>
                        </select>
                        @error('kota_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">kecamatan</label>
                        <select name="kecamatan_id" id="kecamatan"
                            class="form-select @error('kecamatan_id') is-invalid @enderror">
                            <option value="" hidden>Pilih kota Terlebih dulu</option>
                        </select>
                        @error('kecamatan_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">alamat_lengkap</label>
                        <textarea name="alamat_lengkap" cols="30" rows="7"
                            class="form-control mb-2 summernote  @error('alamat_lengkap') is-invalid @enderror"
                            placeholder="alamat_lengkap" value="{{ old('alamat_lengkap') }}"></textarea>
                        @error('alamat_lengkap')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Detail Lainnya</label>
                        <input type="text" name="detail_lainnya"
                            class="form-control mb-2  @error('detail_lainnya') is-invalid @enderror"
                            placeholder="No Telepon" value="{{ old('detail_lainnya') }}">
                        @error('detail_lainnya')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Label Alamat</label>
                        <select name="label_alamat" class="form-select @error('label_alamat') is-invalid @enderror">
                            <option value="" hidden>Pilih Label Alamat</option>
                            <option value="rumah">Rumah</option>
                            <option value="kantor">Kantor</option>
                        </select>
                        @error('label_alamat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="d-flex float-start">
                <a href="/alamat" class="btn btn-danger me-3"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                        fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z" />
                    </svg> Kembali</a>
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
                        <span class="indicator-label"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                <path
                                    d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                            </svg> Kirim </span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
            $('#provinsi').on('change', function() {
                var provinsi_id = $(this).val();
                if (provinsi_id) {
                    $.ajax({
                        url: '/getKota/' + provinsi_id,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#kota').empty();
                                $('#kota').append(
                                    '<option hidden>Pilih Kota</option>');
                                $.each(data, function(key, kotas) {
                                    $('select[name="kota_id"]').append(
                                        '<option value="' + kotas.id + '">' +
                                        kotas.kota + '</option>');
                                });
                            } else {
                                $('#kota').empty();
                            }
                        }
                    });
                } else {
                    $('#kota').empty();
                }
            });
        });
</script>
<script>
    $(document).ready(function() {
            $('#kota').on('change', function() {
                var kota_id = $(this).val();
                if (kota_id) {
                    $.ajax({
                        url: '/getKecamatan/' + kota_id,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#kecamatan').empty();
                                $('#kecamatan').append(
                                    '<option hidden>Pilih kecamatan</option>');
                                $.each(data, function(key, kecamatans) {
                                    $('select[name="kecamatan_id"]').append(
                                        '<option value="' + kecamatans.id + '">' +
                                        kecamatans.kecamatan + '</option>');
                                });
                            } else {
                                $('#kecamatan').empty();
                            }
                        }
                    });
                } else {
                    $('#kecamatan').empty();
                }
            });
        });
</script>
@endsection