@extends('user.profil')

@section('profil')
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <a class="button button-circle button-black mb-3 button-small" data-bs-toggle="modal" data-bs-target="#alamatCreate">tambah
        alamat</a>

    <div class="modal fade modal-lg" id="alamatCreate" data-bs-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="alamatCreate" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('alamat.store') }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Alamat</h4>
                        <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <div class="input-group">
                                    <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap"
                                        class="form-control required" />
                                </div>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="no_telepon">No telepon</label>
                                <div class="input-group">
                                    <input type="number" id="no_telepon" min="0" name="no_telepon"
                                        placeholder="No telepon" class="required form-control numbers" />
                                </div>
                            </div>
                        </div>

                        <div class="w-100"></div>

                        <div class="col-12 mb-3">
                            <label for="provinsi">Provinsi</label>
                            <select id="provinsi" name="provinsi_id" class="form-select">
                                <option value="" selected hidden>Pilih provinsi
                                </option>
                                @foreach ($provinsis as $provinsi)
                                    <option value="{{ $provinsi->id }}">{{ $provinsi->provinsi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-100"></div>

                        <div class="col-12 mb-3">
                            <label for="kota">Kota/Kabupaten</label>
                            <select id="kota" name="kota_id" class="form-select">
                                <option value="" hidden>Pilih Provinsi lebih dulu</option>
                            </select>
                        </div>

                        <div class="w-100"></div>

                        {{-- <div class="col-12 mb-3">
                            <label for="kecamatan">Kecamatan</label>
                            <select id="kecamatan" name="kecamatan_id" class="form-select">
                                <option value="" hidden>Pilih Kota/Kabupaten lebih dulu
                                </option>
                            </select>
                        </div> --}}

                        <div class="w-100"></div>

                        <div class="col-12 mb-3">
                            <label for="alamat_lengkap">Alamat Lengkap
                            </label>
                            <textarea class="required form-control" id="alamat_lengkap" name="alamat_lengkap" rows="3" cols="30"
                                placeholder="Nama jalan, Gedung, No.Rumah"></textarea>
                        </div>

                        <div class="w-100"></div>

                        <div class="col-12 mb-3">
                            <label for="detail_lainnya">Detail Lainnya</label>
                            <div class="input-group">
                                <input type="text" id="detail_lainnya" name="detail_lainnya"
                                    placeholder="Detail lainnya (cth:Blok/Patokan)" class="form-control" />
                            </div>
                        </div>

                        <div class="w-100"></div>
                        <div class="col-12">
                            <label class="d-block">Tandai Sebagai</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input required" id="Rumah" type="radio" name="label_alamat"
                                    value="Rumah">
                                <label class="form-check-label nott ms-2" for="Rumah">Rumah</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" id="Kantor" type="radio" name="label_alamat"
                                    value="Kantor">
                                <label class="form-check-label nott ms-2" for="Kantor">Kantor</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button button-teal" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="button button-rounded">kirim</button>
                    </div>
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div>
    @if (count($alamats))
        @foreach ($alamats as $alamat)
            <div class="promo promo-light promo-full p-3 mb-3">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg">
                            <h4>
                                <div id="nama_lengkap" class="d-inline">
                                    {{ $alamat->nama_lengkap }}
                                </div> <span id="no_telepon">
                                    {{ $alamat->no_telepon }}</span>
                            </h4>
                            <div style="margin-top:-10px" id="alamat_lengkap">
                                {{ $alamat->alamat_lengkap }}</div>

                            @if ($alamat->detail_lainnya != '')
                                <div>({{ $alamat->detail_lainnya }})</div>
                            @endif

                        </div>
                        <div class="col-12 col-lg-auto mt-4 mt-lg-0">
                            <form id="deleteAlamat{{ $alamat->id }}" action="{{ route('alamat.destroy', $alamat->id) }}"
                                method="POST">
                                @csrf
                                @method('delete')
                                <a data-bs-toggle="modal" data-bs-target="#alamatEdit{{ $alamat->id }}"
                                    class="button button-circle button-black button-small m-0 mx-1">Ubah</a>
                                <a id="btnDeleteAlamat" data-id="{{ $alamat->id }}"
                                    class="button button-circle button-black button-small m-0">Hapus</a>
                            </form>

                            <div class="modal fade modal-lg" id="alamatEdit{{ $alamat->id }}"
                                data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="alamatEdit"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('alamat.update', $alamat->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        @php
                                            $kotas = App\Models\Kota::where('provinsi_id', $alamat->provinsi_id)->get();
                                            $kecamatans = App\Models\Kecamatan::where('kota_id', $alamat->kota_id)->get();
                                        @endphp
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Alamat</h4>
                                                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal"
                                                    aria-hidden="true"></button>
                                            </div>
                                            <div class="modal-body">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-6 mb-3">
                                                        <label for="nama_lengkap">Nama
                                                            Lengkap</label>
                                                        <div class="input-group">
                                                            <input type="text" id="nama_lengkap" name="nama_lengkap"
                                                                value="{{ $alamat->nama_lengkap }}"
                                                                class="form-control required" />
                                                        </div>
                                                    </div>

                                                    <div class="col-6 mb-3">
                                                        <label for="no_telepon">No telepon</label>
                                                        <div class="input-group">
                                                            <input type="number" id="no_telepon" min="0"
                                                                name="no_telepon" value="{{ $alamat->no_telepon }}"
                                                                class="required form-control numbers" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="w-100"></div>

                                                <div class="col-12 mb-3">
                                                    <label for="provinsi">Provinsi</label>
                                                    <select id="provinsiEdit" name="provinsi_id" class="form-select">
                                                        <option value="" selected hidden>
                                                            Pilih provinsi
                                                        </option>
                                                        @foreach ($provinsis as $provinsi)
                                                            @if (old('provinsi_id', $provinsi->id) == $alamat->provinsi_id)
                                                                <option value="{{ $provinsi->id }}" selected hidden>
                                                                    {{ $provinsi->provinsi }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $provinsi->id }}">
                                                                    {{ $provinsi->provinsi }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="w-100"></div>

                                                <div class="col-12 mb-3">
                                                    <label for="kota">Kota/Kabupaten</label>
                                                    <select id="kotaEdit" name="kota_id" class="form-select">
                                                        @foreach ($kotas as $kota)
                                                            @if (old('kota_id', $kota->id) == $alamat->kota_id)
                                                                <option value="{{ $kota->id }}" selected hidden>
                                                                    {{ $kota->kota }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $kota->id }}">
                                                                    {{ $kota->kota }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="w-100"></div>

                                                {{-- <div class="col-12 mb-3">
                                                    <label for="kecamatan">Kecamatan</label>
                                                    <select id="kecamatanEdit" name="kecamatan_id" class="form-select">
                                                        @foreach ($kecamatans as $kecamatan)
                                                            @if (old('kecamatan_id', $kecamatan->id) == $alamat->kecamatan_id)
                                                                <option value="{{ $kecamatan->id }}" selected hidden>
                                                                    {{ $kecamatan->kecamatan }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $kecamatan->id }}">
                                                                    {{ $kecamatan->kecamatan }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div> --}}

                                                <div class="w-100"></div>

                                                <div class="col-12 mb-3">
                                                    <label for="alamat_lengkap">Alamat Lengkap
                                                    </label>
                                                    <textarea class="required form-control" id="alamat_lengkap" name="alamat_lengkap" rows="3" cols="30"
                                                        placeholder="Nama jalan, Gedung, No.Rumah">{{ $alamat->alamat_lengkap }}</textarea>
                                                </div>

                                                <div class="w-100"></div>

                                                <div class="col-12 mb-3">
                                                    <label for="detail_lainnya">Detail
                                                        Lainnya</label>
                                                    <div class="input-group">
                                                        <input type="text" id="detail_lainnya" name="detail_lainnya"
                                                            value="{{ $alamat->detail_lainnya }}" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="w-100"></div>
                                                <div class="col-12">
                                                    <label class="d-block">Tandai Sebagai</label>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input required" id="Rumah"
                                                            type="radio" name="label_alamat" value="Rumah"
                                                            {{ $alamat->label_alamat == 'Rumah' ? 'checked' : null }}>
                                                        <label class="form-check-label nott ms-2"
                                                            for="Rumah">Rumah</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="Kantor" type="radio"
                                                            name="label_alamat" value="Kantor"
                                                            {{ $alamat->label_alamat == 'Kantor' ? 'checked' : null }}>
                                                        <label class="form-check-label nott ms-2"
                                                            for="Kantor">Kantor</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="button button-teal"
                                                    data-bs-dismiss="modal">Kembali</button>
                                                <button type="submit" class="button button-rounded">kirim</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </form>
                                </div><!-- /.modal-dialog -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="text-center">
            <img src="{{ asset('images/no_review.png') }}" width="100px" alt="" srcset="">
            <div class="fw-bold p-4">Belum ada alamat</div>
        </div>
    @endif

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
                                // $('#kota').append(
                                //     '<option hidden selected value="">Pilih Kota</option>');
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

            $('#provinsiEdit').on('change', function() {
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
                                $('#kotaEdit').empty();
                                $('#kotaEdit').append(
                                    "<option hidden value=''>Pilih Kota</option>");
                                $.each(data, function(key, kotas) {
                                    $('select[name="kota_id"]').append(
                                        '<option value="' + kotas.id + '">' +
                                        kotas.kota + '</option>');
                                });
                            } else {
                                $('#kotaEdit').empty();
                            }
                        }
                    });
                } else {
                    $('#kotaEdit').empty();
                }
            });

            $('#kotaEdit').on('change', function() {
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
                                $('#kecamatanEdit').empty();
                                $('#kecamatanEdit').append(
                                    '<option hidden>Pilih kecamatan</option>');
                                $.each(data, function(key, kecamatans) {
                                    $('select[name="kecamatan_id"]').append(
                                        '<option value="' + kecamatans.id + '">' +
                                        kecamatans.kecamatan + '</option>');
                                });
                            } else {
                                $('#kecamatanEdit').empty();
                            }
                        }
                    });
                } else {
                    $('#kecamatanEdit').empty();
                }
            });
        });
    </script>
@endsection
