@extends('themes.frest.layouts.app')


@section('css')
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
@endsection

@section('js')
    <script src="{{ asset('frest/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('frest/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('frest/js/forms-selects.js') }}"></script>
@endsection

@section('content')
    <!-- Users List Table -->
    <div class="card">

        @include('themes.frest.partials.alerts')

        <div class="card-header">
            <h5 class="card-title">Create New Warehouse User</h5>
            <a href="{{ route('admin.team.branch.users') }}" class="btn btn-sm btn-primary"> <span
                    class="tf-icon bx bx-left-arrow-alt bx-xs"></span>Go back</a>
        </div>
    </div>
    <div class="card mt-4">

        <form action="{{ route('admin.team.warehouse.user.modify') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $user->id }}">
            <div class=" card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="User Name" name="name"
                        required />
                </div>

                <div class="mb-3">
                    <label for="fulladdress" class="form-label">Full Address</label>
                    <input type="text" class="form-control" id="fulladdress" placeholder="User Address" name="address" />
                </div>
                <div class="mb-3">
                    <label class="form-label w-100" for="warehouse_id">Warehouse</label>
                    <select id="warehouse_id" class="select2 form-select" data-allow-clear="true" required
                        name="warehouse_id" required>
                        <option value="">Select</option>
                        @foreach ($warehouses as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon11">+88</span>
                        <input type="number" class="form-control" placeholder="01700000000" aria-label="Phone"
                            aria-describedby="basic-addon11" id="phone" name="phone" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="User Email" name="email"
                        required />
                </div>

                <div class="mb-3">
                    <label for="usename" class="form-label">Username</label>
                    <input type="text" class="form-control" id="usename" placeholder="Username"
                        name="username"required />
                </div>


                <div class="mb-3">
                    <label for="images" class="form-label">Image</label>
                    <div class="input-group">
                        <input type="file" class="form-control" id="images" name="file">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="password"
                        name="password"required />
                </div>


                <div>
                    <button type="submit" class="btn btn-primary"> <span
                            class="tf-icon bx bx-right-arrow-alt bx-xs"></span>Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('inline-js')
@endsection
