@extends('user.layouts.users')

@section('content')
<section class="spad">
    @if (count($historis))
    <div class="row">
        <div class="container">
            <h3 class="related-title">History Pembelian</h3>
            @foreach ($historis as $histori)
            <div class="card">
                <div class="row">
                    <div class="col">
                        <div class="testimonial__text">
                            <div class="testimonial__author">
                                <div class="testimonial__author__pic">
                                    <img src="{{ asset($histori->keranjang->produk->image[0]->gambar_produk) }}" alt="">
                                </div>
                                <div class="testimonial__author__text">
                                    <h5>{{ $histori->transaksi->kode_transaksi }}</h5>
                                    <p class="text-break">{{ $histori->keranjang->produk->nama_produk }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mt-5">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#review{{ $histori->id }}">
                            Review
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="review{{ $histori->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="reviewLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="reviewLabel">Modal {{ $histori->id }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="/ulasan/create" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <input type="hidden" name="detailTransaksi_id" value="{{ $histori->id }}">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">rating:</label>
                                                <input type="number" class="form-control" max="5" name="rating"
                                                    value="">
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">komen:</label>
                                                <input type="text" class="form-control" name="komen" value="">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="container">
            {{-- {{ $historis->links() }} --}}
        </div>
    </div>
    @else
    <div class="alert alert-dark" role="alert">
        Data Kosong
    </div>
    @endif
</section>
@endsection
