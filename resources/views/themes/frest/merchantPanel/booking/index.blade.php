@extends('themes.frest.partials.merchantPanel.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/flatpickr/flatpickr.css') }}" />
@endsection

@section('js')
    <script src="/frest/vendor/libs/datatables/jquery.dataTables.js"></script>
    <script src="/frest/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="/frest/vendor/libs/datatables-responsive/datatables.responsive.js"></script>
    <script src="/frest/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js"></script>
    <script src="/frest/vendor/libs/flatpickr/flatpickr.js"></script>
    <script src="{{ asset('frest/vendor/libs/select2/select2.js') }}"></script>
    {!! $html->scripts() !!}
@endsection


@section('content')
    <div class="card">
        @include('themes.frest.partials.alerts')
        <h5 class="card-header">Booking Parcel List</h5>
        <form class="card-body">
            <div class="row g-3">
                <div class="col-md-2">
                    <label class="form-label" for="multicol-country">Select Parcel Status</label>
                    <select id="multicol-country" class="select2 form-select" data-allow-clear="true"
                        data-placeholder="Select Parcel Status">
                        <option value="">Select Parcel Status</option>
                        <option value="Australia">Australia</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Brazil">Brazil</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="multicol-country">Invoice Barcode</label>
                    <input type="text" class="form-control" placeholder="Invoice Barcode">
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="multicol-country">Merchant Order ID</label>
                    <input type="text" class="form-control" placeholder="Merchant Order ID">
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="multicol-country">Customer Phone</label>
                    <input type="text" class="form-control" placeholder="Customer Phone">
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="multicol-country">Select Date</label>
                    <input type="text" class="form-control flatpickr-input flatpickr-range active"
                        placeholder="YYYY-MM-DD to YYYY-MM-DD">
                </div>
                <div class="col-md-2">
                    <div class="demo-inline-spacing mt-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <button type="reset" class="btn btn-label-danger">Reset</button>
                    </div>
                </div>
            </div>
        </form>
        {{-- <div id="ant-table"></div> --}}
        <div class="card-datatable table-responsive">
            {!! $html->table(['class' => 'datatables-users table border-top']) !!}
        </div>
    </div>
@endsection

@section('inline-js')
    <script>
        $('.flatpickr-range').flatpickr({
            mode: 'range'
        });
    </script>
@endsection
