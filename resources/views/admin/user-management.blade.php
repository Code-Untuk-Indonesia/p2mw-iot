@extends('template-admin.navbar-footer')
@section('title', 'User Management')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Manajemen Pengguna</h6>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
                            Tambah Pengguna
                        </button>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Nama</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Email</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Terdaftar</th>
                                        <th class="text-secondary opacity-7 text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="align-middle text-center">
                                                <div class="px-2 py-1">
                                                    <img src="{{ url('storage/' . $user->profile_picture) }}" class="avatar avatar-sm me-3 rounded-circle" alt="user1">
                                                    <div class="d-flex flex-column justify-content-center text-center">
                                                        <a href="javascript:;" class="mb-0 text-sm">{{ $user->name }}</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="javascript:;" class="text-xs font-weight-bold mb-0">{{ $user->email }}</a>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    <i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($user->created_at)->format('H:i') }}
                                                    <br>
                                                    <i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($user->created_at)->locale('id')->translatedFormat('l, d F Y') }}
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                    Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-center mt-3 mb-3">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Tambah Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('userapp.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Pengguna</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
