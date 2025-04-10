@extends('user.layouts.users')

@section('content')
    {{-- Male --}}
    {{--
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Check Out</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-md-6">
                        <div class="checkout__order">
                            <h4 class="order__title">Your order</h4>
                            <div class="checkout__order__products">Product <span>Total</span></div>
                            <ul class="checkout__total__products">
                                @foreach ($keranjangs as $keranjang)
                                <li>{{ $keranjang->produk->nama_produk }}
                                    ({{ $keranjang->ukuran }})
                                    / {{ $keranjang->jumlah }}<span>Rp.
                                        {{ number_format($keranjang->total_harga, 0, ',', '.') }} </span>
                                </li>
                                <input type="hidden" name="keranjang_id[]" value="{{ $keranjang->id }}">
                                @endforeach
                            </ul>
                            <ul class="checkout__total__all">
                                <li>Total <span>Rp.
                                        {{ number_format($total_harga, 0, ',', '.') }}</span></li>
                            </ul>
                            <div class="mb-3">
                                <select name="alamat_id" class="form-select @error('alamat_id') is-invalid @enderror">
                                    @foreach ($alamats as $alamat)
                                    <option value="" hidden>Pilih Alamat</option>
                                    <option value="{{ $alamat->id }}">{{ $alamat->nama_lengkap }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('alamat_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <select name="metodePembayaran_id"
                                    class="form-control @error('metodePembayaran_id') is-invalid @enderror">
                                    <option value="" hidden>Pilih Metode Pembayaran</option>
                                    @foreach ($metodePembayarans as $metodePembayaran)
                                    <option value="{{ $metodePembayaran->id }}">
                                        {{ $metodePembayaran->metodePembayaran }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('metodePembayaran_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <button type="submit" class="site-btn">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End --> --}}

    {{-- EndMale --}}

    {{-- Canvas --}}

    <div class="container clearfix">
        <form action="{{ route('checkout.store') }}" id="checkout" method="POST">
            @csrf
            <h4>Alamat Pengiriman</h4>

            @if (count($alamats))
                <div class="promo promo-light promo-full p-4 p-md-5 mb-5">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg">
                                <h4>
                                    <div id="nama_lengkap" class="d-inline">{{ $alamats[0]->nama_lengkap }}</div> <span
                                        id="no_telepon">
                                        ({{ $alamats[0]->no_telepon }})</span>
                                </h4>
                                <div style="margin-top:-10px" id="alamat_lengkap">{{ $alamats[0]->alamat_lengkap }}</div>
                                <input type="hidden" name="alamat_id" id="alamat_id" data-kota="{{ $alamats[0]->kota_id }}"
                                    value="{{ $alamats[0]->id }}">
                            </div>
                            <div class="col-12 col-lg-auto mt-4 mt-lg-0">
                                <a data-bs-toggle="modal" data-bs-target="#alamat"
                                    class="button button-circle button-black m-0">Ubah</a>

                                <!-- Scrollable modal -->
                                <div class="modal fade bs-example-modal-scrollable modal-lg" id="alamat" tabindex="-1"
                                    role="dialog" aria-labelledby="scrollableModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Alamat saya</h4>
                                                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal"
                                                    aria-hidden="true"></button>
                                            </div>
                                            <div class="modal-body">
                                                @foreach ($alamats as $alamat)
                                                    <div class="card p-3 mb-2">
                                                        <div class="row">
                                                            <div class="col-8 col-lg">
                                                                <h4>{{ $alamat->nama_lengkap }} <span>
                                                                        ({{ $alamat->no_telepon }})
                                                                    </span></h4>
                                                                <div style="margin-top:-10px">{{ $alamat->alamat_lengkap }}
                                                                </div>
                                                            </div>
                                                            <div class="col-4 col-lg-auto" style="margin-top:15px">
                                                                <button type="button"
                                                                    class="button button-circle button-black m-0 selectAlamat"
                                                                    data-id="{{ $alamat }}">Pakai</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="button button-rounded"
                                                    data-bs-dismiss="modal">kembali</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="modal-on-load" data-target="#myModal">
                </div>

                <!-- Modal -->
                <div class="modal1 mfp-hide" id="myModal">
                    <div class="block mx-auto" style="background-color: #FFF; max-width: 500px;">
                        <div class="center" style="padding:20px">
                            <h3>Anda Belum memiliki alamat</h3>
                        </div>
                        <div class="section center m-0" style="padding: 10px;">
                            <a href="/keranjang" class="button button-red button-circle">Kembali</a>
                            <a href="/profil/alamat" class="button button-circle">Tambah
                                Alamat</a>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row col-mb-50 gutter-50">
                <div class="w-100"></div>
                <div class="col-lg-6">
                    <h4>Pesanan anda</h4>

                    <div class="table-responsive">
                        <table class="table cart mb-5">
                            <thead>
                                <tr>
                                    <th class=" cart-product-thumbnail">Produk</th>
                                    <th class="cart-product-price">Ukuran</th>
                                    <th class="cart-product-quantity">Jumlah</th>
                                    <th class="cart-product-subtotal">Total</th>
                                    <th class="cart-product-remove">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($keranjangs as $keranjang)
                                    <input type="hidden" name="keranjang_id[]" value="{{ $keranjang->id }}">
                                    <tr class="cart_item">
                                        <td class="cart-product-thumbnail">
                                            <div class="row">
                                                <div class="col-4">
                                                    <a href="#"><img width="64" height="64"
                                                            src="{{ asset($keranjang->produk->image[0]->gambar_produk) }}"
                                                            alt="{{ $keranjang->produk->nama_produk }}"></a>
                                                </div>
                                                <div class="col mt-2 mx-1">
                                                    <div class="cart-product-name">{{ $keranjang->produk->nama_produk }}
                                                    </div>
                                                    @php
                                                        $diskon = ($keranjang->produk->diskon / 100) * $keranjang->produk->harga;
                                                        $harga = $keranjang->produk->harga - $diskon;
                                                    @endphp
                                                    <h5>Rp. {{ number_format($harga, 0, ',', '.') }}</h5>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="cart-product-subtotal">
                                            {{ $keranjang->ukuran }}
                                        </td>

                                        <td class="cart-product-subtotal">
                                            {{ $keranjang->jumlah }}
                                        </td>

                                        <td class="cart-product-subtotal">
                                            Rp. {{ number_format($keranjang->total_harga, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>

                <div class="col-lg-6">
                    <h4>Total Keranjang</h4>
                    <div class="row mb-3">
                        <div class="col-md-8 m-0">
                            @if ($voucher_saya != '')
                                <input type="hidden" name="voucher_id" id="voucher_id" value="{{ $voucher_saya->id }}">
                                <input id="kode_voucher" value="{{ $voucher_saya->voucher->kode_voucher }}"
                                    class="sm-form-control text-center text-md-start" readonly
                                    placeholder="Enter Coupon Code.." />
                            @else
                                <input type="hidden" name="voucher_id" id="voucher_id">
                                <input id="kode_voucher" class="sm-form-control text-center text-md-start" readonly
                                    placeholder="Enter Coupon Code.." />
                            @endif
                        </div>
                        <div class="col-md-4 mt-3 mt-md-0">
                            <a data-bs-toggle="modal" data-bs-target="#voucher"
                                class="button button-3d button-black m-0">Apply
                                Coupon</a>

                            <!-- Scrollable modal -->
                            <div class="modal fade bs-example-modal-scrollable" id="voucher" tabindex="-1"
                                role="dialog" aria-labelledby="scrollableModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Voucher Saya</h4>
                                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal"
                                                aria-hidden="true"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if (count($voucher_users))
                                                @foreach ($voucher_users as $voucher_user)
                                                    <div class="card mb-2">
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <img src="{{ asset('images/no_voucher.png') }}"
                                                                    width="300px" alt="" srcset="">
                                                            </div>
                                                            <div class="col-lg-6 mt-2">
                                                                <div class="fw-bold fs-6">
                                                                    {{ $voucher_user->voucher->kode_voucher }}</div>
                                                                <div class="p-0">diskon :
                                                                    {{ $voucher_user->voucher->diskon }}%
                                                                </div>
                                                                <div class="p-0">
                                                                    {{ $voucher_user->voucher->waktu_mulai }} -
                                                                    {{ $voucher_user->voucher->waktu_berakhir }}</div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <button type="button"
                                                                    class="my-4 button button-circle button-black m-0 button-small select"
                                                                    data-id="{{ $voucher_user }}">Pakai</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="text-center">
                                                    <img src="{{ asset('images/no_review.png') }}" width="80px"
                                                        alt="" srcset="">
                                                    <div class="fw-bold p-4">Voucher kosong</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="button button-rounded"
                                                data-bs-dismiss="modal">kembali</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 m-0">
                            <select name="courier" id="ongkirs" class="form-select required">
                                <option value="" selected hidden>Pilih opsi pengiriman</option>
                                <option value="jne">JNE</option>
                                <option value="pos">POS</option>
                                <option value="tiki">TIKI</option>
                            </select>
                        </div>
                        <p class="ongkir"></p>
                    </div>

                    <div class="table-responsive">
                        <table class="table cart">
                            <tbody>
                                <tr class="cart_item">
                                    <td class="border-top-0 cart-product-name">
                                        <strong>Total</strong>
                                    </td>

                                    <td class="border-top-0 cart-product-name">
                                        <input type="hidden" id="total_harga" value="{{ $total }}">
                                        <span class="amount" id="total"> Rp.
                                            {{ number_format($total_harga, 0, ',', '.') }}</span>
                                    </td>
                                </tr>
                                <tr class="cart_item">
                                    <td class="border-top-0 cart-product-name">
                                        <strong>Metode Pembayaran</strong>
                                    </td>
                                    <td class="border-top-0 cart-product-name">
                                        <div class="form-group mt-3">
                                            <select class="form-select required" name="metodePembayaran_id">
                                                <option value="" hidden selected>Pilih metode pembayaran
                                                </option>
                                                @foreach ($metodePembayarans as $metodePembayaran)
                                                    <option value="{{ $metodePembayaran->id }}">
                                                        {{ $metodePembayaran->metodePembayaran }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <a onclick="event.preventDefault(); document.getElementById('checkout').submit();"
                        class="button button-3d float-end">checkout</a>
                </div>
            </div>
        </form>
    </div>

    {{-- EndCanvas --}}

    {{-- <a class="btn yoww">asdas</a> --}}


    <script>
        $('.select').click(function() {
            var kode_voucher = $(this).data(kode_voucher);
            $('#kode_voucher').val(kode_voucher.id.voucher.kode_voucher);
            $('#voucher_id').val(kode_voucher.id.id);
            var total = $('#total_harga').val();
            var diskon = total * (kode_voucher.id.voucher.diskon / 100);
            var total_harga = total - diskon;
            $('#total').html('Rp. ' + total_harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
            // CloseModal
            $("#voucher").modal("hide");
        });

        $('.selectAlamat').click(function() {
            var alamat = $(this).data(alamat);
            console.log(alamat.id.id);
            $('#nama_lengkap').html(alamat.id.nama_lengkap);
            $('#no_telepon').html('(' + alamat.id.no_telepon + ')');
            $('#alamat_lengkap').html(alamat.id.alamat_lengkap);
            $('#alamat_id').val(alamat.id.id);
            // CloseModal
            $("#alamat").modal("hide");
        });


        // $(document).ready(function() {
        //active select2
        // let isProcessing = false;
        $('#ongkirs').change(function() {

            let token = $("meta[name='csrf-token']").attr("content");
            let city_destination = $('#alamat_id').data('kota');

            console.log(city_destination);
            let courier = $('select[name=courier]').val();
            let weight = $('#weight').val();

            jQuery.ajax({
                url: "/ongkir",
                data: {
                    _token: token,
                    // city_origin: 22,
                    city_destination: city_destination,
                    courier: courier,
                    weight: 100,
                },
                dataType: "JSON",
                type: "POST",
                success: function(response) {
                    if (response) {
                        $('.ongkir').empty();
                        // $('.ongkir').addClass('d-block');
                        $.each(response[0]['costs'], function(key, value) {
                            $('.ongkir').append('<li class="list-group-item">' +
                                response[0].code.toUpperCase() +
                                ' : <strong><a class="btn yoww">' +
                                value.service + '</a></strong> - Rp. ' + value.cost[
                                    0].value + ' (' + value.cost[0].etd +
                                ' hari)</li>')
                        });

                    }
                }
            });

        });
    </script>

@endsection
