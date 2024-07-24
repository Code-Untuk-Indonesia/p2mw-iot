@extends('template-admin.navbar-footer')
@section('title', 'Dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Users</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $totalUsers }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Products</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $totalProducts }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            @foreach ($realtimeData as $data)
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Realtime Monitoring</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ $data->alat->kodealat }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Latitude:
                                        <span class="text-secondary font-weight-bold">{{ $data->lat }}</span>
                                    </p>
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Longitude:
                                        <span class="text-secondary font-weight-bold">{{ $data->long }}</span>
                                    </p>
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Kejadian:
                                        <span class="text-secondary font-weight-bold">{{ $data->kejadian }}</span>
                                    </p>
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Waktu:
                                        <span
                                            class="text-secondary font-weight-bold">{{ \Carbon\Carbon::parse($data->updated_at)->format('H:i, d M Y') }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
