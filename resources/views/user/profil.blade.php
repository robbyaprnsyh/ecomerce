@extends('user.layouts.users')

@section('content')
    <style>
        .rating-css input {
            display: none;
        }

        .rating-css input+label {
            font-size: 25px;
            color: yellow;
            text-shadow: 1px 1px 0 grey;
            cursor: pointer;
        }

        .rating-css input:checked+label~label {
            color: #b4afaf;
        }

        .rating-css label:active {
            transform: scale(0.8);
            transition: 0.3s ease;
        }
    </style>
    <div class="container clearfix">

        @php
            $users = App\Models\User::where('id', Auth::user()->id)->first();
        @endphp

        <div class="row clearfix">

            <div class="col-md-9">

                <img src="{{ asset($users->profile) }}" class="alignleft img-circle img-thumbnail my-0" alt="Avatar"
                    style="max-width: 84px;">

                <div class="heading-block border-0">
                    <h3>{{ $users->name }}</h3>
                    <span style="margin-top:-7px">{{ $users->email }}</span>
                </div>

                <div class="clear"></div>

                @yield('profil')
            </div>


            <div class="w-100 line d-block d-md-none"></div>

            <div class="col-md-3">

                <div class="list-group">
                    <a href="/profil/akun" class="list-group-item list-group-item-action d-flex justify-content-between">
                        <div>Akun saya</div><i class="icon-user"></i>
                    </a>
                    <a href="/profil/alamat" class="list-group-item list-group-item-action d-flex justify-content-between">
                        <div>Alamat saya</div><i class="icon-laptop2"></i>
                    </a>
                    <a href="/profil/voucher" class="list-group-item list-group-item-action d-flex justify-content-between">
                        <div>Voucher</div><i class="icon-envelope2"></i>
                    </a>
                    <a href="/profil/pesanan" class="list-group-item list-group-item-action d-flex justify-content-between">
                        <div>Pesanan saya</div><i class="icon-credit-cards"></i>
                    </a>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="list-group-item list-group-item-action d-flex justify-content-between">
                        <div>Logout</div><i class="icon-line2-logout"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>

        </div>

    </div>

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
                                    '<option hidden>Pilih Kota</option>');
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
