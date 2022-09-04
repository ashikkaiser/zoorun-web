@extends('themes.frest.partials.branchPanel.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
@endsection

@section('js')
    <script src="/frest/vendor/libs/moment/moment.js"></script>
    <script src="/frest/vendor/libs/datatables/jquery.dataTables.js"></script>
    <script src="/frest/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="/frest/vendor/libs/datatables-responsive/datatables.responsive.js"></script>
    <script src="/frest/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js"></script>
    <script src="/frest/vendor/libs/select2/select2.js"></script>

    {!! $html->scripts() !!}
@endsection


@section('content')
    <!-- Merchnat List Table -->
    <div class="card">

        @include('themes.frest.partials.alerts')
        <h5 class="card-header">Delivery Rider Run List</h5>
        <form class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label" for="multicol-country">Country</label>
                    <select id="multicol-country" class="select2 form-select" data-allow-clear="true">
                        <option value="">Select</option>
                        <option value="Australia">Australia</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Brazil">Brazil</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="multicol-country">Status</label>
                    <select id="multicol-country" class="select2 form-select" data-allow-clear="true">
                        <option value="">Select</option>
                        <option value="Australia">Australia</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Brazil">Brazil</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="multicol-country">From Date</label>
                    <input type="text" id="multicol-birthdate" class="form-control dob-picker flatpickr-input active"
                        placeholder="YYYY-MM-DD">
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="multicol-country">To Date</label>
                    <input type="text" id="multicol-birthdate" class="form-control dob-picker flatpickr-input active"
                        placeholder="YYYY-MM-DD">
                </div>
                <div class="col-md-2">
                    <div class="demo-inline-spacing mt-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <button type="reset" class="btn btn-label-danger">Reset</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="card-datatable table-responsive">
            {!! $html->table(['class' => 'datatables-users table border-top']) !!}
        </div>



    </div>
@endsection

@section('inline-js')
@endsection
