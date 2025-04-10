@extends('user.layouts.users')

@section('content')
<section class="spad">
    @if (count($voucherUsers))
    <div class="row">
        <div class="container">
            <h3 class="related-title">voucher saya</h3>
            @foreach ($voucherUsers as $voucherUser)
            <div class="card">
                <div class="row">
                    <div class="col">
                        <div class="testimonial__text">
                            <div class="testimonial__author">
                                <div class="testimonial__author__pic">
                                    <img src="{{ asset('images/gambar_produk/5615rahara2.jpg') }}" alt="">
                                </div>
                                <div class="testimonial__author__text">
                                    <h5>{{ $voucherUser->voucher->kode_voucher }}</h5>
                                    <p class="text-break">{{ $voucherUser->voucher->kode_voucher }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="container">
            {{-- {{ $voucherUsers->links() }} --}}
        </div>
    </div>
    @endif
</section>
@endsection