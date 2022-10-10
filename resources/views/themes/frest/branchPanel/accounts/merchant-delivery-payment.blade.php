@extends('themes.frest.partials.branchPanel.app')
@section('title', 'Branch Merchant Delivery Payment')

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

    {{-- {!! $html->scripts() !!} --}}
@endsection


@section('content')
    <!-- Merchnat List Table -->
    @include('themes.frest.partials.alerts')
    <div class="row">
        <form method="POST" action="{{ route('branch.accounts.merchant.delivery.payment.store') }}" class="row">
            <div class="col-xl">

                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Delivery Payment</h5>
                    </div>
                    <div class="card-body">

                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Merchant</label>
                                    <select id="merchant_id" class="select2 form-select" data-allow-clear="true" required
                                        id="merchant_id" data-placeholder="Select Merchant" name="merchant_id">
                                        <option value="">Select Merchant</option>
                                        @foreach ($merchants as $merchants)
                                            <option value="{{ $merchants->id }}">{{ $merchants->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-company">Date</label>
                                    <input type="text" name="payment_date" class="form-control flatpickr-date active"
                                        placeholder="YYYY-MM-DD">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-email">Merchant Name</label>
                                    <input type="text" class="form-control" name="name" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-phone">Merchant Contact Number</label>
                                    <input type="text" class="form-control" name="phone" readonly>
                                </div>
                            </div>
                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="basic-default-message">Merchant Address</label>
                            <textarea class="form-control" name="company_address" readonly></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-message">Total Payment Parcel</label>
                                    <input type="text" class="form-control total_percels" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-message">Total Delivery Charge</label>
                                    <input type="text" class="form-control total_delivery_charge" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-message">Total Collected Amount</label>
                                    <input type="text" class="form-control total_collected_amount" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-message">Total Payment Amount</label>
                                    <input type="text" name="total_payment_amount"
                                        class="form-control total_payment_amount" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-message">Discount Amount</label>
                                    <input type="number" name="discount_amount" class="form-control discount_amount">
                                </div>
                            </div>

                        </div>


                        <button type="submit" class="btn btn-primary">Generate</button>
                        <button type="submit" class="btn btn-danger">Reset</button>

                    </div>
                </div>
            </div>
            <div class="col-xl">
                <div class="card shadow-none bg-light border border-primary mb-4" style="min-height: 560px">
                    <div class="card-body">
                        <div class="card-body p-2" style="min-height: 340px">
                            <div class="row g-2 mb-1" id="showParcels">



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

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
                        <input type="text" id="" class="form-control" placeholder="Enter Merchant Order ID">
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
                    <div class="table-responsive text-nowrap">

                        {{ $dataTable->table(['class' => 'table']) }}


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('inline-js')
    {{ $dataTable->scripts() }}
    <script>
        $('.select2').select2();
        $('.flatpickr-date').flatpickr({
            // mode: 'date'
            dateFormat: 'Y-m-d'
        });
    </script>
    <script>
        $("#merchant-delivery-payment-table").on('preXhr.dt', function(e, settings, data) {
            data.merchant_id = $("#merchant_id").val();
        });
        $("#merchant_id").on('change', function() {
            var merchant_id = $(this).val();
            $.ajax({
                url: "{{ route('branch.merchant.get') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    merchant_id: merchant_id
                },
                success: function(data) {
                    $("input[name='name']").val(data.name);
                    $("input[name='phone']").val(data.phone);
                    $("textarea[name='company_address']").val(data.company_address);

                }
            });

            $('#merchant-delivery-payment-table').DataTable().ajax.reload();
        });
    </script>



    <script>
        $("#checkAllAssign").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        let globalParcel = []
        $('.addParcelBtn').on('click', function() {
            const parcel = $('input[name="checkbox[]"]:checked').map(function() {

                const checkParcel = globalParcel?.find(px => px.id == this.value)
                if (!checkParcel) {
                    globalParcel.push({
                        id: $(this).val(),
                        name: $(this).data('name'),
                        delivery_charge: $(this).data('delivery_charge'),
                        collected_amount: $(this).data('collected_amount'),
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
                    .id + '" data-delivery_charge="' + p.delivery_charge + '" data-collected_amount="' + p
                    .collected_amount + '"></div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                $('#showParcels').append(html);
            })
            $('.total_percels').val(globalParcel.length)
            $('.total_delivery_charge').val(globalParcel.reduce((a, b) => a + b.delivery_charge, 0))
            $('.total_collected_amount').val(globalParcel.reduce((a, b) => a + b.collected_amount, 0))
            $('.total_payment_amount').val($('.total_collected_amount').val() - $('.total_delivery_charge').val())



        })

        function removePercel(e) {
            e.parent().parent().parent().remove();
            $('.checkboxPercel').each(function() {

                if (parseInt($(this).val()) === e.data('id')) {
                    $(this).prop('checked', false);
                    $("#checkAllAssign").prop('checked', false);

                }
            });
            globalParcel = globalParcel.filter(px => px.id != e.data('id'))
            $('.total_percels').val(globalParcel.length)
            $('.total_delivery_charge').val(globalParcel.reduce((a, b) => a + b.delivery_charge, 0))
            $('.total_collected_amount').val(globalParcel.reduce((a, b) => a + b.collected_amount, 0))
            $('.total_payment_amount').val($('.total_collected_amount').val() - $('.total_delivery_charge').val())


        }


        $('.discount_amount').on('keyup', function() {
            let amount = $('.total_collected_amount').val() - $('.total_delivery_charge').val()
            $('.total_payment_amount').val(amount + parseInt($(this).val()))
        })
    </script>


@endsection
