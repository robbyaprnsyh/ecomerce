@extends('user.layouts.users')

@section('content')
    {{-- Canvas --}}
    <div class="container clearfix">
        <div class="row">
            @if (count($vouchers))
                @foreach ($vouchers as $voucher)
                    <div class="col-lg-6">
                        <div class="promo promo-light promo-full mb-3">
                            <div class="row align-items-center">
                                <div class="col-lg-3">
                                    <img src="{{ asset('images/no_voucher.png') }}" width="300px" alt=""
                                        srcset="">
                                </div>
                                <div class="col-lg-6">
                                    <h4>
                                        <div class="d-inline">
                                            {{ $voucher->kode_voucher }}
                                        </div>
                                        <span class="text-danger">({{ $voucher->diskon }})%</span>
                                    </h4>
                                    <div style="margin-top:-30px">
                                        {{ $voucher->waktu_mulai }} -
                                        {{ $voucher->waktu_berakhir }}
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    @auth
                                        <form id="voucher{{ $voucher->id }}" action="/voucher/klaim" method="POST">
                                            @csrf
                                            <input type="hidden" name="voucher_id" value="{{ $voucher->id }}">
                                            <a onclick="event.preventDefault(); document.getElementById('voucher{{ $voucher->id }}').submit();"
                                                class="button button-black button-circle">klaim</i></a>
                                        </form>
                                    @else
                                        <a id="auth" class="button button-black button-circle">Klaim</a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center">
                    <img src="{{ asset('images/no_produk.png') }}" width="150px" alt="" srcset="">
                    <div class="fw-bold p-4">Belum ada Voucher</div>
                </div>
            @endif
        </div>
    </div>
    {{-- endCanvas --}}

@endsection
