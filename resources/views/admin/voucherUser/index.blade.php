@extends('admin.layouts.admin')

@section('content')
<div class="card shadow-lg rounded card p-2">
    <div class="card-header" id="#atas">
        <span class="fs-4 fw-700">Data Pembelian Voucher</span>
        {{-- <a href="{{ route('voucherUser.create') }}" class="btn btn-sm btn-primary float-end"><svg
                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
            </svg>Tambah Data</a> --}}
    </div>
    <div class="table-responsive text-nowrap">
        <div class="container">
            <table class="table table-hover table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Nama Pembeli</th>
                        <th>Kode voucher</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        {{-- <th>Actions</th> --}}
                    </tr>
                </thead>
                <tbody class="table-border-bottom-1">
                    @if (count($voucherUsers))
                    @foreach ($voucherUsers as $voucherUser)
                    <tr>
                        <td>
                            <div class="d-flex">
                                {{ $loop->iteration }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $voucherUser->user->name }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $voucherUser->voucher->kode_voucher }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $voucherUser->created_at->format('Y-m-d') }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $voucherUser->created_at->format('h:i:s A') }}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection