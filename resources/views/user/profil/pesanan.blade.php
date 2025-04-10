@extends('user.profil')

@section('profil')
    <div class="tabs tabs-bb clearfix" id="tab-9">

        <ul class="tab-nav clearfix">
            <li><a href="#tabs-semua">Semua</a></li>
            <li><a href="#tabs-proses">Sedang diproses</a></li>
            <li><a href="#tabs-selesai">Selesai</a></li>
            <li><a href="#tabs-pengajuan_refund">Pengajuan refund</a></li>
            <li><a href="#tabs-dikembalikan">dikembalikan</a></li>
        </ul>

        <div class="tab-container">

            <div class="tab-content clearfix" id="tabs-semua">
                @if (count($pesanan_all))
                    @foreach ($pesanan_all as $pesanan)
                        <div class="col-lg-12 mb-3">
                            <div class="promo promo-light promo-full">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <img src="{{ asset($pesanan->keranjang->produk->image[0]->gambar_produk) }}"
                                            width="150px" height="140px" alt="" srcset="">
                                    </div>
                                    <div class="col-lg-9">
                                        <h4 class="mt-4">
                                            <div class="d-inline" style="margin-left:-50px">
                                                {{ $pesanan->keranjang->produk->nama_produk }}
                                                / {{ $pesanan->created_at->format('Y-m-d') }}
                                            </div>
                                            <span class="text-danger float-end mx-4">{{ $pesanan->status }}</span>
                                        </h4>
                                        <div style="margin-top:-25px ; margin-left:-50px">
                                            Ukuran : {{ $pesanan->keranjang->ukuran }} ,
                                            Jumlah : ({{ $pesanan->keranjang->jumlah }})
                                        </div>
                                        @php
                                            if ($pesanan->transaksi->voucher_id == '') {
                                                $diskon = 0;
                                            } else {
                                                $diskon = ($pesanan->transaksi->voucher->diskon / 100) * $pesanan->keranjang->total_harga;
                                            }
                                            $total_bayar = $pesanan->keranjang->total_harga - $diskon;
                                        @endphp
                                        <div style="margin-top:-20px" class="float-end mx-4">
                                            Rp.{{ number_format($total_bayar, 0, ',', '.') }}
                                        </div>
                                        <div class="mt-3">
                                            @if ($pesanan->status == 'sukses')
                                                <button class="float-end mx-2 button button button-mini inline"
                                                    style="margin-top:-2px" data-bs-toggle="modal"
                                                    data-bs-target="#detailPesanan{{ $pesanan->id }}">Detail
                                                    pesanan</button>
                                                <div class="modal fade modal-lg" id="detailPesanan{{ $pesanan->id }}"
                                                    data-bs-backdrop="static" tabindex="-1" role="dialog"
                                                    aria-labelledby="detail Pesanan" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">
                                                                    {{ $pesanan->transaksi->kode_transaksi }}</h4>
                                                                <button type="button" class="btn-close btn-sm"
                                                                    data-bs-dismiss="modal" aria-hidden="true"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="table-responsive text-nowrap">
                                                                    <table class="table">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <strong>Nama Penerima</strong>
                                                                                </td>
                                                                                <td>{{ $pesanan->transaksi->alamat->nama_lengkap }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <strong>No telepon</strong>
                                                                                </td>
                                                                                <td>{{ $pesanan->transaksi->alamat->no_telepon }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <strong>Provinsi/kota</strong>
                                                                                </td>
                                                                                <td>
                                                                                    {{ $pesanan->transaksi->alamat->provinsi->provinsi }}
                                                                                    /
                                                                                    {{ $pesanan->transaksi->alamat->kota->kota }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <strong>Alamat</strong>
                                                                                </td>
                                                                                <td>
                                                                                    {{ $pesanan->transaksi->alamat->alamat_lengkap }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <strong>Produk</strong>
                                                                                </td>
                                                                                <td>
                                                                                    {{ $pesanan->keranjang->produk->nama_produk }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <strong>Harga Produk</strong>
                                                                                </td>
                                                                                <td>Rp.
                                                                                    {{ number_format($pesanan->keranjang->produk->harga, 0, ',', '.') }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <strong>diskon Produk</strong>
                                                                                </td>
                                                                                <td>
                                                                                    {{ number_format($pesanan->keranjang->produk->diskon, 0, ',', '.') }}%
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <strong>jumlah Produk</strong>
                                                                                </td>
                                                                                <td>{{ number_format($pesanan->keranjang->jumlah, 0, ',', '.') }}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                        <tfoot class="table-border-bottom-0">
                                                                            <tr>
                                                                                <th><strong> Jumlah Total Harga </strong>
                                                                                </th>
                                                                                <th><strong>Rp.
                                                                                        {{ $pesanan->keranjang->total_harga }}
                                                                                    </strong></th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th><strong> Metode Pembayaran </strong>
                                                                                </th>
                                                                                <th><strong>{{ $pesanan->transaksi->metodePembayaran->metodePembayaran }}</strong>
                                                                                </th>
                                                                            </tr>
                                                                        </tfoot>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                    class="button button-teal button-rounded"
                                                                    data-bs-dismiss="modal">Kembali</button>
                                                            </div>
                                                        </div><!-- /.modal-dialog -->
                                                    </div>
                                                </div>
                                                {{-- @php
                                                    $cek_review = App\Models\ReviewProduk;
                                                @endphp --}}
                                                {{-- @if (empty($pesanan->reviewProduk)) --}}
                                                {{-- <button class="float-end button button button-mini" data-bs-toggle="modal"
                                                    data-bs-target="#review{{ $pesanan->id }}"
                                                    style="margin-top:-2px">review</button>
                                                <div class="modal fade modal-lg" id="review{{ $pesanan->id }}"
                                                    data-bs-backdrop="static" tabindex="-1" role="dialog"
                                                    aria-labelledby="review" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form action="/histori/review" method="post">
                                                            @csrf
                                                            <input type="hidden" name="detailTransaksi_id"
                                                                value="{{ $pesanan->id }}">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Review Produk</h4>
                                                                    <button type="button" class="btn-close btn-sm"
                                                                        data-bs-dismiss="modal" aria-hidden="true"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-12 mb-3">
                                                                        <label for="komen">rating
                                                                        </label>
                                                                        <div class="rating-css">
                                                                            <div class="star-icon">
                                                                                <input type="radio" value="1"
                                                                                    name="rating" checked id="rating1">
                                                                                <label for="rating1"
                                                                                    class="icon-star3"></label>
                                                                                <input type="radio" value="2"
                                                                                    name="rating" id="rating2">
                                                                                <label for="rating2"
                                                                                    class="icon-star3"></label>
                                                                                <input type="radio" value="3"
                                                                                    name="rating" id="rating3">
                                                                                <label for="rating3"
                                                                                    class="icon-star3"></label>
                                                                                <input type="radio" value="4"
                                                                                    name="rating" id="rating4">
                                                                                <label for="rating4"
                                                                                    class="icon-star3"></label>
                                                                                <input type="radio" value="5"
                                                                                    name="rating" id="rating5">
                                                                                <label for="rating5"
                                                                                    class="icon-star3"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-3">
                                                                        <label for="komen">komen
                                                                        </label>
                                                                        <textarea class="required form-control" id="komen" name="komen" rows="5" cols="30"
                                                                            placeholder="komen"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="button button-teal button-rounded"
                                                                        data-bs-dismiss="modal">Kembali</button>
                                                                    <button type="submit"
                                                                        class="button button-rounded">kirim</button>
                                                                </div>
                                                            </div><!-- /.modal-content -->
                                                        </form>
                                                    </div><!-- /.modal-dialog -->
                                                </div> --}}
                                                {{-- @endif --}}
                                            @elseif ($pesanan->status == 'pengajuan refund')
                                                <button class="float-end button button-red button-rounded button-mini"
                                                    style="margin-top:-2px">menunggu
                                                    konfirmasi</button>
                                            @elseif ($pesanan->status == 'dikembalikan')
                                                <button class="float-end button button-red button-rounded button-mini"
                                                    style="margin-top:-2px">dikembalikan</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center mt-3">
                        <img src="{{ asset('images/no_produk.png') }}" width="100px" alt="" srcset="">
                        <div class="fw-bold p-4">Belum ada Pesanan</div>
                    </div>
                @endif
            </div>
            <div class="tab-content clearfix" id="tabs-proses">
                @if (count($pesanan_proses))
                    @foreach ($pesanan_proses as $pesanan)
                        <div class="col-lg-12 mb-3">
                            <div class="promo promo-light promo-full">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <img src="{{ asset($pesanan->keranjang->produk->image[0]->gambar_produk) }}"
                                            width="150px" height="140px" alt="" srcset="">
                                    </div>
                                    <div class="col-lg-9">
                                        <h4 class="mt-4" style="margin-left:-50px">
                                            <div class="d-inline">
                                                {{ $pesanan->keranjang->produk->nama_produk }} /
                                                {{ $pesanan->created_at->format('Y-m-d') }}
                                            </div>
                                            <span class="text-danger float-end mx-4">{{ $pesanan->status }}</span>
                                        </h4>
                                        <div style="margin-top:-25px ; margin-left:-50px">
                                            Ukuran : {{ $pesanan->keranjang->ukuran }} ,
                                            Jumlah : ({{ $pesanan->keranjang->jumlah }})
                                        </div>
                                        @php
                                            if ($pesanan->transaksi->voucher_id == '') {
                                                $diskon = 0;
                                            } else {
                                                $diskon = ($pesanan->transaksi->voucher->diskon / 100) * $pesanan->keranjang->total_harga;
                                            }
                                            $total_bayar = $pesanan->keranjang->total_harga - $diskon;
                                        @endphp
                                        <div style="margin-top:-20px" class="float-end mx-4">
                                            Rp.{{ number_format($total_bayar, 0, ',', '.') }}
                                        </div>
                                        <form action="/histori/konfirmasi/{{ $pesanan->id }}" method="post">
                                            @csrf
                                            <div class="mt-3">
                                                <button type="submit"
                                                    class="float-end mx-2 button button-rounded button-blue button-mini inline"
                                                    name="konfirmasi" value="sukses">Selesai</button>
                                                <button type="button"
                                                    class="float-end button button-rounded button-red button-mini"
                                                    name="konfirmasi" value="pengajuan refund" data-bs-toggle="modal"
                                                    data-bs-target="#refund{{ $pesanan->id }}">Refund</button>
                                            </div>
                                        </form>
                                        <div class="modal fade modal-lg" id="refund{{ $pesanan->id }}"
                                            data-bs-backdrop="static" tabindex="-1" role="dialog"
                                            aria-labelledby="refund" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="/histori/refund" method="post">
                                                    <input type="hidden" name="detailTransaksi_id"
                                                        value="{{ $pesanan->id }}">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Refund Produk</h4>
                                                            <button type="button" class="btn-close btn-sm"
                                                                data-bs-dismiss="modal" aria-hidden="true"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @csrf
                                                            <div class="col-12 mb-3">
                                                                <label for="alasan">Alasan
                                                                </label>
                                                                <textarea class="required form-control" id="alasan" name="alasan" rows="5" cols="30"
                                                                    placeholder="Alasan"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button"
                                                                class="button button-dark button-rounded"
                                                                data-bs-dismiss="modal">kembali</button>
                                                            <button type="submit"
                                                                class="button button-rounded">kirim</button>
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
                    <div class="text-center mt-3">
                        <img src="{{ asset('images/no_produk.png') }}" width="100px" alt="" srcset="">
                        <div class="fw-bold p-4">Belum ada Pesanan</div>
                    </div>
                @endif
            </div>
            <div class="tab-content clearfix" id="tabs-selesai">
                @if (count($pesanan_selesai))
                    @foreach ($pesanan_selesai as $pesanan)
                        <div class="col-lg-12 mb-3">
                            <div class="promo promo-light promo-full">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <img src="{{ asset($pesanan->keranjang->produk->image[0]->gambar_produk) }}"
                                            width="150px" height="140px" alt="" srcset="">
                                    </div>
                                    <div class="col-lg-9">
                                        <h4 class="mt-4">
                                            <div class="d-inline" style="margin-left:-50px">
                                                {{ $pesanan->keranjang->produk->nama_produk }}
                                                / {{ $pesanan->created_at->format('Y-m-d') }}
                                            </div>
                                            <span class="text-danger float-end mx-4">{{ $pesanan->status }}</span>
                                        </h4>
                                        <div style="margin-top:-25px ; margin-left:-50px">
                                            Ukuran : {{ $pesanan->keranjang->ukuran }} ,
                                            Jumlah : ({{ $pesanan->keranjang->jumlah }})
                                        </div>
                                        @php
                                            if ($pesanan->transaksi->voucher_id == '') {
                                                $diskon = 0;
                                            } else {
                                                $diskon = ($pesanan->transaksi->voucher->diskon / 100) * $pesanan->keranjang->total_harga;
                                            }
                                            $total_bayar = $pesanan->keranjang->total_harga - $diskon;
                                        @endphp
                                        <div style="margin-top:-20px" class="float-end mx-4">
                                            Rp.{{ number_format($total_bayar, 0, ',', '.') }}
                                        </div>
                                        <div class="mt-3">
                                            @if ($pesanan->status == 'sukses')
                                                <button class="float-end mx-2 button button button-mini inline"
                                                    style="margin-top:-2px" data-bs-toggle="modal"
                                                    data-bs-target="#detailPesananSelesai{{ $pesanan->id }}">Detail
                                                    pesanan</button>
                                                <div class="modal fade modal-lg"
                                                    id="detailPesananSelesai{{ $pesanan->id }}"
                                                    data-bs-backdrop="static" tabindex="-1" role="dialog"
                                                    aria-labelledby="detail Pesanan" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">
                                                                    {{ $pesanan->transaksi->kode_transaksi }}</h4>
                                                                <button type="button" class="btn-close btn-sm"
                                                                    data-bs-dismiss="modal" aria-hidden="true"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="table-responsive text-nowrap">
                                                                    <table class="table">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <strong>Nama Penerima</strong>
                                                                                </td>
                                                                                <td>{{ $pesanan->transaksi->alamat->nama_lengkap }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <strong>No telepon</strong>
                                                                                </td>
                                                                                <td>{{ $pesanan->transaksi->alamat->no_telepon }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <strong>Provinsi/kota</strong>
                                                                                </td>
                                                                                <td>
                                                                                    {{ $pesanan->transaksi->alamat->provinsi->provinsi }}
                                                                                    /
                                                                                    {{ $pesanan->transaksi->alamat->kota->kota }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <strong>Alamat</strong>
                                                                                </td>
                                                                                <td>
                                                                                    {{ $pesanan->transaksi->alamat->alamat_lengkap }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <strong>Produk</strong>
                                                                                </td>
                                                                                <td>
                                                                                    {{ $pesanan->keranjang->produk->nama_produk }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <strong>Harga Produk</strong>
                                                                                </td>
                                                                                <td>Rp.
                                                                                    {{ number_format($pesanan->keranjang->produk->harga, 0, ',', '.') }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <strong>diskon Produk</strong>
                                                                                </td>
                                                                                <td>
                                                                                    {{ number_format($pesanan->keranjang->produk->diskon, 0, ',', '.') }}%
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <strong>jumlah Produk</strong>
                                                                                </td>
                                                                                <td>{{ number_format($pesanan->keranjang->jumlah, 0, ',', '.') }}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                        <tfoot class="table-border-bottom-0">
                                                                            <tr>
                                                                                <th><strong> Jumlah Total Harga </strong>
                                                                                </th>
                                                                                <th><strong>Rp.
                                                                                        {{ $pesanan->keranjang->total_harga }}
                                                                                    </strong></th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th><strong> Metode Pembayaran </strong>
                                                                                </th>
                                                                                <th><strong>{{ $pesanan->transaksi->metodePembayaran->metodePembayaran }}</strong>
                                                                                </th>
                                                                            </tr>
                                                                        </tfoot>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                    class="button button-teal button-rounded"
                                                                    data-bs-dismiss="modal">Kembali</button>
                                                            </div>
                                                        </div><!-- /.modal-dialog -->
                                                    </div>
                                                </div>
                                                <button class="float-end button button-blue button-mini"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#reviewSelesai{{ $pesanan->id }}"
                                                    style="margin-top:-2px">review</button>
                                                <div class="modal fade modal-lg" id="reviewSelesai{{ $pesanan->id }}"
                                                    data-bs-backdrop="static" tabindex="-1" role="dialog"
                                                    aria-labelledby="reviewSelesai" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form action="/histori/review" method="post">
                                                            @csrf
                                                            <input type="hidden" name="detailTransaksi_id"
                                                                value="{{ $pesanan->id }}">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Review Produk</h4>
                                                                    <button type="button" class="btn-close btn-sm"
                                                                        data-bs-dismiss="modal"
                                                                        aria-hidden="true"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-12 mb-3">
                                                                        <label for="komen">rating
                                                                        </label>
                                                                        <div class="rating-css">
                                                                            <div class="star-icon">
                                                                                <input type="radio" value="1"
                                                                                    name="rating" checked id="rating1">
                                                                                <label for="rating1"
                                                                                    class="icon-star3"></label>
                                                                                <input type="radio" value="2"
                                                                                    name="rating" id="rating2">
                                                                                <label for="rating2"
                                                                                    class="icon-star3"></label>
                                                                                <input type="radio" value="3"
                                                                                    name="rating" id="rating3">
                                                                                <label for="rating3"
                                                                                    class="icon-star3"></label>
                                                                                <input type="radio" value="4"
                                                                                    name="rating" id="rating4">
                                                                                <label for="rating4"
                                                                                    class="icon-star3"></label>
                                                                                <input type="radio" value="5"
                                                                                    name="rating" id="rating5">
                                                                                <label for="rating5"
                                                                                    class="icon-star3"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-3">
                                                                        <label for="komen">komen
                                                                        </label>
                                                                        <textarea class="required form-control" id="komen" name="komen" rows="5" cols="30"
                                                                            placeholder="komen"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="button button-teal button-rounded"
                                                                        data-bs-dismiss="modal">Kembali</button>
                                                                    <button type="submit"
                                                                        class="button button-rounded">kirim</button>
                                                                </div>
                                                            </div><!-- /.modal-content -->
                                                        </form>
                                                    </div><!-- /.modal-dialog -->
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center mt-3">
                        <img src="{{ asset('images/no_produk.png') }}" width="100px" alt="" srcset="">
                        <div class="fw-bold p-4">Belum ada Pesanan</div>
                    </div>
                @endif
            </div>
            <div class="tab-content clearfix" id="tabs-pengajuan_refund">
                @if (count($pesanan_pengajuan_refund))
                    @foreach ($pesanan_pengajuan_refund as $pesanan)
                        <div class="col-lg-12 mb-3">
                            <div class="promo promo-light promo-full">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <img src="{{ asset($pesanan->keranjang->produk->image[0]->gambar_produk) }}"
                                            width="150px" height="140px" alt="" srcset="">
                                    </div>
                                    <div class="col-lg-9">
                                        <h4 class="mt-4">
                                            <div class="d-inline" style="margin-left:-50px">
                                                {{ $pesanan->keranjang->produk->nama_produk }}
                                                / {{ $pesanan->created_at->format('Y-m-d') }}
                                            </div>
                                            <span class="text-danger float-end mx-4">{{ $pesanan->status }}</span>
                                        </h4>
                                        <div style="margin-top:-25px ; margin-left:-50px">
                                            Ukuran : {{ $pesanan->keranjang->ukuran }} ,
                                            Jumlah : ({{ $pesanan->keranjang->jumlah }})
                                        </div>
                                        @php
                                            if ($pesanan->transaksi->voucher_id == '') {
                                                $diskon = 0;
                                            } else {
                                                $diskon = ($pesanan->transaksi->voucher->diskon / 100) * $pesanan->keranjang->total_harga;
                                            }
                                            $total_bayar = $pesanan->keranjang->total_harga - $diskon;
                                        @endphp
                                        <div style="margin-top:-20px" class="float-end mx-4">
                                            Rp.{{ number_format($total_bayar, 0, ',', '.') }}
                                        </div>
                                        <div class="mt-3">
                                            <button class="float-end mx-2 button button-red button-mini inline"
                                                style="margin-top:-2px">Menunggu konfirmasi</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center mt-3">
                        <img src="{{ asset('images/no_produk.png') }}" width="100px" alt="" srcset="">
                        <div class="fw-bold p-4">Belum ada Pesanan</div>
                    </div>
                @endif
            </div>
            <div class="tab-content clearfix" id="tabs-dikembalikan">
                @if (count($pesanan_dikembalikan))
                    @foreach ($pesanan_dikembalikan as $pesanan)
                        <div class="col-lg-12 mb-3">
                            <div class="promo promo-light promo-full">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <img src="{{ asset($pesanan->keranjang->produk->image[0]->gambar_produk) }}"
                                            width="150px" height="140px" alt="" srcset="">
                                    </div>
                                    <div class="col-lg-9">
                                        <h4 class="mt-4">
                                            <div class="d-inline" style="margin-left:-50px">
                                                {{ $pesanan->keranjang->produk->nama_produk }}
                                                / {{ $pesanan->created_at->format('Y-m-d') }}
                                            </div>
                                            <span class="text-danger float-end mx-4">{{ $pesanan->status }}</span>
                                        </h4>
                                        <div style="margin-top:-25px ; margin-left:-50px">
                                            Ukuran : {{ $pesanan->keranjang->ukuran }} ,
                                            Jumlah : ({{ $pesanan->keranjang->jumlah }})
                                        </div>
                                        @php
                                            if ($pesanan->transaksi->voucher_id == '') {
                                                $diskon = 0;
                                            } else {
                                                $diskon = ($pesanan->transaksi->voucher->diskon / 100) * $pesanan->keranjang->total_harga;
                                            }
                                            $total_bayar = $pesanan->keranjang->total_harga - $diskon;
                                        @endphp
                                        <div style="margin-top:-20px" class="float-end mx-4">
                                            Rp.{{ number_format($total_bayar, 0, ',', '.') }}
                                        </div>
                                        <div class="mt-3">
                                            <button class="float-end mx-2 button button-red button-mini inline"
                                                style="margin-top:-2px">Menunggu konfirmasi</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center mt-3">
                        <img src="{{ asset('images/no_produk.png') }}" width="100px" alt="" srcset="">
                        <div class="fw-bold p-4">Belum ada Pesanan</div>
                    </div>
                @endif
            </div>

        </div>

    </div>
@endsection
