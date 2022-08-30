@extends('themes.frest.partials.riderPanel.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
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

        {{-- <div class="card-header border-bottom d-flex">
            <h5 class="card-title">Parcel Pickup List</h5>
        </div> --}}
        <div class="nav-align-top mb-4">
            <ul class="nav nav-pills mb-3 nav-fill card-header" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link tabbtn active" role="tab" data-bs-toggle="tab"
                        data-id="running" data-bs-target="#delivery-pickup" aria-controls="delivery-pickup"
                        aria-selected="false">
                        <i class="tf-icons bx bx-user"></i> Running Delivery
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link tabbtn " role="tab" data-bs-toggle="tab"
                        data-bs-target="#delivery-request" aria-controls="delivery-request" aria-selected="true"
                        data-id="pending">
                        <i class="tf-icons bx bx-home"></i> Delivery Requests
                        <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger ms-1">3</span>
                    </button>
                </li>


            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="pickup-request" role="tabpanel">
                    <div class="table-responsive">
                        {!! $html->table(['class' => 'datatables-users table border-top']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="viewModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="showViewData">

            </div>
        </div>
    </div>


    <div class="modal fade" id="confirmModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="showConfirmData">

            </div>
        </div>
    </div>
    <div class="modal fade" id="rescheduleModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="showrescheduleData">

            </div>
        </div>
    </div>
    {{-- @include('themes.frest.riderPanel.parcel.modal.parcel_info') --}}
    </div>
@endsection

@section('inline-js')
    <script>
        $('#pickup-table').on('preXhr.dt', function(e, settings, data) {
            data.type = $('.tabbtn.active').data('id');
        });
        $('.tabbtn').on('click', function(ex) {
            $('#pickup-table').on('preXhr.dt', function(e, settings, data) {
                data.type = $('.tabbtn.active').data('id');
            });
            $('#pickup-table').DataTable().ajax.reload();
            console.log($(this).data('id'))
        });
    </script>


    <script>
        $('#pickup-table').on('click', '.view-modal', function() {
            var parcel_id = $(this).attr('parcel_id');
            var url = "{{ route('rider.parcel.delivery.viewParcel', ':parcel_id') }}";
            url = url.replace(':parcel_id', parcel_id);
            $('#showViewData').html('');
            if (parcel_id.length != 0) {
                $.ajax({
                    cache: false,
                    type: "GET",
                    error: function(xhr) {
                        alert("An error occurred: " + xhr.status + " " + xhr.statusText);
                    },
                    url: url,
                    success: function(response) {
                        $('#showViewData').html(response);
                    },

                })
            }
        });
    </script>
    <script>
        $('#pickup-table').on('click', '.confirm-modal', function() {
            var parcel_id = $(this).attr('parcel_id');
            var url = "{{ route('rider.parcel.delivery.confirmParcel', ':parcel_id') }}";
            url = url.replace(':parcel_id', parcel_id);
            $('#showConfirmData').html('');
            if (parcel_id.length != 0) {
                $.ajax({
                    cache: false,
                    type: "GET",
                    error: function(xhr) {
                        alert("An error occurred: " + xhr.status + " " + xhr.statusText);
                    },
                    url: url,
                    success: function(response) {
                        $('#showConfirmData').html(response);
                    },

                })
            }
        });
    </script>
    <script>
        $('#pickup-table').on('click', '.reschedule-modal', function() {
            var parcel_id = $(this).attr('parcel_id');
            var url = "{{ route('rider.parcel.delivery.rescheduleParcel', ':parcel_id') }}";
            url = url.replace(':parcel_id', parcel_id);
            $('#showrescheduleData').html('');
            if (parcel_id.length != 0) {
                $.ajax({
                    cache: false,
                    type: "GET",
                    error: function(xhr) {
                        alert("An error occurred: " + xhr.status + " " + xhr.statusText);
                    },
                    url: url,
                    success: function(response) {
                        $('#showrescheduleData').html(response);
                    },

                })
            }
        });
    </script>

    <script>
        $('#pickup-table').on('click', '.accept-parcel', function() {
            var parcel_id = $(this).attr('parcel_id');
            var url = "{{ route('rider.parcel.delivery.status', ':parcel_id') }}";
            url = url.replace(':parcel_id', parcel_id);

            if (parcel_id.length != 0) {
                $.ajax({
                    cache: false,
                    type: "POST",
                    url: url,
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'status': 'accepted'
                    },
                    error: function(xhr) {
                        alert("An error occurred: " + xhr.status + " " + xhr.statusText);
                    },

                    success: function(response) {
                        $('#pickup-table').DataTable().ajax.reload();
                    }
                })
            }
        });
    </script>


    <script>
        var myModalEl = document.getElementById('confirmModal')
        myModalEl.addEventListener('shown.bs.modal', function(event) {

            $('#confirmForm').submit(function(event) {

                event.preventDefault();

                var formData = $(this).serialize();
                var url = $(this).attr('action');
                console.log(formData)
                $.ajax({
                    cache: false,
                    type: "POST",
                    url: url,
                    data: formData,
                    error: function(xhr) {
                        alert("An error occurred: " + xhr.status + " " + xhr.statusText);
                    },

                    success: function(response) {
                        console.log(response);
                        $('#confirmModal').modal('hide');
                        $('#pickup-table').DataTable().ajax.reload();
                    }
                })
            });


            $('.send-otp').on('click', function(ex) {

                var url = "{{ route('rider.parcel.delivery.sendotp') }}";
                $.ajax({
                    cache: false,
                    type: "post",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'parcel_id': $(this).data('id')
                    },
                    url: url,
                    error: function(xhr) {
                        alert("An error occurred: " + xhr.status + " " + xhr.statusText);
                    },
                    success: function(response) {
                        console.log(response);
                        $('#otp-status').html('<span class="badge bg-success">' + response
                            .message + '</span>');

                    }

                })
            });


            $('.otp-submit').on('click', function(exx) {
                var url = "{{ route('rider.parcel.delivery.otpverify') }}";
                $.ajax({
                    cache: false,
                    type: "post",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'parcel_id': $(this).data('id'),
                        'otp': $('.confirmation_code').val()
                    },
                    url: url,
                    error: function(xhr) {
                        alert("An error occurred: " + xhr.status + " " + xhr.statusText);
                    },
                    success: function(response) {
                        console.log(response);
                        $('#otp-status').html('<span class="badge bg-success">' + response
                            .message + '</span>');

                    }

                })
            })

        })
    </script>
@endsection
