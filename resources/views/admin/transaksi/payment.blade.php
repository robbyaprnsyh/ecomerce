@extends('admin.layouts.admin') 

@section('content')
<div class="container text-center py-5">
    <h2>Proses Pembayaran</h2>
    <p>Silakan klik tombol di bawah untuk menyelesaikan pembayaran Anda.</p>

    <button id="pay-button" class="btn btn-primary mt-3">Bayar Sekarang</button>
</div>

{{-- Midtrans Snap JS --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<script type="text/javascript">
    document.getElementById('pay-button').addEventListener('click', function () {
        window.snap.pay("{{ $snapToken }}", {
            onSuccess: function (result) {
                alert("Pembayaran berhasil!");
                window.location.href = "{{ route('transaksi.index') }}";
            },
            onPending: function (result) {
                alert("Menunggu pembayaran...");
                window.location.href = "{{ route('transaksi.index') }}";
            },
            onError: function (result) {
                alert("Pembayaran gagal. Silakan coba lagi.");
                console.error(result);
            },
            onClose: function () {
                alert('Pembayaran dibatalkan.');
            }
        });
    });
</script>
@endsection
