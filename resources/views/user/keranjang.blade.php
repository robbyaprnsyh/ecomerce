@extends('user.layouts.users')

@section('content')
    @if ($errors->any())
        <script>
            Swal.fire({
                toast: true,
                position: 'bottom-right',
                background: 'black',
                color: 'white',
                icon: 'error',
                title: 'Pilih produk lebih dulu',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true
            });
        </script>
    @endif

    <div class="container">
        <form id="transaksi" method="GET" action="{{ route('checkout.index') }}">
            <input type="hidden" name="voucher_id" id="voucher_id">
            <div class="row">
                <div class="col-lg-8">
                    <table class="table cart mb-5">
                        <thead>
                            <tr>
                                <th class="cart-product-check">
                                    <input id="allCheck" class="checkbox-style" name="allCheck" type="checkbox">
                                    <label for="allCheck" class="checkbox-style-3-label checkbox-small"></label>
                                </th>
                                <th class=" cart-product-thumbnail">Product</th>
                                <th class="cart-product-price">Ukuran</th>
                                <th class="cart-product-quantity">Jumlah</th>
                                <th class="cart-product-subtotal">Total</th>
                                <th class="cart-product-remove">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($keranjangs))
                                @foreach ($keranjangs as $keranjang)
                                    <tr class="cart_item">
                                        <td class="cart-product-check">
                                            <input id="{{ $keranjang->id }}" class="checkbox-style check"
                                                data-harga="{{ $keranjang->total_harga }}" name="keranjang_id[]"
                                                value="{{ $keranjang->id }}" type="checkbox">
                                            <label for="{{ $keranjang->id }}"
                                                class="checkbox-style-3-label checkbox-small"></label>
                                        </td>

                                        <td class="cart-product-thumbnail">
                                            <div class="row">
                                                <div class="col-4">
                                                    <a href="/detailProduk/{{ $keranjang->produk_id }}"><img width="64"
                                                            height="64"
                                                            src="{{ asset($keranjang->produk->image[0]->gambar_produk) }}"
                                                            alt="{{ $keranjang->produk->nama_produk }}"></a>
                                                </div>
                                                <div class="col mt-2 ">
                                                    <div class="cart-product-name">{{ $keranjang->produk->nama_produk }}
                                                    </div>
                                                    @php
                                                        $diskon = ($keranjang->produk->diskon / 100) * $keranjang->produk->harga;
                                                        $harga = $keranjang->produk->harga - $diskon;
                                                    @endphp
                                                    <h5 id="harga" data-harga="{{ $harga }}">Rp.
                                                        {{ number_format($harga, 0, ',', '.') }}</h5>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="cart-product-subtotal">
                                            {{ $keranjang->ukuran }}
                                        </td>

                                        <td class="cart-product-quantity">
                                            <div class="quantity">
                                                <input type="button" value="-" class="minus" id="minus">
                                                <input type="button" name="jumlah" readonly id="data_jumlah"
                                                    value="{{ $keranjang->jumlah }}" min="1" class="qty"
                                                    data-jumlah="{{ $keranjang->jumlah }}" />
                                                <input type="button" value="+" class="plus" id="plus">
                                            </div>
                                        </td>

                                        <td class="cart-product-subtotal">
                                            Rp. <span
                                                id="totals">{{ number_format($keranjang->total_harga, 0, ',', '.') }}</span>
                                        </td>

                                        <td class="cart-product-remove">
                                            <a href="/keranjang/{{ $keranjang->id }}/delete" class="remove"
                                                title="Haous produk ini"><i class="icon-line-delete icon-lg"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <div class="my-3">
                                            <img src="{{ asset('images/no_produk.png') }}" width="80px" alt=""
                                                srcset="">
                                            <div class="fw-bold p-4">keranjang kosong</div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            <tr class="cart_item">
                                <td colspan="6">
                                    <a href="/produk" class="button button-3d button-black m-0 m-0 mx-2">Lanjut
                                        Belanja</a>
                                    @if (count($keranjangs))
                                        <a id="btnDeleteAllKeranjang"
                                            class="button button-3d button-black m-0 mt-2 mt-sm-0 me-0">Hapus
                                            all
                                            keranjang</a>
                                    @else
                                        <a id="keranjang" class="button button-3d button-black m-0 mt-2 mt-sm-0 me-0">Hapus
                                            all
                                            keranjang</a>
                                    @endif
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
                <div class="col-lg-4">
                    <h4>Total Keranjang</h4>

                    <div class="col-lg-auto ps-lg-0 mb-3">
                        <div class="row">
                            <div class="col-md-8 m-0">
                                <input id="kode_voucher" class="sm-form-control text-center text-md-start" readonly
                                    placeholder="Kode voucher.." />
                            </div>
                            <div class="col-md-4 mt-3 mt-md-0">
                                <a data-bs-toggle="modal" data-bs-target="#voucher"
                                    class="button button-3d button-black button-rounded m-0">Pakai voucher</a>

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
                                                        <img src="{{ asset('images/no_produk.png') }}" width="100px"
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
                    </div>
                    <div class="table-responsive">
                        <table class="table cart cart-totals">
                            <tbody>
                                <tr class="cart_item">
                                    <td class="cart-product-name">
                                        <strong>Jumlah</strong>
                                    </td>

                                    <td class="cart-product-name">
                                        <span id="jumlah" style="margin-left:140px">0</span>
                                    </td>
                                </tr>
                                <tr class="cart_item">
                                    <td class="cart-product-name">
                                        <strong>Total</strong>
                                    </td>

                                    <td class="cart-product-name">
                                        <div style="margin-left:130px">Rp. <span id="total">0</span> </div>
                                        <input type="hidden" id="total_harga" value="0">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-auto pe-lg-0 mt-3 float-end" style="margin-right: -50px">
                        <a onclick="event.preventDefault(); document.getElementById('transaksi').submit();"
                            class="button button-3d mt-2 mt-sm-0 me-0">Checkout</a>
                    </div>
                </div>
            </div>
        </form>
        <form id="deleteAllKeranjang" action="/deleteAllKeranjang">
        </form>
    </div>


    <script>
        $('#plus').click(function() {

            var newQuantity = $('#data_jumlah').val();
            newQuantity++;
            var harga = $('#harga').data('harga');
            var total_harga = newQuantity * harga;
            $("#totals").html(total_harga);
            console.log(total_harga);

        });

        $('#minus').click(function() {

            var newQuantity = $('#data_jumlah').val();
            newQuantity--;
            var harga = $('#harga').data('harga');
            var total_harga = newQuantity * harga;
            $("#totals").html(total_harga);
            console.log(total_harga);

        });

        $(document).ready(function() {
            $('#allCheck').click(function() {
                $('.check').prop("checked", $(this).prop('checked'))
                var jumlah = 0;
                var total_harga = 0;
                $('.check').each(function() {
                    if ($(this).prop("checked") == true) {
                        jumlah++;
                        var keranjang = $(this).data('harga');
                        total_harga += parseInt(keranjang);
                    }
                });
                $('#jumlah').html(jumlah);
                $('#total').html(total_harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
            });

            $('.check').click(function() {
                var jumlah = 0;
                var total_harga = 0;
                $('.check').each(function() {
                    if ($(this).prop("checked") == true) {
                        jumlah++;
                        var keranjang = $(this).data('harga');
                        total_harga += parseInt(keranjang);
                    }
                });
                $('#jumlah').html(jumlah);
                $('#total_harga').val(total_harga);
                $('#total').html(total_harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
            });
        });

        $('.select').click(function() {
            var kode_voucher = $(this).data(kode_voucher);
            $('#kode_voucher').val(kode_voucher.id.voucher.kode_voucher);
            $('#voucher_id').val(kode_voucher.id.id);
            var total = $('#total_harga').val();
            var diskon = total * (kode_voucher.id.voucher.diskon / 100);
            var total_harga = total - diskon;
            $('#total').html(total_harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
            // CloseModal
            $("#voucher").modal("hide");
        });
    </script>
@endsection
