@extends('themes.frest.partials.branchPanel.app')


@section('title', 'Pickup Rider List')


@section('css')
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="/frest/vendor/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="/frest/assets/vendor/libs/typeahead-js/typeahead.css" />
@endsection

@section('js')
    <script src="/frest/vendor/libs/moment/moment.js"></script>
    <script src="/frest/vendor/libs/datatables/jquery.dataTables.js"></script>
    <script src="/frest/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="/frest/vendor/libs/datatables-responsive/datatables.responsive.js"></script>
    <script src="/frest/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js"></script>
    <script src="/frest/vendor/libs/flatpickr/flatpickr.js"></script>

    <script src="/frest/vendor/libs/select2/select2.js"></script>
    <script src="/frest/assets/js/ui-popover.js"></script>
    <script src="/frest/assets/vendor/libs/typeahead-js/typeahead.js"></script>

    {{ $dataTable->scripts() }}
@endsection


@section('content')
    <!-- Merchnat List Table -->
    <div class="card">

        @include('themes.frest.partials.alerts')
        <h5 class="card-header">Pickup Rider Run List</h5>
        <form class="card-body" id="filter-form">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label" for="multicol-country">Rider</label>
                    <select class="select2 form-select" data-allow-clear="true" id="rider_id">
                        <option value="">Select Rider</option>
                        @foreach ($riders as $rider)
                            <option value="{{ $rider->id }}">{{ $rider->name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="status">Status</label>
                    <select id="status" class="select2 form-select" data-allow-clear="true">
                        <option value="">Select Status</option>
                        <option value="1">Run Create </option>
                        <option value="2">Run Start </option>
                        <option value="3">Run Complete </option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="multicol-country">From Date</label>
                    <input type="text" id="multicol-birthdate" class="form-control date-picker flatpickr-input active"
                        placeholder="YYYY-MM-DD">
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="multicol-country">To Date</label>
                    <input type="text" id="multicol-birthdate" class="form-control date-picker flatpickr-input active"
                        placeholder="YYYY-MM-DD">
                </div>
                <div class="col-md-2">
                    <div class="demo-inline-spacing mt-2">
                        <button type="submit" id="submit" class="btn btn-primary">Search</button>
                        <button type="reset" class="btn btn-label-danger" onclick="reset_form();">Reset</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="card-datatable table-responsive">
            {{ $dataTable->table(['class' => 'datatables-users table border-top']) }}
        </div>
    </div>
    {{-- //modal show --}}
    <div class="modal fade" id="viewModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" id="showData">

            </div>
        </div>
    </div>
    {{-- @include('themes.frest.branchPanel.pickup-rider.view-modal') --}}
@endsection

@section('inline-js')
    <script>
        //Reset form
        function reset_form() {
            $('#filter-form').trigger("reset");
            $('#filter-form').find('select').val('').trigger('change');
        }
    </script>
    <script>
        $('#pickupRiderList').on('click', '.run-start-btn', function() {
            var id = $(this).data('id');
            var url = '{{ route('branch.parcel.pickup.generate.start', ':id') }}';
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status == 'success') {
                        console.log(response)
                        $('#pickupRiderList').DataTable().ajax.reload();
                    } else {
                        alert('Something went wrong');
                    }
                }
            });
        });
    </script>

    <script>
        $('#pickupRiderList').on('click', '.view-modal', function() {
            var rider_run_id = $(this).attr('rider_run_id');
            var url = "{{ route('branch.parcel.pickup.viewModal', ':rider_run_id') }}";
            url = url.replace(':rider_run_id', rider_run_id);
            $('#showData').html('');
            if (rider_run_id.length != 0) {
                $.ajax({
                    cache: false,
                    type: "GET",
                    error: function(xhr) {
                        alert("An error occurred: " + xhr.status + " " + xhr.statusText);
                    },
                    url: url,
                    success: function(response) {
                        $('#showData').html(response);
                    },

                })
            }
        });
    </script>


    <script>
        $('#pickupRiderList').on('preXhr.dt', function(e, settings, data) {
            data.rider_id = $('#rider_id').val();
            data.status = $('#status').val();
            data.from_date = $('#from_date').val();
            data.to_date = $('#to_date').val();
        });

        $('#filter-form').on('submit', function(e) {
            e.preventDefault();
            $('#pickupRiderList').DataTable().ajax.reload();
        });
    </script>


    {{-- <script src="/frest/js/form-layouts.js"></script> --}}
@endsection
