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
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Delivery Payment</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Merchant</label>
                                    <select id="merchant_id" class="select2 form-select" data-allow-clear="true" required
                                        data-placeholder="Select Merchant" name="merchant_id">
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
                                    <input type="text" class="form-control flatpickr-date active"
                                        placeholder="YYYY-MM-DD">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-email">Merchant Name</label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-phone">Merchant Contact Number</label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                            </div>
                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="basic-default-message">Merchant Address</label>
                            <textarea class="form-control" readonly></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-message">Total Payment Parcel</label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-message">Total Payment Amount</label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="basic-default-message">Merchant Address</label>
                            <textarea class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Generate</button>
                        <button type="submit" class="btn btn-danger">Reset</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl">
            <div class="card shadow-none bg-light border border-primary mb-4" style="min-height: 560px">
                <div class="card-body">
                </div>
            </div>
        </div>
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
                    <h5 class="card-header">Parcel List</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th><input type="checkbox" class="form-check-input"></th>
                                    <th>Invoice No</th>
                                    <th>Merchant Order</th>
                                    <th>Merchant Name</th>
                                    <th>Contact Number</th>
                                    <th>Customer</th>
                                    <th>Collected</th>
                                    <th>Weight Charge</th>
                                    <th>Delivery</th>
                                    <th>COD Charge</th>
                                    <th>Payable</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <th><input type="checkbox" class="form-check-input"></th>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('inline-js')
    <script>
        $('.select2').select2();
        $('.flatpickr-date').flatpickr({
            // mode: 'date'
            dateFormat: 'Y-m-d'
        });
    </script>
@endsection
