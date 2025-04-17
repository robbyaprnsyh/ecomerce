{{-- Canvas --}}
<!-- Header -->
<header id="header" class="full-header transparent-header" data-sticky-class="not-dark">
    @php
        $kategoris = App\Models\Kategori::all();
    @endphp
    <div id="header-wrap">
        <div class="container">
            <div class="header-row">
                <!-- Logo -->
                <div id="logo">
                    <a href="/" class="standard-logo"><img src="{{ asset('images/logoo.png') }}"
                            alt="Canvas Logo"></a>
                </div>
                <!-- #logo end -->

                <div class="header-misc">
                    <!-- Top Wishlist -->
                    <div id="top-wishlist" class="header-misc-icon d-none d-sm-block">
                        @auth
                            @php
                                $total_wishlists = App\Models\Wishlist::where('user_id', Auth::user()->id)->count();
                                $wishlists = App\Models\Wishlist::where('user_id', Auth::user()->id)->get();
                            @endphp

                            <a href="#" id="top-wishlist-trigger"><i class="icon-line-heart"
                                    style="font-size: 20px"></i><span
                                    class="top-wishlist-number">{{ $total_wishlists }}</span></a>
                            <div class="top-wishlist-content">
                                <div class="top-wishlist-title">
                                    <h4>Wishlist Saya</h4>
                                </div>
                                <div class="top-wishlist-items" style="max-height: 250px; overflow:auto">
                                    @if (count($wishlists))
                                        @foreach ($wishlists as $wishlist)
                                            <div class="top-wishlist-item">
                                                <div class="top-wishlist-item-image">
                                                    <a href="/produk/{{ $wishlist->produk_id }}"><img
                                                            src="{{ asset("images/gambar_produk/" . $wishlist->produk->image[0]->gambar_produk) }}"
                                                            alt="{{ $wishlist->produk->nama_produk }}" /></a>
                                                </div>
                                                <div class="top-wishlist-item-desc">
                                                    <div class="top-wishlist-item-desc-title">
                                                        <a
                                                            href="/produk/{{ $wishlist->produk_id }}">{{ $wishlist->produk->nama_produk }}</a>
                                                        <span class="top-wishlist-item-price d-block">Rp.
                                                            {{ number_format($wishlist->produk->harga, 0, ',', '.') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="text-center">
                                            <img src="{{ asset('images/no_produk.png') }}" width="80px" alt=""
                                                srcset="">
                                            <div class="fw-bold p-4">Wishlist kosong</div>
                                        </div>
                                    @endif
                                </div>
                                <div class="top-wishlist-action">
                                    <a href="/wishlist" class="button button-3d button-small m-0">Lainnya</a>
                                </div>
                            </div>
                        @endauth

                        @guest
                            <a id="auth"><i class=" icon-line-heart" style="font-size: 20px"></i><span
                                    class="top-wishlist-number">0</span></a>
                        @endguest
                    </div>
                    <!-- #top-Wishlist end -->

                    <!-- Top Cart -->
                    <div id="top-cart" class="header-misc-icon d-none d-sm-block">
                        @auth
                            @php
                                $total_keranjangs = App\Models\Keranjang::where('user_id', Auth::user()->id)
                                    ->where('status', 'keranjang')
                                    ->count();
                                $keranjangs = App\Models\Keranjang::where('user_id', Auth::user()->id)
                                    ->where('status', 'keranjang')
                                    ->get();
                                $total_harga = App\Models\Keranjang::where('user_id', Auth::user()->id)
                                    ->where('status', 'keranjang')
                                    ->sum('total_harga');
                            @endphp

                            <a href="#" id="top-cart-trigger"><i class="icon-line-shopping-cart"
                                    style="font-size: 20px"></i><span
                                    class="top-cart-number">{{ number_format($total_keranjangs, 0, ',', '.') }}</span></a>
                            <div class="top-cart-content">
                                <div class="top-cart-title">
                                    <h4>Keranjang Saya</h4>
                                </div>
                                <div class="top-cart-items" style="max-height: 250px; overflow:auto">
                                    @if (count($keranjangs))
                                        @foreach ($keranjangs as $keranjang)
                                            <div class="top-cart-item">
                                                <div class="top-cart-item-image">
                                                    <a href="/produk/{{ $keranjang->produk_id }}"><img
                                                            src="{{ asset("images/gambar_produk/" . $keranjang->produk->image[0]->gambar_produk) }}"
                                                            alt="{{ $keranjang->produk->nama_produk }}" /></a>
                                                </div>
                                                <div class="top-cart-item-desc">
                                                    <div class="top-cart-item-desc-title">
                                                        <a
                                                            href="/produk/{{ $keranjang->produk_id }}">{{ $keranjang->produk->nama_produk }}</a>
                                                        <span class="top-cart-item-price d-block">Rp.
                                                            {{ number_format($keranjang->total_harga, 0, ',', '.') }}</span>
                                                    </div>
                                                    <div class="top-cart-item-quantity">x
                                                        {{ number_format($keranjang->jumlah, 0, ',', '.') }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="text-center">
                                            <img src="{{ asset('images/no_produk.png') }}" width="80px" alt=""
                                                srcset="">
                                            <div class="fw-bold p-4">Keranjang kosong</div>
                                        </div>
                                    @endif
                                </div>
                                <div class="top-cart-action">
                                    <span class="top-checkout-price">Rp.
                                        {{ number_format($total_harga, 0, ',', '.') }}</span>
                                    <a href="/keranjang" class="button button-3d button-small m-0">lainnya</a>
                                </div>
                            </div>

                        @endauth

                        @guest
                            <a id="auth"><i class="icon-line-shopping-cart" style="font-size: 20px"></i><span
                                    class="top-cart-number">0</span></a>
                        @endguest
                    </div>
                    <!-- #top-cart end -->

                    <div class="dropdown mx-3">
                        <div data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="icon-user1"
                                style="font-size: 20px"></i></div>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenu1">
                            @auth
                                <a class="dropdown-item text-start" href="/profil/akun">Profil</a>
                                <a class="dropdown-item text-start" href="/profil/pesanan">Pesanan Saya</a>
                                <a class="dropdown-item text-start" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                    @php
                                        $users = App\Models\User::findOrFail(auth()->user()->id);
                                        // $users->status = 'tidak aktif';
                                        $users->save();
                                    @endphp
                                </form>
                            @endauth
                            @guest()
                                <a class="dropdown-item text-start" href="/login">Login</a>
                                <a class="dropdown-item text-start" href="/register">Register</a>
                            @endguest

                        </ul>
                    </div>
                </div>

                <!-- Primary Navigation -->
                <nav class="primary-menu">
                    <ul class="menu-container">
                        <li class="menu-item">
                            <a class="menu-link" href="/">
                                <div>Home</div>
                            </a>
                        </li>
                        <li class="menu-item mega-menu">
                            <a class="menu-link" href="/produk">
                                <div>Shop</div>
                            </a>
                            <div class="mega-menu-content mega-menu-style-2">
                                <div class="container">
                                    <div class="row">
                                        @foreach ($kategoris as $kategori)
                                            <ul class="sub-menu-container mega-menu-column col-lg-4">
                                                <li class="menu-item mega-menu-title">
                                                    <a class="menu-link" href="/produk?kategori={{ $kategori->id }}">
                                                        <div> {{ $kategori->name }}</div>
                                                    </a>
                                                    <ul class="sub-menu-container">
                                                        @foreach ($kategori->subKategori as $subKategori)
                                                            <li class="menu-item">
                                                                <a class="menu-link"
                                                                    href="/produk/{{ $kategori->name }}?subKategori={{ $subKategori->id }}">
                                                                    <div>{{ $subKategori->name }}
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            </ul>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>

                </nav><!-- #primary-menu end -->

            </div>
        </div>
    </div>
    <div class="header-wrap-clone"></div>
</header>

@if (Request::is('/'))
    <section id="slider"
        class="slider-element slider-parallax swiper_wrapper min-vh-60 min-vh-md-100 include-header">
        <div class="slider-inner">
            <div class="swiper-container swiper-parent">
                <div class="swiper-wrapper">
                    <div class="swiper-slide dark">
                        <div class="container">
                            <div class="slider-caption">
                                <h2 class="text-white" data-animate="fadeInUp">Welcome to SUKO</h2>
                                <h3 class="d-none d-sm-block text-white pt-2" data-animate="fadeInUp" data-delay="200">Solusi Belanja
                                    online
                                    mudah dan hemat. Pakaian berkualitas
                                    untuk orang-orang berkualitas</h3>
                            </div>
                        </div>
                        <div class="swiper-slide-bg"
                            style="background-image: url({{ asset('images/slide2.png') }});">
                        </div>
                    </div>
                    {{-- <div class="swiper-slide dark">
                        <div class="container">
                            <div class="slider-caption">
                                <h2 class="text-secondary" data-animate="fadeInUp">StyleShop</h2>
                                <h3 class="d-none d-sm-block text-secondary" data-animate="fadeInUp" data-delay="200">Pakaian berkualitas
                                    untuk orang-orang berkualitas
                                </h3>
                            </div>
                        </div>
                        <div class="swiper-slide-bg"
                            style="background-image: url({{ asset('user/assets/images/slider/swiper/6.jpg') }}); background-position: center top;">
                        </div>
                    </div> --}}
                    <div class="swiper-slide dark"> 
                        {{-- <div class="container">
                            <div class="slider-caption">
                                <h2 data-animate="fadeInUp">StyleShop</h2>
                                <p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200">Pakaian
                                    berkualitas
                                    untuk orang-orang berkualitas
                            </div>
                        </div> --}}
                        <div class="swiper-slide-bg"
                            style="background-image: url({{ asset('images/slide1.jpg') }}); background-position: center top;">
                        </div>
                    </div>
                </div>
                <div class="slider-arrow-left"><i class="icon-angle-left"></i></div>
                <div class="slider-arrow-right"><i class="icon-angle-right"></i></div>
            </div>

            <a href="#" data-scrollto="#content" data-offset="100" class="one-page-arrow dark"><i
                    class="icon-angle-down infinite animated fadeInDown"></i></a>
        </div>
    </section>
@endif

@if (Request::is('produk*'))
    <section id="page-title" class="page-title-parallax page-title-dark"
        style="background-image: url({{ asset('user/assets/images/parallax/8.jpg') }}); background-size: cover; padding: 120px 0;"
        data-bottom-top="background-position:0px 0px;" data-top-bottom="background-position:0px -300px;">

        <div class="container clearfix">
            <h1>Belanja Sekarang</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Shop</li>
            </ol>
        </div>

    </section>
@endif

@if (Request::is('voucher*'))
    <section id="page-title" class="page-title-parallax page-title-dark"
        style="background-image: url({{ asset('user/assets/images/parallax/8.jpg') }}); background-size: cover; padding: 120px 0;"
        data-bottom-top="background-position:0px 0px;" data-top-bottom="background-position:0px -300px;">

        <div class="container clearfix">
            <h1>Klaim Voucher anda</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Voucher</li>
            </ol>
        </div>

    </section>
@endif

@if (Request::is('wishlist'))
    <section id="page-title" class="page-title-parallax page-title-dark"
        style="background-image: url({{ asset('user/assets/images/parallax/8.jpg') }}); background-size: cover; padding: 120px 0;"
        data-bottom-top="background-position:0px 0px;" data-top-bottom="background-position:0px -400px;">

        <div class="container clearfix">
            <h1>Wishlist saya</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">wishlist</li>
            </ol>
        </div>
    </section>
@endif

@if (Request::is('detailProduk*'))
    <section id="page-title" class="page-title-parallax page-title-dark"
        style="background-image: url({{ asset('user/assets/images/parallax/8.jpg') }}); background-size: cover; padding: 120px 0;"
        data-bottom-top="background-position:0px 0px;" data-top-bottom="background-position:0px -400px;">

        <div class="container clearfix">
            <h1>Detail produk</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/produk">Shop</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Detail produk</li>
            </ol>
        </div>
    </section>
@endif

@if (Request::is('checkout*'))
    <section id="page-title" class="page-title-parallax page-title-dark"
        style="background-image: url({{ asset('user/assets/images/parallax/8.jpg') }}); background-size: cover; padding: 120px 0;"
        data-bottom-top="background-position:0px 0px;" data-top-bottom="background-position:0px -400px;">

        <div class="container clearfix">
            <h1>Checkout</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/keranjang">Keranjang</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">checkout</li>
            </ol>
        </div>
    </section>
@endif

<!-- #header end -->
{{-- EndCanvas --}}
