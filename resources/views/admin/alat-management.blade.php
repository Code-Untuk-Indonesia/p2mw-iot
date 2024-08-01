@extends('template-admin.navbar-footer')
@section('title', 'Manage Tools')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Manajemen Alat</h6>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#addToolModal">
                            Tambah Alat
                        </button>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tool
                                            Code</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            User</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alats as $alat)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $alat->kodealat }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $alat->userApp->name }}</p>
                                            </td>
                                            <td class="align-middle">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editToolModal{{ $alat->id }}">
                                                    Edit
                                                </button>
                                                <form action="{{ route('alats.destroy', $alat->id) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Edit Tool Modal -->
                                        <div class="modal fade" id="editToolModal{{ $alat->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editToolModalLabel{{ $alat->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editToolModalLabel{{ $alat->id }}">
                                                            Edit Tool</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST"
                                                            action="{{ route('alats.update', $alat->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="userapps_id">Select User</label>
                                                                <select class="form-control" id="userapps_id"
                                                                    name="userapps_id" required>
                                                                    @foreach ($users as $user)
                                                                        @php
                                                                            $hasAlat = $user->alat()->exists();
                                                                        @endphp
                                                                        @unless ($hasAlat || $user->UniqueID == $alat->userapps_id)
                                                                            <option value="{{ $user->UniqueID }}"
                                                                                {{ $alat->userapps_id == $user->UniqueID ? 'selected' : '' }}>
                                                                                {{ $user->name }}
                                                                            </option>
                                                                        @endunless
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="kodealat">Kode Alat</label>
                                                                <input type="text" class="form-control" id="kodealat"
                                                                    name="kodealat" value="{{ $alat->kodealat }}" required>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Update
                                                                Tool</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $alats->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addToolModal" tabindex="-1" role="dialog" aria-labelledby="addToolModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addToolModalLabel">Tambah Alat</h5>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('alats.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="userapps_id">Pilih Pengguna</label>
                                <select class="form-control" id="userapps_id" name="userapps_id" required>
                                    @foreach ($users as $user)
                                        @php
                                            $hasAlat = $user->alat()->exists();
                                        @endphp
                                        @unless ($hasAlat)
                                            <option value="{{ $user->UniqueID }}">{{ $user->name }}</option>
                                        @endunless
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kodealat">Kode Alat</label>
                                <input type="text" class="form-control" id="kodealat" name="kodealat" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Alat</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
