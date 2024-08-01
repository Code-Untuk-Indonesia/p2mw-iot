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

        <div class="row mt-4" id="realtime-data-container">

        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            function fetchRealtimeData() {
                $.ajax({
                    url: '/api/realtime-data',
                    method: 'GET',
                    success: function(data) {
                        $('#realtime-data-container').empty();

                        data.forEach(function(item) {
                            const updatedAt = new Date(item.updated_at);
                            const hours = updatedAt.getHours().toString().padStart(2, '0');
                            const minutes = updatedAt.getMinutes().toString().padStart(2, '0');
                            const day = updatedAt.getDate().toString().padStart(2, '0');
                            const month = (updatedAt.getMonth() + 1).toString().padStart(2, '0');
                            const year = updatedAt.getFullYear();
                            const formattedDate = `${hours}:${minutes}, ${day}-${month}-${year}`;

                            const card = `
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">
                                                <i class="fas fa-chart-line"></i> Realtime Monitoring
                                            </p>
                                            <h5 class="font-weight-bolder mb-0">
                                                ${item.alat.kodealat}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">
                                            <i class="fas fa-map-marker-alt"></i> Latitude:
                                            <span class="text-secondary font-weight-bold">${item.lat}</span>
                                        </p>
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">
                                            <i class="fas fa-map-marker-alt"></i> Longitude:
                                            <span class="text-secondary font-weight-bold">${item.long}</span>
                                        </p>
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">
                                            <i class="fas fa-exclamation-triangle"></i> Kejadian:
                                            <span class="text-secondary font-weight-bold">${item.kejadian}</span>
                                        </p>
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">
                                            <i class="fas fa-clock"></i> Waktu:
                                            <span class="text-secondary font-weight-bold">${formattedDate}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                            $('#realtime-data-container').append(card);
                        });
                    },
                    error: function(xhr) {
                        console.error('Error fetching realtime data:', xhr);
                    }
                });
            }

            // Fetch data every 5 seconds
            setInterval(fetchRealtimeData, 5000);

            // Initial fetch
            fetchRealtimeData();
        </script>

    @endsection
