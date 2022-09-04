@extends('themes.frest.partials.branchPanel.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/flatpickr/flatpickr.css') }}" />
@endsection

@section('js')
    <script src="/frest/vendor/libs/moment/moment.js"></script>
    <script src="/frest/vendor/libs/datatables/jquery.dataTables.js"></script>
    <script src="/frest/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="/frest/vendor/libs/datatables-responsive/datatables.responsive.js"></script>
    <script src="/frest/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js"></script>
    <script src="/frest/vendor/libs/select2/select2.js"></script>
    <script src="/frest/vendor/libs/flatpickr/flatpickr.js"></script>

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
                    <label class="form-label" for="merchant-id">Select Merchant</label>
                    <select id="merchant_id" class="select2 form-select" data-allow-clear="true" required
                        data-placeholder="Select Merchant" name="merchant_id">
                        <option value="">Select Merchant</option>
                        @foreach ($merchants as $merchants)
                            <option value="{{ $merchants->id }}">{{ $merchants->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="delivery-type">Delivery Payment Type</label>
                    <select id="delivery_type" class="select2 form-select" data-allow-clear="true" required
                        data-placeholder="Select Delivery Payment Typ" name="delivery_type">
                        <option value="">Select Delivery Payment Typ</option>
                        <option value="1">Delivery Payment Send Merchant </option>
                        <option value="2">Merchant Accept </option>
                        <option value="3">Merchant Reject </option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="multicol-country">From Date</label>
                    <input type="text" class="form-control flatpickr-input" placeholder="YYYY-MM-DD to YYYY-MM-DD">
                </div>
                {{-- <div class="col-md-2">
                    <label class="form-label" for="multicol-country">To Date</label>
                    <input type="text" class="form-control dob-picker flatpickr-input active"
                        placeholder="YYYY-MM-DD">
                </div> --}}
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
    <script>
        $('.select2').select2();
        $('.flatpickr-input').flatpickr({
            mode: 'range'
            // dateFormat: 'Y-m-d'
        });
    </script>
@endsection
