@extends('user.layouts.users')

@section('content')
<section class="spad">
    <div class="card shadow-lg rounded card p-2">
        <div class="card-header" id="#atas">
            <span class="fs-4 fw-700">Data alamat</span>
            <a href="{{ route('alamat.create') }}" class="btn btn-sm btn-primary float-right "><svg
                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                </svg>Tambah Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <div class="container">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>User</th>
                                <th>Nama Lengkap</th>
                                <th>Provinsi</th>
                                <th>Kota/Kabupaten</th>
                                <th>Kecamatan</th>
                                <th>Label Alamat</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-1">
                            @if (count($alamats))
                            @foreach ($alamats as $alamat)
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        {{ $loop->iteration }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        {{ $alamat->user->name }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        {{ $alamat->nama_lengkap }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        {{ $alamat->provinsi->provinsi }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        {{ $alamat->kota->kota }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        {{ $alamat->kecamatan->kecamatan }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        {{ $alamat->label_alamat }}
                                    </div>
                                </td>
                                <td>
                                    <form action="{{ route('alamat.destroy', $alamat->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route('alamat.edit', $alamat->id) }}"
                                            class="btn btn-sm btn-secondary" data-bs-toggle="tooltip"
                                            data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                            title="<span>Edit Data</span>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                            </svg>
                                        </a> |
                                        {{-- <a href="{{ route('alamat.show', $alamat->id) }}"
                                            class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                            data-bs-placement="top" data-bs-html="true"
                                            title="<span>Show Data</span>"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="16" height="16" fill="currentColor" class="bi bi-eye-fill"
                                                viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                <path
                                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                            </svg>
                                        </a> | --}}
                                        <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalCenter{{ $alamat->id }}"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection