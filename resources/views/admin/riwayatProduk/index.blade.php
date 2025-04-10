@extends('admin.layouts.admin')

@section('content')

<form action="/admin/export" method="post">
    @csrf
    <div class="row mb-2">
        <div class="col-lg-3">
            <div class="mb-3">
                <div class="form-floating">
                    <input type="date" class="form-control" id="floatingInput" name="tanggal_awal"
                        aria-describedby="floatingInputHelp" required />
                    <label for="floatingInput">Tanggal Awal</label>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="mb-3">
                <div class="form-floating">
                    <input type="date" class="form-control" id="floatingInput" name="tanggal_akhir"
                        aria-describedby="floatingInputHelp" required />
                    <label for="floatingInput">Tanggal Akhir</label>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="mb-3">
                <div class="form-floating">
                    <select id="defaultSelect" class="form-select" name="type" required>
                        <option selected hidden value="">Pilih Export</option>
                        <option value="pdf">PDF</option>
                        <option value="excel">EXCEL</option>
                    </select>
                    <label for="floatingInput">Export</label>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="mb-3 mt-2">
                <button type="submit" class="btn btn-secondary col-6">Cetak</button>
            </div>
        </div>
    </div>
</form>
<div class="card shadow-lg rounded card p-2 pb-3">
    <div class="card-header" id="#atas">
        <span class="fs-4 fw-700"><b>Data Riwayat Produk</b></span>
    </div>
    <div class="table-responsive text-nowrap">
        <div class="container">
            <table class="table table-hover table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Nama Produk</th>
                        <th>type</th>
                        <th>Qty</th>
                        <th>Note</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-1">
                    @if (count($riwayatProduks))
                    @foreach ($riwayatProduks as $riwayatProduk)
                    <tr>
                        <td>
                            <div class="d-flex">
                                {{ $loop->iteration }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $riwayatProduk->produk->nama_produk }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                @if ($riwayatProduk->type == 'masuk')
                                <div class="badge rounded-pill bg-success w-100">{{ $riwayatProduk->type }}
                                </div>
                                @elseif ($riwayatProduk->type == 'keluar')
                                <div class="badge rounded-pill bg-danger w-100">{{ $riwayatProduk->type }}
                                </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $riwayatProduk->qty }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $riwayatProduk->note }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $riwayatProduk->created_at->format('Y-m-d') }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $riwayatProduk->created_at->format('h:i:s A') }}
                            </div>
                        </td>
                        {{-- <td>
                            <form action="{{ route('riwayatProduk.destroy', $riwayatProduk->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalCenter{{ $riwayatProduk->id }}"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="modalCenter{{ $riwayatProduk->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalCenterTitle">Apakah Anda
                                                    Yakin?
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Kembali
                                                </button>
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td> --}}
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection