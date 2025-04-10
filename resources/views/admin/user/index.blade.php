@extends('admin.layouts.admin')

@section('content')

<div class="card shadow-lg rounded card p-2">
    <div class="card-header" id="#atas">
        <span class="fs-4 fw-700"><b>Data Pengguna</b></span>
    </div>
    <div class="table-responsive text-nowrap">
        <div class="container">
            <table class="table table-hover table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th>Users</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Saldo</th>
                        <th>Score</th>
                        {{-- <th>Status</th> --}}
                        <th>Create</th>
                        {{-- <th>Update</th> --}}
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-1">
                    @if (count($users))
                    @foreach ($users as $user)
                    <tr>
                        <td class="col-4">
                            <div class="d-flex">
                                <img src="{{ asset($user->profile) }}" alt="profile" class="rounded-circle w-75" />
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $user->name }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ $user->email }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                Rp. {{ number_format($user->saldo, 0, ',', '.') }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                {{ number_format($user->point, 0, ',', '.') }} Point
                            </div>
                        </td>
                        {{-- <td>
                            <div class="d-flex">
                                @if ($user->status == 'aktif')
                                <div class="badge rounded-pill bg-info w-100">{{ $user->status }}
                                </div>
                                @elseif ($user->status == 'tidak aktif')
                                <div class="badge rounded-pill bg-secondary w-100">{{ $user->status }}</div>
                                @endif
                            </div>
                        </td> --}}
                        <td>
                            <div class="d-flex">
                                {{ $user->created_at }}
                            </div>
                        </td>
                        {{-- <td>
                            <div class="d-flex">
                                {{ $user->updated_at }}
                            </div>
                        </td> --}}
                        <td>
                            <form id="deleted{{ $user->id }}" action="{{ route('user.destroy', $user->id) }}"
                                method="post">
                                @csrf
                                @method('delete')
                                <a href="javascript:void(0)" class="btn btn-sm btn-danger" id="btn-delete"
                                    data-id="{{ $user->id }}" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                    data-bs-placement="top" data-bs-html="true" title="<span>Hapus Data</span>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                </a>
                            </form>
                        </td>
                    </tr>
                    @include('admin.user.delete')
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection