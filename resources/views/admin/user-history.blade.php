@extends('template-admin.navbar-footer')
@section('title', 'All User History')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>All Users History</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="form-group">
                            <label for="userSelect">Select User:</label>
                            <select class="form-control" id="userSelect" onchange="fetchUserHistory(this.value)">
                                <option value="">Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->UniqueID }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="userHistory">
                            <!-- User history will be loaded here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function fetchUserHistory(userId) {
            if (userId) {
                // Perform AJAX request to fetch user history based on selected user
                fetch(`/user/${userId}/history`)
                    .then(response => response.json())
                    .then(data => {
                        // Display fetched user history
                        const historyTable = document.getElementById('userHistory');
                        historyTable.innerHTML = `
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>History ID</th>
                                        <th>Event</th>
                                        <th>Location</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${data.histories.map(history => `
                                            <tr>
                                                <td>${history.id}</td>
                                                <td>${history.kejadian}</td>
                                                <td>${history.lokasi}</td>
                                                <td>${history.created_at}</td>
                                            </tr>
                                        `).join('')}
                                </tbody>
                            </table>
                        `;
                    })
                    .catch(error => console.error('Error fetching user history:', error));
            } else {
                // Clear history display if no user selected
                document.getElementById('userHistory').innerHTML = '';
            }
        }
    </script>
@endsection
