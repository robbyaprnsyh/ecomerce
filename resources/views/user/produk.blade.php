@extends('user.layouts.users')

@section('content')
    {{-- male --}}
    {{-- <section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                        <form action="{{ url('/produk') }}" method="GET">
                            <input type="text" name="keyword" placeholder="Search..." value="{{ $keyword }}">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Kategori</a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="nice-scroll">
                                                @foreach ($kategoris as $kategori)
                                                <div class="card">
                                                    <a class="badge-dark col-5"
                                                        href="{{ url('/produk') }}?kategori={{ $kategori->id }}"
                                                        data-target="#kategori{{ $kategori->id }}">{{ $kategori->name
                                                        }}</a>
                                                    <div id="kategori{{ $kategori->id }}" class="collapse show">
                                                        <div class="card-body">
                                                            <div class="shop__sidebar__categories">
                                                                <ul class="nice-scroll">
                                                                    @foreach ($kategori->subKategori as $subKategori)
                                                                    <li><a
                                                                            href="/produk/{{ $kategori->name }}?subKategori={{ $subKategori->id }}">{{
                                                                            $subKategori->name }}</a>
                                                                    </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                </div>
                                <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__price">
                                            <ul>
                                                <li><a href="/produk/?min=0&max=100000">0 -
                                                        100.000</a></li>
                                                <li><a href="/produk/?min=100000&max=200000">100.000 -
                                                        200.000</a></li>
                                                <li><a href="/produk/?min=200000&max=300000">200.000 -
                                                        300.000</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a href="/produk/?diskon=true">on Diskon</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    @foreach ($produks as $produk)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item sale">
                            <div class="product__item__pic set-bg"
                                data-setbg="{{ asset($produk->image[0]->gambar_produk) }}">
                                @if ($produk->diskon > 0)
                                <span class="label">{{ $produk->diskon }}%</span>
                                @endif
                                <ul class="product__hover">
                                    <form id="wishlist{{ $produk->id }}" action="{{ route('wishlist.store') }}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                        <li>
                                            <a
                                                onclick="event.preventDefault();
                                                                document.getElementById('wishlist{{ $produk->id }}').submit();">
                                                <img src="{{ asset('assets2/img/icon/heart.png') }}" alt="">
                                            </a>
                                        </li>
                                    </form>
                                    <li><a href="/detailProduk/{{ $produk->id }}"><img
                                                src="{{ asset('assets2/img/icon/search.png') }}" alt=""></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>{{ $produk->nama_produk }}</h6>
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
                {{ $produks->links() }}
            </div>
        </div>
    </div>
</section> --}}
    {{-- endmale --}}

    {{-- Canvas --}}
    <div class="container clearfix">

        <div class="row gutter-40 col-mb-80">
            <!-- Post Content
                                                                                                                                ============================================= -->
            <div class="postcontent col-lg-9 order-lg-last">

                <!-- Shop ============================================= -->
                <div id="shop" class="shop row grid-container gutter-20" data-layout="fitRows">

                    @if (count($produks))
                        @foreach ($produks as $produk)
                            <div class="product col-md-3 col-sm-12 col-12">
                                <div class="grid-inner">
                                    <div class="product-image">
                                        @if ($produk->image[0]->gambar_produk)
                                            <a href="#"><img src="{{ asset($produk->image[0]->gambar_produk) }}"
                                                    height="220px" class="rounded" alt="Checked Short Dress"></a>
                                        @endif
                                        @if ($produk->image[1]->gambar_produk)
                                            <a href="#"><img src="{{ asset($produk->image[1]->gambar_produk) }}"
                                                    height="220px" alt="Checked Short Dress"></a>
                                        @endif
                                        @if ($produk->diskon > 0)
                                            <div class="sale-flash badge bg-secondary p-2">{{ $produk->diskon }}%</div>
                                        @endif
                                        <div class="bg-overlay">
                                            <div class="bg-overlay-content align-items-end justify-content-between"
                                                data-hover-animate="fadeIn" data-hover-speed="400">
                                                @auth
                                                    <form id="wishlist{{ $produk->id }}"
                                                        action="{{ route('wishlist.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                                        <a onclick="event.preventDefault(); document.getElementById('wishlist{{ $produk->id }}').submit();"
                                                            class="btn btn-dark"><i class="icon-heart3"></i></a>
                                                    </form>
                                                @else
                                                    <a id="auth" class="btn btn-dark"><i class="icon-heart3"></i></a>
                                                @endauth
                                            </div>
                                            <div class="bg-overlay-bg bg-transparent"></div>
                                        </div>
                                    </div>
                                    <div class="product-desc">
                                        <div class="product-title">
                                            <h3><a href="/detailProduk/{{ $produk->id }}"
                                                    class="text-dark">{{ $produk->nama_produk }}</a></h3>
                                        </div>
                                        @if ($produk->diskon > 0)
                                            @php
                                                $diskon = ($produk->diskon / 100) * $produk->harga;
                                                $harga = $produk->harga - $diskon;
                                            @endphp
                                            <div class="product-price"><del>Rp.
                                                    {{ number_format($produk->harga, 0, ',', '.') }}</del>
                                                <ins class="text-dark">Rp. {{ number_format($harga, 0, ',', '.') }}</ins>
                                            </div>
                                        @else
                                            <div class="product-price">Rp. {{ number_format($produk->harga, 0, ',', '.') }}
                                            </div>
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
                                        <div class="product-rating">
                                            @for ($i = 1; $i <= $total; $i++)
                                                <i class="icon-star3" style="color: yellow"></i>
                                            @endfor
                                            @for ($j = $total + 1; $j <= 5; $j++)
                                                <i class="icon-star3"></i>
                                            @endfor
                                            <span class="mx-1">
                                                @if ($produk->reviewProduk->count() > 0)
                                                    {{ $produk->reviewProduk->count() }} rating
                                                @else
                                                    0 rating
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center" style="margin-top:200px">
                            <img src="{{ asset('images/no_produk.png') }}" width="150px">
                            <div class="fw-bold p-4">Belum ada Produk</div>
                        </div>
                    @endif
                </div>
                {{ $produks->links() }}
                <!-- #shop end -->

            </div>
            <!-- .postcontent end -->
            <!-- Sidebar ============================================= -->
            <div class="sidebar col-lg-3">
                <div class="sidebar-widgets-wrap">
                    <div class="widget clearfix">
                        <div class="my-3">
                            <form action="{{ url('/produk') }}" method="GET" class="my-3">
                                <div class="input-group mx-auto">
                                    <input type="text" name="keyword" placeholder="Search..."
                                        value="{{ $keyword }}" class="form-control">
                                    <button class="btn btn-secondary" type="submit"><i class="icon-search2"></i></button>
                                </div>
                            </form>
                        </div>

                        <div class="mt-4">
                            <h4>Kategori Produk</h4>
                            @foreach ($kategoris as $kategori)
                                <ul class="list-group mt-2">
                                    <li class="list-group-item">
                                        <a href="/produk?kategori={{ $kategori->id }}"
                                            class="text-dark fw-bold">{{ $kategori->name }}</a>
                                        <span class="badge bg-secondary float-end"
                                            style="margin-top: 3px;">{{ $kategori->produk->count() }}</span>
                                        <a data-bs-toggle="collapse" href="#kategori{{ $kategori->id }}"
                                            aria-expanded="false" aria-controls="kategori{{ $kategori->id }}"
                                            class="dropdown-toggle dropdown-toggle-split float-end text-dark"></a>
                                    </li>
                                </ul>
                                <div class="collapse mt-2" id="kategori{{ $kategori->id }}">
                                    <ul class="list-group list-group-flush">
                                        @foreach ($kategori->subKategori as $subKategori)
                                            <li class="list-group-item"><a
                                                    href="/produk/{{ $kategori->name }}?subKategori={{ $subKategori->id }}"
                                                    class="text-dark">{{ $subKategori->name }}</a>
                                                <span class="badge bg-secondary float-end"
                                                    style="margin-top: 3px;">{{ $subKategori->produk->count() }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4">
                            <h4>Diskon</h4>
                            <ul class="list-group mt-2">
                                <li class="list-group-item">
                                    <a href="/produk?diskon=true" class="text-dark fw-bold">All Produk</a>
                                    <span class="badge bg-secondary float-end"
                                        style="margin-top: 3px;">{{ $produks_diskon }}</span>
                                </li>
                            </ul>
                        </div>

                        <div class="mt-4 widget_links">
                            <h4>Filter Harga</h4>
                            <ul>
                                <li><a href="/produk?min=0&max=100000">Rp. 0 - 100.000</a></li>
                                <li><a href="/produk?min=100000&max=150000">Rp. 100.000 - 150.000</a></li>
                                <li><a href="/produk?min=150000&max=200000">Rp. 150.000 - 200.000</a></li>
                                <li><a href="/produk?min=200000&max=250000">Rp. 200.000 - 250.000</a></li>
                                <li><a href="/produk?min=250000&max=300000">Rp. 250.000 - 300.000</a></li>
                            </ul>
                        </div>

                        @php
                            $total_voucher = App\Models\Voucher::count();
                        @endphp
                        <div class="mt-4">
                            <h4>Voucher</h4>
                            <ul class="list-group mt-2">
                                <li class="list-group-item">
                                    <a href="/voucher" class="text-dark fw-bold">All Voucher</a>
                                    <span class="badge bg-secondary float-end"
                                        style="margin-top: 3px;">{{ $total_voucher }}</span>
                                </li>
                            </ul>
                        </div>



                        {{-- <div class="mt-4">
                            <h4>Ukuran</h4>
                            <div class="tagcloud">
                                @foreach ($ukurans as $ukuran)
                                    <a href="/produk?ukuran={{ $ukuran->ukuran }}" class="btn btn-secondary text-white"
                                        style="width: 40px">{{ $ukuran->ukuran }}</a>
                                @endforeach
                            </div>
                        </div> --}}

                    </div>
                </div>
            </div><!-- .sidebar end -->
        </div>

    </div>
    {{-- endCanvas --}}
@endsection
