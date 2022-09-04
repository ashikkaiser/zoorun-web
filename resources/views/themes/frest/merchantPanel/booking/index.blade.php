@extends('themes.frest.partials.merchantPanel.app')
@section('title', 'Booking Parcel List')
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
    {{ $dataTable->scripts() }}
@endsection


@section('content')
    <div class="card">
        @include('themes.frest.partials.alerts')
        <h5 class="card-header">Booking Parcel List</h5>
        <form class="card-body">
            <div class="row g-3">
                <div class="col-md-2">
                    <label class="form-label" for="parcelStatus">Select Parcel Status</label>
                    <select id="parcelStatus" class="select2 form-select" data-allow-clear="true"
                        data-placeholder="Select Parcel Status">
                        <option value="">Select Parcel Status</option>
                        <option value="pickup-pending">Pickup Pending</option>

                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="invoice">Invoice Barcode</label>
                    <input type="text" class="form-control" id="parcel_id" placeholder="Invoice Barcode">
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="mOrderid">Merchant Order ID</label>
                    <input type="text" class="form-control" id="merchant_order_id" placeholder="Merchant Order ID">
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="customer-phone">Customer Phone</label>
                    <input type="text" class="form-control" id="customer_phone" placeholder="Customer Phone">
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="selectdate">Select Date</label>
                    <input type="text" id="date_range" class="form-control flatpickr-input flatpickr-range active"
                        placeholder="YYYY-MM-DD to YYYY-MM-DD">
                </div>
                <div class="col-md-2">
                    <div class="demo-inline-spacing mt-2">
                        <button type="submit" id="submit" class="btn btn-primary">Search</button>
                        <button type="reset" class="btn btn-label-danger">Reset</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="card-datatable table-responsive text-nowrap">
            {{ $dataTable->table(['class' => 'datatables-users table border-top']) }}
        </div>
    </div>
@endsection

@section('inline-js')


    <script>
        $('#booking-table').on('preXhr.dt', function(e, settings, data) {
            data.status = $('#parcelStatus').val();
            data.parcel_id = $('#parcel_id').val();
            data.merchant_order_id = $('#merchant_order_id').val();
            data.customer_phone = $('#customer_phone').val();
            data.date_range = $('#date_range').val();

        });
        $("#submit").on('click', function(e) {
            e.preventDefault();
            $('#booking-table').DataTable().ajax.reload();
        });
    </script>


    <script>
        $('.flatpickr-range').flatpickr({
            mode: 'range'
        });
    </script>

    <script>
        function cancel_pickup(id) {
            let text = "Press a button!\nEither OK or Cancel.";
            if (confirm(text) == true) {
                let url = "{{ route('merchant.parcel.booking.cancel', ':id') }}";
                url = url.replace(':id', id);
                $.get(url, function(data) {
                    $('#booking-table').DataTable().ajax.reload();
                });


            } else {

            }
        }

        function hold_pickup(id) {
            let text = "Press a button!\nEither OK or Cancel.";
            if (confirm(text) == true) {
                let url = "{{ route('merchant.parcel.booking.hold', ':id') }}";
                url = url.replace(':id', id);
                $.get(url, function(data) {
                    $('#booking-table').DataTable().ajax.reload();
                });
            }

        }

        function request_return(id) {
            let text = "Press a button!\nEither OK or Cancel.";
            if (confirm(text) == true) {
                let url = "{{ route('merchant.parcel.booking.requestReturn', ':id') }}";
                url = url.replace(':id', id);
                $.get(url, function(data) {
                    $('#booking-table').DataTable().ajax.reload();
                });
            }
        }
        $(".cancel_pickup").on('click', function() {
            alart('ok');
        })
    </script>
@endsection
