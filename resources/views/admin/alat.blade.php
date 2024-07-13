@extends('template-admin.navbar-footer')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Users Management</h6>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#addUserModal">
                            Tambah User Baru
                        </button>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Kode Alat</th>
                                        {{-- <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th> --}}
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Terdaftar</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Loop through users -->
                                    @foreach ($alat as $item) <!-- Mengganti variabel $user menjadi $item untuk konsistensi dengan data alat -->
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <!-- Menampilkan foto profil pengguna dari userapp -->
                                                <img src="{{ Storage::url($item->userapp->profile_picture) }}"
                                                     class="avatar avatar-sm me-3"
                                                     alt="{{ $item->userapp->name }}">

                                                <div class="d-flex flex-column justify-content-center">
                                                    <!-- Menampilkan nama pengguna dari userapp -->
                                                    <h6 class="mb-0 text-sm">{{ $item->userapp->name }}</h6>
                                                    <!-- Menampilkan email pengguna dari userapp -->
                                                    <p class="text-xs text-secondary mb-0">{{ $item->userapp->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <!-- Menampilkan Kode_alat -->
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->Kode_alat }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <!-- Tautan Edit -->
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                               data-toggle="tooltip" data-original-title="Edit user">
                                               Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Tambah User Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('userapp.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="profile_picture">Profile Picture</label>
                            <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                        </div>
                        @php
                            $generatedCode = uniqid();
                        @endphp
                        <div class="form-group">
                            <label for="kode_alat">Kode Alat</label>
                            <input type="text" class="form-control" id="kode_alat" name="kode_alat"
                                value="{{ $generatedCode }}" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
