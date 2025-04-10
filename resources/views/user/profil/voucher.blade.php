@extends('user.profil')

@section('profil')
    <div class="row">
        @if (count($vouchers))
            @foreach ($vouchers as $voucher)
                <div class="col-lg-6">
                    <div class="promo promo-light promo-full mb-3">
                        <div class="row align-items-center">
                            <div class="col-lg-4">
                                <img src="{{ asset('images/no_voucher.png') }}" width="300px" alt="" srcset="">
                            </div>
                            <div class="col-lg-8">
                                <h4>
                                    <div class="d-inline">
                                        {{ $voucher->voucher->kode_voucher }}
                                    </div>
                                    <span class="text-danger">({{ $voucher->voucher->diskon }})%</span>
                                </h4>
                                <div style="margin-top:-30px">
                                    {{ $voucher->voucher->waktu_mulai }} -
                                    {{ $voucher->voucher->waktu_berakhir }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center">
                <img src="{{ asset('images/no_review.png') }}" width="120px" alt="" srcset="">
                <div class="fw-bold p-4">Belum ada Voucher</div>
            </div>
        @endif
    </div>
@endsection
