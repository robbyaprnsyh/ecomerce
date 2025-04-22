@extends('user.layouts.users')

@section('content')
    <div class="container-fluid p-4 min-vh-100">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <h3 class="mb-4">🧾 Detail Pesanan</h3>
                <div class="mb-3">
                    <strong>Kode Transaksi:</strong> {{ $transaksi->kode_transaksi }}
                </div>
                <div class="mb-4">
                    <strong>Alamat Pengiriman:</strong><br>
                    {{ $alamat->alamat_lengkap }}
                </div>
                <hr>
                <h4 class="mb-3">📦 Produk yang Dipesan:</h4>
                <div class="row g-3">
                    @foreach ($detailTransaksis as $detail)
                        <div class="col-md-12">
                            <div class="card shadow-sm border-0 ">
                                <div class="row g-0">
                                    <div class="col-md-2 d-flex align-items-center justify-content-center">
                                        <img src="{{ asset('images/gambar_produk/' . $detail->keranjang->produk->image[0]->gambar_produk) }}"
                                            class="img-fluid rounded-start p-2"
                                            style="max-height: 100px; object-fit: cover;"
                                            alt="Foto {{ $detail->keranjang->produk->nama_produk }}">
                                    </div>
                                    <div class="col-md-10">
                                        <div class="card-body py-2">
                                            <h5 class="card-title mb-1">{{ $detail->keranjang->produk->nama_produk }}</h5>
                                            <p class="card-text mb-0">
                                                Ukuran: {{ $detail->keranjang->ukuran }}<br>
                                                Jumlah: {{ $detail->keranjang->jumlah }}<br>
                                                Total: <strong>Rp.
                                                    {{ number_format($detail->keranjang->total_harga, 0, ',', '.') }}</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr class="mt-4">
                <div class="mb-2">
                    <strong>Diskon:</strong> {{ $diskon }}%
                </div>
                <div class="mb-4">
                    <strong>Total Bayar:</strong>
                    <span class="fs-5 text-success">Rp. {{ number_format($total_harga, 0, ',', '.') }}</span>
                </div>
                <button id="pay-button" class="button button-3d rounded-pill">Bayar Sekarang</button>
            </div>
        </div>
    </div>

    {{-- Midtrans --}}
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script>
        document.getElementById('pay-button').addEventListener('click', function() {
            fetch('/snap/token/{{ $transaksi->id }}')
                .then(response => response.json())
                .then(data => {
                    snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            window.location.href = '/profil/pesanan';
                        },
                        onPending: function(result) {
                            alert("Menunggu pembayaran selesai.");
                        },
                        onError: function(result) {
                            alert("Pembayaran gagal.");
                        },
                        onClose: function() {
                            alert("Kamu menutup popup tanpa menyelesaikan pembayaran.");
                        }
                    });
                });
        });
    </script>
@endsection
