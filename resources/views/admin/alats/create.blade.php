@extends('template-admin.navbar-footer')
@section('title', 'Add New Tool')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Add New Tool</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <form method="POST" action="{{ route('alats.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="userapps_id">Select User</label>
                                <select class="form-control" id="userapps_id" name="userapps_id" required>
                                    @foreach ($users as $user)
                                        @php
                                            // Check if user already has an alat associated
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
                            <button type="submit" class="btn btn-primary">Add Alat</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
