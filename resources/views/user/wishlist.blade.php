@extends('user.layouts.users')

@section('content')
    {{-- Male --}}
    {{--
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>My Wishlist</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<section class="shopping-wishlist spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="shopping__wishlist__table shadow p-4 bg-white rounded">
                    <table class="">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Harga</th>
                                <th>Diskon</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($wishlists))
                            @foreach ($wishlists as $wishlist)
                            <tr>
                                <td class="product__wishlist__item">
                                    <div class="product__wishlist__item__pic">
                                        <img src="{{ asset($wishlist->produk->image[0]->gambar_produk) }}"
                                            class="rounded" alt="">
                                    </div>
                                    <div class="product__wishlist__item__text">
                                        <h6><a href="/produk/{{ $wishlist->produk_id }}">{{
                                                $wishlist->produk->nama_produk }}</a>
                                        </h6>
                                    </div>
                                </td>
                                <td class="cart__price">
                                    Rp. {{ number_format($wishlist->produk->harga, 0, ',', '.') }}</td>
                                <td class="cart__diskon">{{ $wishlist->produk->diskon }}%</td>
                                <td class="cart__close">
                                    <form id="delete{{ $wishlist->id }}"
                                        action="{{ route('wishlist.destroy', $wishlist->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <a onclick="event.preventDefault();
                                                    document.getElementById('delete{{ $wishlist->id }}').submit();">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5" class="text-center">
                                    <div class="alert alert-dark" role="alert">
                                        Wishlist Kosong
                                    </div>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="/produk">Continue Shopping</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn update__btn">
                            <form id="deleteAll" action="/deleteAllWishlist">
                                @csrf
                                <a onclick="event.preventDefault();
                                                    document.getElementById('deleteAll').submit();">
                                    Delete All Wishlist
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <img class="shadow rounded-lg p-0" src="{{ asset('images/logo.png') }}" alt="...">
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End --> --}}
    {{-- endMale --}}

    {{-- Canvas --}}

    <div class="container">

        <div class="row">
            <div class="col-lg-8">
                <table class="table cart mb-5">
                    <thead>
                        <tr>
                            <th class="cart-product-remove">&nbsp;</th>
                            <th class="cart-product-name">Produk</th>
                            <th class="cart-product-price">Harga</th>
                            <th class="cart-product-price">diskon</th>
                            <th class="cart-product-thumbnail">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($wishlists))
                            @foreach ($wishlists as $wishlist)
                                <tr class="cart_item">
                                    <td class="cart-product-thumbnail">
                                        <a href="#"><img width="100px" height="100px"
                                                src="{{ asset($wishlist->produk->image[0]->gambar_produk) }}"
                                                alt="{{ $wishlist->produk->nama_produk }}"></a>
                                    </td>

                                    <td class="cart-product-name">
                                        <a href="#">{{ $wishlist->produk->nama_produk }}</a>
                                    </td>

                                    <td class="cart-product-price">
                                        <span class="amount">Rp.
                                            {{ number_format($wishlist->produk->harga, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="cart-product-price">
                                        <span
                                            class="amount">{{ number_format($wishlist->produk->diskon, 0, ',', '.') }}%</span>
                                    </td>
                                    <td class="cart-product-remove">
                                        <form id="delete{{ $wishlist->id }}"
                                            action="{{ route('wishlist.destroy', $wishlist->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <a onclick="event.preventDefault(); document.getElementById('delete{{ $wishlist->id }}').submit();"
                                                class="remove" title="Hapus Produk ini"><i
                                                    class="icon-line-delete icon-lg"></i></a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">
                                    <div class="my-3">
                                        <img src="{{ asset('images/no_produk.png') }}" width="80px" alt=""
                                            srcset="">
                                        <div class="fw-bold p-4">Wishlist kosong</div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{ $wishlists->links() }}
                <div class="col-lg-auto pe-lg-0">
                    <form id="deleteAll" action="/deleteAllWishlist">
                        @csrf
                        <a href="/produk" class="button button-3d button-black m-0 m-0 mx-2">Lanjut Belanja</a>
                        @if (count($wishlists))
                            <a id="btnDeleteAll" class="button button-3d button-black m-0 mt-2 mt-sm-0 me-0">Hapus all
                                produk</a>
                        @else
                            <a id="wishlist" class="button button-3d button-black m-0 mt-2 mt-sm-0 me-0">Hapus all
                                Wishlist</a>
                        @endif
                    </form>
                </div>
            </div>
            {{-- <div class="col-lg-4">
            <img class="rounded-lg p-0 shadow" width="300px" src="{{ asset('images/logo.png') }}" alt="">
        </div> --}}
        </div>
    </div>
    {{-- endCanvas --}}
@endsection
