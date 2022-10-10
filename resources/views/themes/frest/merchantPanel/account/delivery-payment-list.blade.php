@extends('themes.frest.partials.merchantPanel.app')
@section('title', 'Merchant Delivery Payment List')
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
    {{-- {!! $html->scripts() !!} --}}
@endsection


@section('content')
    <div class="card">
        @include('themes.frest.partials.alerts')
        <h5 class="card-header">Delivery Payment List</h5>
        <form class="card-body">
            <div class="row g-3">
                <div class="col-md-5">
                    <label class="form-label" for="multicol-country">Select Delivery Payment Status</label>
                    <select id="multicol-country" class="select2 form-select" data-allow-clear="true"
                        data-placeholder="Select Delivery Payment Status">
                        <option value="">Select Delivery Payment Status</option>
                        <option value="0">Select Delivery Payment Type </option>
                        <option value="1">Delivery Payment Send </option>
                        <option value="2"> Delivery Payment Accept </option>
                        <option value="3"> Delivery Payment Cancel </option>
                    </select>
                </div>
                <div class="col-md-5">
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

        <div class="card-datatable table-responsive">
            {{ $dataTable->table() }}
        </div>
    </div>
@endsection

@section('inline-js')
    {{ $dataTable->scripts() }}
    <script>
        $('.flatpickr-range').flatpickr({
            mode: 'range'
        });
    </script>
@endsection
