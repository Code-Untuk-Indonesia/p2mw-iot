@extends('template-admin.navbar-footer')
@section('title', 'User History')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Riwayat Pengguna</h6>
                        <div>
                            <form method="GET" action="{{ route('history.index') }}">
                                <select class="form-control" name="userSelect" onchange="this.form.submit()">
                                    <option value="">Pilih Pengguna</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->UniqueID }}"
                                            {{ $selectedUser && $selectedUser->UniqueID == $user->UniqueID ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode
                                            Alat</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Kejadian</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($selectedUser && $histories->isNotEmpty())
                                        @foreach ($histories as $history)
                                            <tr>
                                                <td>{{ $history->alat->kodealat }}</td>
                                                <td>{{ $history->kejadian }}</td>
                                                <td>
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        <i class="fas fa-clock"></i>
                                                        {{ \Carbon\Carbon::parse($history->created_at)->format('H:i') }}
                                                        <br>
                                                        <i class="fas fa-calendar-alt"></i>
                                                        {{ \Carbon\Carbon::parse($history->created_at)->locale('id')->translatedFormat('l, d F Y') }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3" class="text-center">Tidak ada riwayat yang ditemukan untuk
                                                pengguna yang dipilih.
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
