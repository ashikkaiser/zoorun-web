@extends('themes.frest.partials.branchPanel.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="/frest/vendor/libs/flatpickr/flatpickr.css" />
@endsection

@section('js')
    <script src="/frest/vendor/libs/datatables/jquery.dataTables.js"></script>
    <script src="/frest/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="/frest/vendor/libs/datatables-responsive/datatables.responsive.js"></script>
    <script src="/frest/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js"></script>
    <script src="/frest/vendor/libs/flatpickr/flatpickr.js"></script>

    <script src="/frest/vendor/libs/select2/select2.js"></script>

    {!! $html->scripts() !!}
@endsection


@section('content')
    <!-- Merchnat List Table -->
    <div class="card">

        @include('themes.frest.partials.alerts')

        <h5 class="card-header">Generate Pickup Rider Run</h5>
        <form class="card-body" action="{{ route('branch.parcel.pickup.generate.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="collapsible-state">Select Rider</label>
                            <div class="position-relative">
                                <select id="riderSelect" class="select2 form-select " data-allow-clear="true"
                                    name="rider_id" data-placeholder="Select Rider" required>
                                    <option value="">Select Rider</option>
                                    @foreach ($riders as $rider)
                                        <option value={{ $rider->id }} data-detials="{{ $rider }}">
                                            {{ $rider->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Select Date</label>
                            <input type="text" id="formtabs-birthdate"
                                class="form-control date-picker flatpickr-input active" name="create_date_time"
                                placeholder="YYYY-MM-DD" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Rider Name</label>
                            <input type="text" class="form-control rider_name" placeholder="Rider Name" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Rider Contact Number</label>
                            <input type="text" class="form-control rider_number" placeholder="Rider Contact Number"
                                readonly>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Rider Address</label>
                            <input type="text" class="form-control rider_address" placeholder="Rider Address" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Total Parcel</label>
                            <input type="text" class="form-control total_percels" placeholder="Total Parcel" readonly>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Note</label>
                            <textarea class="form-control" name="notes" id="" cols="" rows="3"></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card shadow-none bg-light border border-primary mb-3">
                        <div class="card-body p-2" style="min-height: 340px">
                            <div class="row g-2 mb-1" id="showParcels">



                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Add Parcel form --}}
            <div class="mt-4">
                <div class="card shadow-none bg-light border border-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Add Parcel</h5>
                        <div class="row g-3">
                            <div class="col-md-5">
                                <label class="form-label" for="parcel-number">Order Number</label>
                                <input type="text" id="" class="form-control"
                                    placeholder="Enter Parcel Invoice Barcode">
                            </div>
                            <div class="col-md-5">
                                <label class="form-label" for="merchant-order-id">Merchant Order ID</label>
                                <input type="text" id="" class="form-control"
                                    placeholder="Enter Merchant Order ID">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary mt-4 w-100">
                                    <span class="tf-icons bx bx-search-alt-2"></span> Search
                                </button>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                {{-- <h5 class="card-title mb-0">Parcel List</h5> --}}

                                <button class="btn btn-success addParcelBtn" type="button">
                                    Add Percel
                                </button>


                            </div>

                            <div class="table-responsive text-nowrap  p-3">
                                {!! $html->table(['class' => 'table']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-4">
                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                <button type="reset" class="btn btn-label-secondary">Cancel</button>
            </div>
        </form>



    </div>
@endsection

@section('inline-js')
    <script>
        $(document).ready(function() {
            $('#riderSelect').on('select2:select', function(e) {
                const rider = JSON.parse(e.params.data.element.dataset.detials);
                $('.rider_name').val(rider.name);
                $('.rider_number').val(rider.phone);
                $('.rider_address').val(rider.address);
            })
        });
    </script>

    <script>
        $("#checkAllAssign").on("click", function() {
            $(".checkboxPercel").each(function() {
                if ($("#checkAllAssign").is(':checked')) {
                    $(this).attr("checked", true);
                } else {
                    $(this).attr("checked", false);
                }

            });
        });
        let globalParcel = []
        $('.addParcelBtn').on('click', function() {
            const parcel = $('.checkboxPercel:checked').map(function() {
                const checkParcel = globalParcel?.find(px => px.id == this.value)
                if (!checkParcel) {

                    globalParcel.push({
                        id: $(this).val(),
                        name: $(this).data('name'),
                    })
                } else {
                    alert('Parcel already added')
                }

                return true;
            }).get();
            if (parcel.length === 0) {
                alert('Please select parcel')
            }

            $('#showParcels').html(null);
            globalParcel.forEach(function(p) {
                console.log(p);
                var html =
                    '<div class="col-md-4">' +
                    '<div class="bs-toast toast fade show"  aria-live="assertive" aria-atomic="true" >' +
                    '<div class="toast-header bg-success rounded">' +
                    '<div class="me-auto fw-semibold">' + p.name + '</div>' +
                    '<input type="hidden" name="parcels[]" value="' + p.id + '">' +
                    '<div type="button" class="btn-close" onclick="removePercel($(this))" data-id="' + p
                    .id + '"></div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                $('#showParcels').append(html);
            })
            $('.total_percels').val(globalParcel.length)


        });

        function removePercel(e) {
            e.parent().parent().parent().remove();
            $(".checkboxPercel").each(function() {
                if ($(this).val() == e.data('id')) {
                    $("#selectAll").attr("checked", false);
                    $(this).attr("checked", false);
                }
            });
            globalParcel = globalParcel.filter(px => px.id != e.data('id'))
            $('.total_percels').val(globalParcel.length)


        }
    </script>
@endsection
