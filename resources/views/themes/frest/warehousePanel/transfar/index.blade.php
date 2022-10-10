@extends('themes.frest.partials.warehousePanel.app')
@section('title', 'Warehouse - Bookig Operation')

@section('css')
    <link rel="stylesheet" href="{{ asset('frest/vendor/css/pages/page-profile.css') }}">
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/select2/select2.css') }}" />
    <style>
        table.dataTable thead .sorting_asc_disabled:before {
            content: "" !important;
        }

        .sorting_asc_disabled.sorting_desc_disabled:after {
            content: "" !important;
        }

        .sorting_asc_disabled.sorting_desc_disabled:before {
            content: "" !important;
        }
    </style>
@endsection

@section('js')
    <script src="/frest/vendor/libs/datatables/jquery.dataTables.js"></script>
    <script src="/frest/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="/frest/vendor/libs/datatables-responsive/datatables.responsive.js"></script>
    <script src="/frest/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js"></script>
    <script src="/frest/vendor/libs/select2/select2.js"></script>
    {!! $dataTable->scripts() !!}
@endsection


@section('content')
    @include('themes.frest.partials.alerts')

    <!-- User Profile Content -->
    <form action="" method="POST">
        @csrf
        <div class="row">

            <div class="col-xl-4 col-lg-5 col-md-5">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="#" type="button" class="btn btn-secondary w-100">
                                    <span class="tf-icons bx bx-pie-chart-alt"></span>&nbsp; Send Operation
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('warehouse.transfar.recieve.operation') }}" type="button"
                                    class="btn btn-primary w-100">
                                    <span class="tf-icons bx bx-pie-chart-alt"></span>&nbsp; Receive Operation
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Parcel Receive In Warehouse -->
                <div class="card mb-4 receive-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Transfer Percel Operation</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label class="form-label" for="warehouse_id">Sender Warehouse</label>
                                <input type="text" class="form-control" id="warehouse_id" name=""
                                    value="{{ Auth::user()->warehouse->name }}" placeholder="John Doe" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="rider_id">Reciver Branch</label>
                                <select class="select2 form-select dst_branch_id" data-allow-clear="true"
                                    name="dst_branch_id" data-placeholder="Select Branch">
                                    <option value="">Select Branch</option>
                                    @foreach ($branches as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="total_parcel">Total Parcel</label>
                                <input type="text" class="form-control total_parcel_receive" id="total_parcel"
                                    name="receive_total_parcel" name="" placeholder="0" disabled>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>

            <div class="row col-md-8">
                <div class="col-md-12">
                    <div class="card shadow-none bg-light border border-primary mb-3">
                        <div class="card-body p-2" style="min-height: 200px">
                            <div class="row g-2 mb-1" id="showParcels">



                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Transfer Parcel List </h5>

                            <button class="btn btn-success addParcelBtn" type="button">
                                Add Percel
                            </button>


                        </div>
                        <div class="table-responsive text-nowrap m-3">
                            {{ $dataTable->table(['class' => 'table']) }}

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </form>
    <!--/ User Profile Content -->

    <!-- Modal -->
    {{-- //modal show --}}
    <div class="modal fade" id="viewModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" id="showData">

            </div>
        </div>
    </div>
@endsection

@section('inline-js')
    <script>
        $('#booking_table').on('click', '.view-modal', function() {
            var parcel_id = $(this).attr('parcel_id');
            var url = "{{ route('warehouse.booking.parcel.viewParcel', ':parcel_id') }}";
            url = url.replace(':parcel_id', parcel_id);
            $('#showData').html('');
            if (parcel_id.length != 0) {
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
        $('.assign-card').hide();
        $('.selectType').on('change', function() {
            type = $(this).val();
            if ($(this).val() == 'pickup') {
                $('.receive-card').show();
                $('.assign-card').hide();
            } else {
                $('.receive-card').hide();
                $('.assign-card').show();
            }

            $('#booking_table').on('preXhr.dt', function(e, settings, data) {
                data.dst_branch_id = '';
            });
            $("#booking_table").DataTable().ajax.reload();
        });
        $('.warehouse-select').hide();
        $('.selectWarehouse').on('change', function() {
            if ($(this).val() == 'yes') {
                $('.warehouse-select').show();
            } else {
                $('.warehouse-select').hide();
            }
        });


        $('.dst_branch_id').on('select2:select', function(event) {
            $('#booking_table').on('preXhr.dt', function(e, settings, data) {
                data['dst_branch_id'] = event.params.data.id;
            });
            $('#booking_table').DataTable().ajax.reload();

        });

        $('#checkAllAssign').on('click', function() {
            if ($(this).is(':checked')) {
                $('.checkboxPercel').prop('checked', true);
            } else {
                $('.checkboxPercel').prop('checked', false);
            }
        });
        let globalParcel = []

        $('.addParcelBtn').on('click', function() {
            const parcel = $('.checkboxPercel:checked').map(function() {
                const checkParcel = globalParcel?.find(px => px.id == this.value)
                if (!checkParcel) {

                    globalParcel.push({
                        id: $(this).val(),
                        name: $(this).data('name'),
                        run_id: $(this).data('runid'),
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
                var html =
                    '<div class="col-md-4">' +
                    '<div class="bs-toast toast fade show"  aria-live="assertive" aria-atomic="true" >' +
                    '<div class="toast-header bg-success rounded">' +
                    '<div class="me-auto fw-semibold">' + p.name + '</div>' +
                    '<input type="hidden" name="parcels[]" value="' + p.id + '">' +
                    '<input type="hidden" name="runids[]" value="' + p.run_id + '">' +
                    '<div type="button" class="btn-close" onclick="removePercel($(this))" data-id="' + p
                    .id + '"></div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                $('#showParcels').append(html);
            })
            $('.total_parcel_receive').val(globalParcel.length)
            $('.send_total_parcel').val(globalParcel.length)


        });

        function removePercel(e) {
            e.parent().parent().parent().remove();
            $(".checkboxPercel").each(function() {
                if ($(this).val() == e.data('id')) {
                    $("#checkAllAssign").attr("checked", false);
                    $(this).attr("checked", false);
                }
            });
            globalParcel = globalParcel.filter(px => px.id != e.data('id'))
            $('.total_parcel_receive').val(globalParcel.length)
            $('.send_total_parcel').val(globalParcel.length)


        }
    </script>
@endsection
