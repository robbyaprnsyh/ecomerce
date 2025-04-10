@extends('admin.layouts.admin')

@section('content')
<div class="card shadow-lg rounded card p-2">
    <div class="card-header" id="#atas">
        <span class="fs-4 fw-700"><b>Data Sub Kategori Produk</b></span>
        <a href="{{ route('subKategori.create') }}" class="btn btn-primary float-end ">Tambah Data</a>
    </div>
    <div class="table-responsive text-nowrap">
        <div class="container">
            <table class="table table-hover table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Kategori</th>
                        <th>Sub Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-1">
                    @if (count($subKategoris))
                    @foreach ($subKategoris as $subKategori)
                    <tr>
                        <td>
                            <div class="d-flex">
                                {{ $loop->iteration }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $subKategori->kategori->name }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $subKategori->name }}
                            </div>
                        </td>
                        <td>
                            <form id="deleted{{ $subKategori->id }}"
                                action="{{ route('subKategori.destroy', $subKategori->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <a href="{{ route('subKategori.edit', $subKategori->id) }}"
                                    class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                    data-bs-placement="top" data-bs-html="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                    </svg>
                                </a> |
                                <a href="javascript:void(0)" class="btn btn-sm btn-danger" id="btn-delete"
                                    data-id="{{ $subKategori->id }}" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                    data-bs-placement="top" data-bs-html="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                </a>
                            </form>
                        </td>
                    </tr>
                    @include('admin.subKategori.delete')
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection