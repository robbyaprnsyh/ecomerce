@extends('user.layouts.users')

@section('content')
    {{-- Canvas --}}
    <div class="container clearfix">
        <div class="row align-items-center col-mb-50">
            <div class="col-md-5 center">
                <img data-animate="fadeInLeft"
                    src="{{ asset('images/home.jpg') }}" class="rounded"
                    style="width: 700px" alt="No image">
            </div>

            <div class="col-md-7 text-center text-md-start">
                <div class="heading-block border-bottom-0">
                    <h3>Tentang Suko</h3>
                </div>
                <p class="fs-6" style="margin-top: -50px">SUKO adalah merek private label eksklusif yang diluncurkan oleh PT Matahari Department Store Tbk pada Oktober 2023. Terinspirasi dari konsep fashion minimalis dan sederhana.</p>
                <p class="fs-6">Nama "SUKO" berasal dari perpaduan bahasa Jepang dan Indonesia, terinspirasi dari kata "SUKA" yang berarti "kesukaan" atau "sesuatu yang kita sukai".</p>

                <a href="/produk" class="button button-black button-rounded button-large" style="margin-top: -100px">Belanja
                    Sekarang</a>
            </div>
        </div>
    </div>
@endsection
