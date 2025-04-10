@extends('user.layouts.user')

@section('content')
    <section class="my-3">
        <img src="https://th.bing.com/th/id/R.7bc591414923dbf9442552ea28db1bc7?rik=fYDkNGqV%2bKeMjQ&riu=http%3a%2f%2fwww.sariska.co.uk%2fimages%2fmodules%2fpromo_units%2f1437644437-32326800.jpg&ehk=gAXR0%2bVxcNQVoBl0c7pJ99uzctWB7QkbE5ATcnd2ADw%3d&risl=&pid=ImgRaw&r=0"
            class="img-fluid" alt="...">
    </section>

    @if (count($produks))
        <section class="product spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="section-title">
                            <h4>All Produks</h4>
                        </div>
                    </div>
                </div>
                <div class="row property__gallery">
                    @foreach ($produks as $produk)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg"
                                    data-setbg="{{ asset($produk->image[0]->gambar_produk) }}">
                                    @if ($produk->diskon > 0)
                                        <div class="label sale float-end">-{{ $produk->diskon }}%</div>
                                    @endif
                                    <ul class="product__hover">
                                        <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                        <li><a href="/produk/{{ $produk->id }}"><span class="arrow_expand"></span></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6 class="mb-2"><a href="#">{{ $produk->nama_produk }}</a></h6>
                                    @if ($produk->diskon > 0)
                                        @php
                                            $diskon = ($produk->diskon / 100) * $produk->harga;
                                            $harga = $produk->harga - $diskon;
                                        @endphp
                                        <div class="product__price">Rp.
                                            {{ number_format($harga, 0, ',', '.') }}<span>
                                                {{ number_format($produk->harga, 0, ',', '.') }}</span></div>
                                    @else
                                        <div class="product__price">
                                            Rp. {{ number_format($produk->harga, 0, ',', '.') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
