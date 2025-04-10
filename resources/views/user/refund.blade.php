@extends('user.layouts.users')

@section('content')
<section class="spad">
    @if (count($refunds))
    <div class="row">
        <div class="container">
            <h3 class="related-title">Pengajuan refund</h3>
            @foreach ($refunds as $refund)
            <div class="card">
                <div class="row">
                    <div class="col">
                        <div class="testimonial__text">
                            <div class="testimonial__author">
                                <div class="testimonial__author__pic">
                                    <img src="{{ asset($refund->keranjang->produk->image[0]->gambar_produk) }}" alt="">
                                </div>
                                <div class="testimonial__author__text">
                                    <h5>{{ $refund->transaksi->kode_transaksi }}</h5>
                                    <p class="text-break">{{ $refund->keranjang->produk->nama_produk }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col mt-5">
                        <a href="" class="btn btn-primary mx-2">selesai</a>
                        <a href="" class="btn btn-danger">refund</a>
                    </div> --}}
                </div>
            </div>
            @endforeach
        </div>
        <div class="container">
            {{-- {{ $refunds->links() }} --}}
        </div>
    </div>
    @else
    <div class="alert alert-dark" role="alert">
        Data Kosong
    </div>
    @endif
</section>
@endsection
