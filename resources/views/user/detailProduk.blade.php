@extends('user.layouts.users')

@section('content')
    {{-- Male --}}
    <!-- Shop Details Section Begin -->
    {{-- <section class="shop-details">
    <div class="product__details__pic">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="product__details__breadcrumb">
                        <a href="/">Home</a>
                        <a href="/produk">produk</a>
                        <span>Detail Produk</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2">
                    <ul class="nav nav-tabs" style="max-height:400px; width:140px; overflow:auto" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs{{ $images[0]->id }}" role="tab">
                                <div class="product__thumb__pic set-bg"
                                    data-setbg="{{ asset($images[0]->gambar_produk) }}">
                                </div>
                            </a>
                        </li>
                        @foreach ($images->skip(1) as $image)
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs{{ $image->id }}" role="tab">
                                <div class="product__thumb__pic set-bg" data-setbg="{{ asset($image->gambar_produk) }}">
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-4 col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs{{ $images[0]->id }}" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="{{ asset($images[0]->gambar_produk) }}" alt="">
                            </div>
                        </div>
                        @foreach ($images->skip(1) as $image)
                        <div class="tab-pane" id="tabs{{ $image->id }}" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="{{ asset($image->gambar_produk) }}" alt="">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product__details__content">
                        <div class="container-fluid">
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-10 card w-100 p-5 rounded shadow">
                                    <div class="product__details__text">
                                        <h4>{{ $produks->nama_produk }}</h4>
                                        @if ($produks->diskon > 0)
                                        @php
                                        $diskon = ($produks->diskon / 100) * $produks->harga;
                                        $harga = $produks->harga - $diskon;
                                        @endphp
                                        <h3>Rp.{{ number_format($harga, 0, ',', '.') }}<span>{{
                                                number_format($produks->harga, 0, ',', '.') }}</span>
                                        </h3>
                                        @else
                                        <h3>Rp.{{ number_format($produks->harga, 0, ',', '.') }}</h3>
                                        @endif
                                        <p style="text-align: justify; max-height:400px; overflow:auto">
                                            {!! $produks->deskripsi !!}</p>
                                        <form id="tambahKeranjang" action="{{ route('keranjang.store') }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="produk_id" value="{{ $produks->id }}">
                                            <div class="product__details__option">
                                                <div class="product__details__option__size">
                                                    <span>Size:</span>
                                                    <label for="xl">xl
                                                        <input type="radio" name="ukuran" value="xl">
                                                    </label>
                                                    <label for="l">l
                                                        <input type="radio" name="ukuran" value="l">
                                                    </label>
                                                    <label for="m">M
                                                        <input type="radio" name="ukuran" value="m">
                                                    </label>
                                                    <label for="sm">s
                                                        <input type="radio" name="ukuran" value="s">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="product__details__cart__option">
                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <input type="number" name="jumlah" min="1"
                                                            max="{{ $produks->stok }}" value="1">
                                                    </div>
                                                </div>
                                                <div class="primary-btn">
                                                    <a onclick="event.preventDefault();
                                                        document.getElementById('tambahKeranjang').submit();">
                                                        add to cart
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (count($review_produks))
    <div class="row">
        <div class="container-fluid">
            <h3 class="related-title">Ulasan</h3>
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
            <div class="text-center">
                <a href="/ulasan/{{ $produks->id }}" class="primary-btn">Semua Ulasan</a>
            </div>
        </div>
    </div>
    @endif
</section> --}}
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    {{-- <section class="related spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="related-title">Produk Lainnya</h3>
            </div>
        </div>
        <div class="row">
            @foreach ($produk_lainnya as $produk)
            <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                <div class="product__item sale">
                    <div class="product__item__pic set-bg" data-setbg="{{ asset($produk->image[0]->gambar_produk) }}">
                        @if ($produk->diskon > 0)
                        <span class="label">{{ $produk->diskon }}%</span>
                        @endif
                        <ul class="product__hover">
                            <li><a href="#"><img src="{{ asset('assets2/img/icon/heart.png') }}" alt=""></a></li>
                            <li><a href="/produk/{{ $produk->id }}"><img
                                        src="{{ asset('assets2/img/icon/search.png') }}" alt=""></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6>Piqué Biker Jacket</h6>
                        @if ($produk->diskon > 0)
                        @php
                        $diskon = ($produk->diskon / 100) * $produk->harga;
                        $harga = $produk->harga - $diskon;
                        @endphp
                        <p>Rp.
                            {{ number_format($harga, 0, ',', '.') }}<span class="diskon">{{
                                number_format($produk->harga, 0, ',', '.') }}</span>
                        </p>
                        @else
                        <p>Rp. {{ number_format($produk->harga, 0, ',', '.') }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section> --}}
    <!-- Related Section End -->
    {{-- EndMale --}}

    {{-- Canvas --}}

    {{-- <div class="container clearfix">

    <div class="single-product">
        <div class="product">
            <div class="row gutter-40">

                <div class="col-md-4">

                    <!-- Product Single - Gallery
									============================================= -->
                    <div class="product-image">
                        <div class="fslider" data-pagi="false" data-arrows="false" data-thumbs="true">
                            <div class="flexslider">
                                <div class="slider-wrap" data-lightbox="gallery">
                                    @foreach ($images as $image)
                                    <div class="slide" data-thumb="{{asset($image->gambar_produk)}}"><img
                                            src="{{asset($image->gambar_produk)}}" alt="Pink Printed Dress"></a>
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

                    <div class="d-flex align-items-center justify-content-between">

                        <!-- Product Single - Price
										============================================= -->
                        <div class="product-price"><del>$39.99</del> <ins>$24.99</ins></div>
                        <!-- Product Single - Price End -->

                        <!-- Product Single - Rating
										============================================= -->
                        <div class="product-rating">
                            <i class="icon-star3"></i>
                            <i class="icon-star3"></i>
                            <i class="icon-star3"></i>
                            <i class="icon-star-half-full"></i>
                            <i class="icon-star-empty"></i>
                        </div><!-- Product Single - Rating End -->

                    </div>

                    <div class="line"></div>

                    <!-- Product Single - Quantity & Cart Button
									============================================= -->
                    <form class="cart mb-0 d-flex justify-content-between align-items-center" method="post"
                        enctype='multipart/form-data'>
                        <div class="quantity clearfix">
                            <div class="flex-wrap mx-2">
                                @foreach ($ukuranProduks as $ukuranProduk)
                                <input type="radio" class="btn-check required mx-2" name="ukuran_id"
                                    id="{{ $ukuranProduk->id }}" autocomplete="off" value="Corporate">
                                <label for="{{ $ukuranProduk->id }}"
                                    class="btn btn-outline-secondary px-3 fw-semibold ls0 nott">{{
                                    $ukuranProduk->ukuran->ukuran }}</label>
                                @endforeach
                            </div>
                            <input type="button" value="-" class="minus">
                            <input type="number" step="1" min="1" name="quantity" max="{{ $produks->stok }}" value="1"
                                title="Qty" class="qty" />
                            <input type="button" value="+" class="plus">
                        </div>
                        <button type="submit" class="add-to-cart button m-0">Add to cart</button>
                    </form><!-- Product Single - Quantity & Cart Button End -->

                    <div class="line"></div>

                    <!-- Product Single - Short Description
									============================================= -->
                    <p>{!! $produks->deskripsi !!}</p>

                    <!-- Product Single - Meta
									============================================= -->
                    <div class="card product-meta">
                        <div class="card-body">
                            <span class="posted_in">Kategori: <a href="#" rel="tag">{{ $produks->kategori->name
                                    }}</a>.</span>
                            <span class="tagged_as">Sub Kategori: <a href="#" rel="tag">{{ $produks->subKategori->name
                                    }}</a>.</span>
                        </div>
                    </div><!-- Product Single - Meta End -->

                </div>

                <div class="col-12 mt-5">

                    <div class="tabs clearfix mb-0" id="tab-1">

                        <ul class="tab-nav clearfix">
                            <li><a href="#tabs-2"><i class="icon-info-sign"></i><span class="d-none d-md-inline-block">
                                        Additional Information</span></a></li>
                            <li><a href="#tabs-3"><i class="icon-star3"></i><span class="d-none d-md-inline-block">
                                        Reviews (2)</span></a></li>
                        </ul>

                        <div class="tab-container">
                            <div class="tab-content clearfix" id="tabs-2">

                                <table class="table table-striped table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Size</td>
                                            <td>Small, Medium &amp; Large</td>
                                        </tr>
                                        <tr>
                                            <td>Color</td>
                                            <td>Pink &amp; White</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="tab-content clearfix" id="tabs-3">

                                <div id="reviews" class="clearfix">

                                    <ol class="commentlist clearfix">

                                        <li class="comment even thread-even depth-1" id="li-comment-1">
                                            <div id="comment-1" class="comment-wrap clearfix">

                                                <div class="comment-meta">
                                                    <div class="comment-author vcard">
                                                        <span class="comment-avatar clearfix">
                                                            <img alt='Image'
                                                                src='https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=60'
                                                                height='60' width='60' /></span>
                                                    </div>
                                                </div>

                                                <div class="comment-content clearfix">
                                                    <div class="comment-author">John Doe<span><a href="#"
                                                                title="Permalink to this comment">April 24, 2021 at
                                                                10:46AM</a></span></div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo
                                                        perferendis aliquid tenetur. Aliquid, tempora, sit aliquam
                                                        officiis nihil autem eum at repellendus facilis quaerat
                                                        consequatur commodi laborum saepe non nemo nam maxime quis error
                                                        tempore possimus est quasi reprehenderit fuga!</p>
                                                    <div class="review-comment-ratings">
                                                        <i class="icon-star3"></i>
                                                        <i class="icon-star3"></i>
                                                        <i class="icon-star3"></i>
                                                        <i class="icon-star3"></i>
                                                        <i class="icon-star-half-full"></i>
                                                    </div>
                                                </div>

                                                <div class="clear"></div>

                                            </div>
                                        </li>

                                        <li class="comment even thread-even depth-1" id="li-comment-2">
                                            <div id="comment-2" class="comment-wrap clearfix">

                                                <div class="comment-meta">
                                                    <div class="comment-author vcard">
                                                        <span class="comment-avatar clearfix">
                                                            <img alt='Image'
                                                                src='https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=60'
                                                                height='60' width='60' /></span>
                                                    </div>
                                                </div>

                                                <div class="comment-content clearfix">
                                                    <div class="comment-author">Mary Jane<span><a href="#"
                                                                title="Permalink to this comment">June 16, 2021 at
                                                                6:00PM</a></span></div>
                                                    <p>Quasi, blanditiis, neque ipsum numquam odit asperiores hic dolor
                                                        necessitatibus libero sequi amet voluptatibus ipsam velit qui
                                                        harum temporibus cum nemo iste aperiam explicabo fuga odio
                                                        ratione sint fugiat consequuntur vitae adipisci delectus eum
                                                        incidunt possimus tenetur excepturi at accusantium quod
                                                        doloremque reprehenderit aut expedita labore error atque?</p>
                                                    <div class="review-comment-ratings">
                                                        <i class="icon-star3"></i>
                                                        <i class="icon-star3"></i>
                                                        <i class="icon-star3"></i>
                                                        <i class="icon-star-empty"></i>
                                                        <i class="icon-star-empty"></i>
                                                    </div>
                                                </div>

                                                <div class="clear"></div>

                                            </div>
                                        </li>

                                    </ol>

                                    <!-- Modal Reviews
													============================================= -->
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#reviewFormModal"
                                        class="button button-3d m-0 float-end">Add a Review</a>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

</div> --}}

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
                                            <div class="slide" data-thumb="{{ asset($image->gambar_produk) }}"><a
                                                    href="{{ asset($image->gambar_produk) }}" title="{{ $produks->name }}"
                                                    data-lightbox="gallery-item"><img
                                                        src="{{ asset($image->gambar_produk) }}"
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
                                                            src="{{ asset($produk->image[0]->gambar_produk) }}"
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
                                                                $rating = number_format($produk->reviewProduk->sum('rating'));
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
