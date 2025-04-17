@extends('user.layouts.users')

@section('content')
    <div class="container clearfix">
        <div class="single-product">
            <div class="product">
                <div class="row gutter-40">
                    <div class="col-md-4">
                        <!-- Product Single - Gallery ============================================= -->
                        <div class="product-image">
                            <div class="fslider" data-pagi="false" data-arrows="false" data-thumbs="true">
                                <div class="flexslider">
                                    <div class="slider-wrap" data-lightbox="gallery">
                                        @foreach ($images as $image)
                                            <div class="slide" data-thumb="{{ asset("images/gambar_produk/" . $image->gambar_produk) }}"><a
                                                    href="{{ asset("images/gambar_produk/" . $image->gambar_produk) }}" title="{{ $produks->name }}"
                                                    data-lightbox="gallery-item"><img
                                                        src="{{ asset("images/gambar_produk/" . $image->gambar_produk) }}"
                                                        alt="{{ $produks->name }}"></a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @if ($produks->diskon > 0)
                                <div class="sale-flash badge bg-secondary p-2">{{ $produks->diskon }}%</div>
                            @endif
                        </div><!-- Product Single - Gallery End -->
                    </div>
                    <div class="col-md-5 product-desc">

                        <div class="row">
                            <div class="col">
                                <h3>{{ $produks->nama_produk }}</h3>
                            </div>
                            <div class="col float-end">
                                <span class="mx-2 float-end">terjual | <strong>{{ $produks_terjual }}</strong></span>
                                <span class="float-end">ulasan |
                                    <strong>{{ $produks->reviewProduk->count() }}</strong></span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <!-- Product Single - Price                           ============================================= -->
                            @if ($produks->diskon > 0)
                                @php
                                    $diskon = ($produks->diskon / 100) * $produks->harga;
                                    $harga = $produks->harga - $diskon;
                                @endphp
                                <div class="product-price"><del>Rp. {{ number_format($produks->harga, 0, ',', '.') }}</del>
                                    <ins class="text-dark">Rp. {{ number_format($harga, 0, ',', '.') }}</ins>
                                </div>
                            @else
                                <div class="product-price text-dark">Rp. {{ number_format($produks->harga, 0, ',', '.') }}
                                </div>
                            @endif
                            <!-- Product Single - Price End -->

                            <!-- Product Single - Rating
                                                                                                                            ============================================= -->
                            @php
                                if ($jumlah_rating > 0) {
                                    $rating = number_format($produks->reviewProduk->sum('rating'));
                                    $total = $rating / $jumlah_rating;
                                } else {
                                    $total = 0;
                                }
                            @endphp
                            <div class="product-rating">
                                @for ($i = 1; $i <= $total; $i++)
                                    <i class="icon-star3 icon-lg" style="color: yellow">
                                    </i>
                                @endfor
                                @for ($j = $total + 1; $j <= 5; $j++)
                                    <i class="icon-star3"></i>
                                @endfor
                            </div>

                        </div>

                        <div class="line"></div>

                        <!-- Product Single - Short Description
                                                                                                                            ============================================= -->
                        <p>{!! $produks->deskripsi !!}</p>
                        <div class="line"></div>
                        <ul class="iconlist">
                            <li><i class="icon-caret-right"></i>Ukuran :
                                @foreach ($produks->ukuranProduk as $ukuranProduk)
                                    <span class="badge bg-secondary mx-1">{{ $ukuranProduk->ukuran->ukuran }}</span>
                                @endforeach
                            </li>
                            <li><i class="icon-caret-right"></i>Stok : {{ $produks->stok }}</li>
                            <li><i class="icon-caret-right"></i>kategori : <a
                                    href="/produk?kategori={{ $produks->kategori_id }}"
                                    class="mx-1">{{ $produks->kategori->name }}</a> ,
                                <a href="/produk/{{ $produks->kategori->name }}?subKategori={{ $produks->sub_kategori_id }}"
                                    class="mx-1">{{ $produks->subKategori->name }}</a>
                            </li>
                        </ul><!-- Product Single - Short Description End -->
                        <div class="line"></div>

                        <!-- Product Single - Quantity & Cart Button ============================================= -->
                        <form id="tambahKeranjang" action="{{ route('keranjang.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="produk_id" value="{{ $produks->id }}">
                            <div role="group">
                                @foreach ($produks->ukuranProduk as $ukuranProduk)
                                    <input class="btn-check" type="radio" name="ukuran" id="{{ $ukuranProduk->id }}"
                                        value="{{ $ukuranProduk->ukuran->ukuran }}">
                                    <label for="{{ $ukuranProduk->id }}"
                                        class="btn btn-sm btn-outline-secondary fw-normal ls0 nott">{{ $ukuranProduk->ukuran->ukuran }}</label>
                                @endforeach
                            </div>

                            <div class="quantity clearfix">
                                <input type="button" value="-" class="minus">
                                <input type="number" readonly step="1" min="1" max="{{ $produks->stok }}"
                                    name="jumlah" value="1" title="Qty" class="qty" />
                                <input type="button" value="+" class="plus">
                            </div>
                            @auth
                                <a onclick="event.preventDefault(); document.getElementById('tambahKeranjang').submit();"
                                    class="add-to-cart button m-0 float-end">Masukan keranjang</a>
                            @endauth
                            @guest()
                                <a id="auth" class="add-to-cart button m-0 float-end">Masukan keranjang</a>
                            @endguest
                        </form>
                    </div>


                    <div class="col-md-3">

                        <div class="widget clearfix">

                            <h4>Produk Lainnya</h4>
                            <div class="posts-sm row col-mb-30" id="recent-shop-list-sidebar">
                                @foreach ($produk_lainnya as $produk)
                                    <div class="entry col-12">
                                        <div class="grid-inner row g-0">
                                            <div class="col-auto mx-2">
                                                <div class="entry-image">
                                                    <a href="#"><img
                                                            src="{{ asset("images/gambar_produk/" . $produk->image[0]->gambar_produk) }}"
                                                            alt="Image"></a>
                                                </div>
                                            </div>
                                            <div class="col ps-12">
                                                <div class="entry-title">
                                                    <h4><a href="#">{{ $produk->nama_produk }}</a></h4>
                                                </div>
                                                <div class="entry-meta no-separator">
                                                    <ul>
                                                        @if ($produk->diskon > 0)
                                                            @php
                                                                $diskon = ($produk->diskon / 100) * $produk->harga;
                                                                $harga = $produk->harga - $diskon;
                                                            @endphp
                                                            <li class="text-secondary"><del>Rp.
                                                                    {{ number_format($produk->harga, 0, ',', '.') }}
                                                                </del> <ins class="text-dark"> Rp.
                                                                    {{ number_format($harga, 0, ',', '.') }}</ins></li>
                                                        @else
                                                            <li class="text-dark">Rp.
                                                                {{ number_format($produk->harga, 0, ',', '.') }}</li>
                                                        @endif
                                                        @php
                                                            $jumlah_rating = $produk->reviewProduk->count();
                                                            if ($jumlah_rating > 0) {
                                                                $rating = number_format(
                                                                    $produk->reviewProduk->sum('rating'),
                                                                );
                                                                $total = $rating / $jumlah_rating;
                                                            } else {
                                                                $total = 0;
                                                            }
                                                        @endphp
                                                        <li>
                                                            <div class="product-rating">
                                                                @for ($i = 1; $i <= $total; $i++)
                                                                    <i class="icon-star3" style="color: yellow"></i>
                                                                @endfor
                                                                @for ($j = $total + 1; $j <= 5; $j++)
                                                                    <i class="icon-star3">
                                                                    </i>
                                                                @endfor
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                    </div>

                    <div class="w-100"></div>

                    <div class="col-12 mt-5">
                        <h3>Penilaian Produk</h3>

                        <div class="tabs tabs-bb clearfix">

                            <ul class="tab-nav clearfix">
                                <li><a href="#all">Semua ({{ $allReview_produks->count() }})</a></li>
                                <li><a href="#bintang5">5 bintang ({{ $review_produks5->count() }})</a></li>
                                <li><a href="#bintang4">4 bintang ({{ $review_produks4->count() }})</a></li>
                                <li><a href="#bintang3">3 bintang ({{ $review_produks3->count() }})</a></li>
                                <li><a href="#bintang2">2 bintang ({{ $review_produks2->count() }})</a></li>
                                <li><a href="#bintang1">1 bintang ({{ $review_produks1->count() }})</a></li>
                            </ul>

                            <div class="tab-container">

                                <div class="tab-content clearfix" id="all">
                                    <div id="reviews" class="clearfix">
                                        @if (count($allReview_produks))
                                            <ol class="commentlist clearfix my-3">
                                                @foreach ($allReview_produks as $review_produk)
                                                    <li class="comment even thread-even depth-1" id="li-comment-1">
                                                        <div id="comment-1" class="comment-wrap clearfix">
                                                            <div class="comment-meta">
                                                                <div class="comment-author vcard">
                                                                    <span class="comment-avatar clearfix">
                                                                        <img alt='Image'
                                                                            src="{{ asset($review_produk->user->profile) }}"
                                                                            height='60' width='60' /></span>
                                                                </div>
                                                            </div>

                                                            <div class="comment-content clearfix">
                                                                <div class="comment-author">
                                                                    {{ $review_produk->user->name }}<span>{{ $review_produk->created_at }}</span>
                                                                </div>
                                                                <p>{{ $review_produk->komen }}</p>
                                                                @php
                                                                    if ($review_produk->rating > 0) {
                                                                        $totalRating = $review_produk->rating;
                                                                    } else {
                                                                        $totalRating = 0;
                                                                    }
                                                                @endphp
                                                                <div class="review-comment-ratings">
                                                                    @for ($i = 1; $i <= $totalRating; $i++)
                                                                        <i class="icon-star3 icon-lg"
                                                                            style="color: yellow">
                                                                        </i>
                                                                    @endfor
                                                                    @for ($j = $totalRating + 1; $j <= 5; $j++)
                                                                        <i class="icon-star3 icon-lg">
                                                                        </i>
                                                                    @endfor
                                                                </div>
                                                            </div>

                                                            <div class="clear"></div>

                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ol>
                                            {{ $allReview_produks->links() }}
                                        @else
                                            <div class="text-center my-6">
                                                <img src="{{ asset('images/no_review.png') }}" width="100px"
                                                    alt="" srcset="">
                                                <div class="fw-bold p-4">Belum ada penilaian</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-content clearfix" id="bintang5">
                                    <div id="reviews" class="clearfix">

                                        @if (count($review_produks5))
                                            <ol class="commentlist clearfix my-3">
                                                @foreach ($review_produks5 as $review_produk)
                                                    <li class="comment even thread-even depth-1" id="li-comment-1">
                                                        <div id="comment-1" class="comment-wrap clearfix">
                                                            <div class="comment-meta">
                                                                <div class="comment-author vcard">
                                                                    <span class="comment-avatar clearfix">
                                                                        <img alt='Image'
                                                                            src="{{ asset($review_produk->user->profile) }}"
                                                                            height='60' width='60' /></span>
                                                                </div>
                                                            </div>

                                                            <div class="comment-content clearfix">
                                                                <div class="comment-author">
                                                                    {{ $review_produk->user->name }}<span>{{ $review_produk->created_at }}</span>
                                                                </div>
                                                                <p>{{ $review_produk->komen }}</p>
                                                                @php
                                                                    if ($review_produk->rating > 0) {
                                                                        $totalRating = $review_produk->rating;
                                                                    } else {
                                                                        $totalRating = 0;
                                                                    }
                                                                @endphp
                                                                <div class="review-comment-ratings">
                                                                    @for ($i = 1; $i <= $totalRating; $i++)
                                                                        <i class="icon-star3 icon-lg"
                                                                            style="color: yellow">
                                                                        </i>
                                                                    @endfor
                                                                    @for ($j = $totalRating + 1; $j <= 5; $j++)
                                                                        <i class="icon-star3 icon-lg">
                                                                        </i>
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                            <div class="clear"></div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ol>
                                            {{ $review_produks5->links() }}
                                        @else
                                            <div class="text-center my-6">
                                                <img src="{{ asset('images/no_review.png') }}" width="100px"
                                                    alt="" srcset="">
                                                <div class="fw-bold p-4">Belum ada penilaian</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-content clearfix" id="bintang4">
                                    <div id="reviews" class="clearfix">
                                        @if (count($review_produks4))
                                            <ol class="commentlist clearfix my-3">
                                                @foreach ($review_produks4 as $review_produk)
                                                    <li class="comment even thread-even depth-1" id="li-comment-1">
                                                        <div id="comment-1" class="comment-wrap clearfix">
                                                            <div class="comment-meta">
                                                                <div class="comment-author vcard">
                                                                    <span class="comment-avatar clearfix">
                                                                        <img alt='Image'
                                                                            src="{{ asset($review_produk->user->profile) }}"
                                                                            height='60' width='60' /></span>
                                                                </div>
                                                            </div>

                                                            <div class="comment-content clearfix">
                                                                <div class="comment-author">
                                                                    {{ $review_produk->user->name }}<span>{{ $review_produk->created_at }}</span>
                                                                </div>
                                                                <p>{{ $review_produk->komen }}</p>
                                                                @php
                                                                    if ($review_produk->rating > 0) {
                                                                        $totalRating = $review_produk->rating;
                                                                    } else {
                                                                        $totalRating = 0;
                                                                    }
                                                                @endphp
                                                                <div class="review-comment-ratings">
                                                                    @for ($i = 1; $i <= $totalRating; $i++)
                                                                        <i class="icon-star3 icon-lg"
                                                                            style="color: yellow">
                                                                        </i>
                                                                    @endfor
                                                                    @for ($j = $totalRating + 1; $j <= 5; $j++)
                                                                        <i class="icon-star3 icon-lg">
                                                                        </i>
                                                                    @endfor
                                                                </div>
                                                            </div>

                                                            <div class="clear"></div>

                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ol>
                                            {{ $review_produks4->links() }}
                                        @else
                                            <div class="text-center my-6">
                                                <img src="{{ asset('images/no_review.png') }}" width="100px"
                                                    alt="" srcset="">
                                                <div class="fw-bold p-4">Belum ada penilaian</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-content clearfix" id="bintang3">
                                    <div id="reviews" class="clearfix">
                                        @if (count($review_produks3))
                                            <ol class="commentlist clearfix my-3">
                                                @foreach ($review_produks3 as $review_produk)
                                                    <li class="comment even thread-even depth-1" id="li-comment-1">
                                                        <div id="comment-1" class="comment-wrap clearfix">
                                                            <div class="comment-meta">
                                                                <div class="comment-author vcard">
                                                                    <span class="comment-avatar clearfix">
                                                                        <img alt='Image'
                                                                            src="{{ asset($review_produk->user->profile) }}"
                                                                            height='60' width='60' /></span>
                                                                </div>
                                                            </div>

                                                            <div class="comment-content clearfix">
                                                                <div class="comment-author">
                                                                    {{ $review_produk->user->name }}<span>{{ $review_produk->created_at }}</span>
                                                                </div>
                                                                <p>{{ $review_produk->komen }}</p>
                                                                @php
                                                                    if ($review_produk->rating > 0) {
                                                                        $totalRating = $review_produk->rating;
                                                                    } else {
                                                                        $totalRating = 0;
                                                                    }
                                                                @endphp
                                                                <div class="review-comment-ratings">
                                                                    @for ($i = 1; $i <= $totalRating; $i++)
                                                                        <i class="icon-star3 icon-lg"
                                                                            style="color: yellow">
                                                                        </i>
                                                                    @endfor
                                                                    @for ($j = $totalRating + 1; $j <= 5; $j++)
                                                                        <i class="icon-star3 icon-lg">
                                                                        </i>
                                                                    @endfor
                                                                </div>
                                                            </div>

                                                            <div class="clear"></div>

                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ol>
                                            {{ $review_produks3->links() }}
                                        @else
                                            <div class="text-center my-6">
                                                <img src="{{ asset('images/no_review.png') }}" width="100px"
                                                    alt="" srcset="">
                                                <div class="fw-bold p-4">Belum ada penilaian</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-content clearfix" id="bintang2">
                                    <div id="reviews" class="clearfix">
                                        @if (count($review_produks2))
                                            <ol class="commentlist clearfix my-3">
                                                @foreach ($review_produks2 as $review_produk)
                                                    <li class="comment even thread-even depth-1" id="li-comment-1">
                                                        <div id="comment-1" class="comment-wrap clearfix">
                                                            <div class="comment-meta">
                                                                <div class="comment-author vcard">
                                                                    <span class="comment-avatar clearfix">
                                                                        <img alt='Image'
                                                                            src="{{ asset($review_produk->user->profile) }}"
                                                                            height='60' width='60' /></span>
                                                                </div>
                                                            </div>

                                                            <div class="comment-content clearfix">
                                                                <div class="comment-author">
                                                                    {{ $review_produk->user->name }}<span>{{ $review_produk->created_at }}</span>
                                                                </div>
                                                                <p>{{ $review_produk->komen }}</p>
                                                                @php
                                                                    if ($review_produk->rating > 0) {
                                                                        $totalRating = $review_produk->rating;
                                                                    } else {
                                                                        $totalRating = 0;
                                                                    }
                                                                @endphp
                                                                <div class="review-comment-ratings">
                                                                    @for ($i = 1; $i <= $totalRating; $i++)
                                                                        <i class="icon-star3 icon-lg"
                                                                            style="color: yellow">
                                                                        </i>
                                                                    @endfor
                                                                    @for ($j = $totalRating + 1; $j <= 5; $j++)
                                                                        <i class="icon-star3 icon-lg">
                                                                        </i>
                                                                    @endfor
                                                                </div>
                                                            </div>

                                                            <div class="clear"></div>

                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ol>
                                            {{ $review_produks2->links() }}
                                        @else
                                            <div class="text-center my-6">
                                                <img src="{{ asset('images/no_review.png') }}" width="100px"
                                                    alt="" srcset="">
                                                <div class="fw-bold p-4">Belum ada penilaian</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-content clearfix" id="bintang1">
                                    <div id="reviews" class="clearfix">
                                        @if (count($review_produks1))
                                            <ol class="commentlist clearfix my-3">
                                                @foreach ($review_produks1 as $review_produk)
                                                    <li class="comment even thread-even depth-1" id="li-comment-1">
                                                        <div id="comment-1" class="comment-wrap clearfix">
                                                            <div class="comment-meta">
                                                                <div class="comment-author vcard">
                                                                    <span class="comment-avatar clearfix">
                                                                        <img alt='Image'
                                                                            src="{{ asset($review_produk->user->profile) }}"
                                                                            height='60' width='60' /></span>
                                                                </div>
                                                            </div>

                                                            <div class="comment-content clearfix">
                                                                <div class="comment-author">
                                                                    {{ $review_produk->user->name }}<span>{{ $review_produk->created_at }}</span>
                                                                </div>
                                                                <p>{{ $review_produk->komen }}</p>
                                                                @php
                                                                    if ($review_produk->rating > 0) {
                                                                        $totalRating = $review_produk->rating;
                                                                    } else {
                                                                        $totalRating = 0;
                                                                    }
                                                                @endphp
                                                                <div class="review-comment-ratings">
                                                                    @for ($i = 1; $i <= $totalRating; $i++)
                                                                        <i class="icon-star3 icon-lg"
                                                                            style="color: yellow">
                                                                        </i>
                                                                    @endfor
                                                                    @for ($j = $totalRating + 1; $j <= 5; $j++)
                                                                        <i class="icon-star3 icon-lg">
                                                                        </i>
                                                                    @endfor
                                                                </div>
                                                            </div>

                                                            <div class="clear"></div>

                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ol>
                                            {{ $review_produks1->links() }}
                                        @else
                                            <div class="text-center my-6">
                                                <img src="{{ asset('images/no_review.png') }}" width="100px"
                                                    alt="" srcset="">
                                                <div class="fw-bold p-4">Belum ada penilaian</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- EndCanvas --}}
@endsection
