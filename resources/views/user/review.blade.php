@extends('user.layouts.users')

@section('content')
    <section class="spad">
        @if (count($review_produks))
            <div class="row">
                <div class="container-fluid">
                    <h3 class="related-title">Semua Ulasan</h3>
                    @foreach ($review_produks as $review_produk)
                        <div class="col-lg-9 p-0">
                            <div class="testimonial__text">
                                <div class="testimonial__author">
                                    <div class="testimonial__author__pic">
                                        <img src="{{ asset($review_produk->user->profile) }}" alt="">
                                    </div>
                                    <div class="testimonial__author__text">
                                        <h5>{{ $review_produk->user->name }}</h5>
                                        <p class="text-break">{{ $review_produk->komen }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="container">
                    {{ $review_produks->links() }}
                </div>
            </div>
        @endif
    </section>
@endsection
