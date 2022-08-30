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
            <h5 class="card-title">Edit Beranch</h5>
            <a href="{{ route('admin.team.branch') }}" class="btn btn-sm btn-primary"> <span
                    class="tf-icon bx bx-left-arrow-alt bx-xs"></span>Go back</a>
        </div>
    </div>
    <div class="card mt-4">

        <form action="{{ route('admin.team.warehouse.modify') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class=" card-body">
                <input type="hidden" name="id" value="{{ $warehouse->id }}">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Warehouse Name"
                                value="{{ $warehouse->name }}" name="name" required />
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Address</label>
                            <input type="text" class="form-control" id="name" placeholder="Warehouse Address"
                                value="{{ $warehouse->address }}" name="address" required />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label w-100" for="Branch">Branch</label>
                        <select id="Branch" class="select2 form-select" data-allow-clear="true" required name="branch_id"
                            required>
                            <option value="">Select</option>
                            @foreach ($branchs as $item)
                                <option value="{{ $item->id }}"
                                    {{ $warehouse->branch_id === $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary"> <span
                            class="tf-icon bx bx-right-arrow-alt bx-xs"></span>Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
