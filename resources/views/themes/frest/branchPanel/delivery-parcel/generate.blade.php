@extends('themes.frest.partials.branchPanel.app')
@section('title', 'Branch Delivery Parcel List')

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
    <script src="/frest/vendor/libs/datatables-buttons/datatables-buttons.js"></script>
    <script src="/frest/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js"></script>
    <script src="/frest/vendor/libs/jszip/jszip.js"></script>
    <script src="/frest/vendor/libs/pdfmake/pdfmake.js"></script>
    <script src="/frest/vendor/libs/datatables-buttons/buttons.html5.js"></script>
    <script src="/frest/vendor/libs/datatables-buttons/buttons.print.js"></script>
    <script src="/frest/vendor/libs/select2/select2.js"></script>
    <script src="/frest/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
    <script src="/frest/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
    <script src="/frest/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>
    <script src="/frest/vendor/libs/cleavejs/cleave.js"></script>
    <script src="/frest/vendor/libs/cleavejs/cleave-phone.js"></script>
    {{-- {!! $html->scripts() !!} --}}
@endsection


@section('content')
    <!-- Merchnat List Table -->
    <div class="card">

        @include('themes.frest.partials.alerts')

        <h5 class="card-header">Generate Delivery Rider Run</h5>
        <form class="card-body" data-select2-id="21">
            <div class="row g-3" data-select2-id="20">
                <div class="col-md-6" data-select2-id="49">
                    <label class="form-label" for="collapsible-state">Select Rider</label>
                    <div class="position-relative"><select id="multicol-country"
                            class="select2 form-select select2-hidden-accessible" data-allow-clear="true"
                            data-select2-id="multicol-country" tabindex="-1" aria-hidden="true">
                            <option value="" data-select2-id="2">Select</option>
                            <option value="Australia" data-select2-id="29">Australia</option>
                            <option value="Bangladesh" data-select2-id="30">Bangladesh</option>
                            <option value="Belarus" data-select2-id="31">Belarus</option>
                        </select><span
                            class="select2 select2-container select2-container--default select2-container--above select2-container--focus"
                            dir="ltr" data-select2-id="1" style="width: 468.25px;"><span class="selection"><span
                                    class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true"
                                    aria-expanded="false" tabindex="0" aria-disabled="false"
                                    aria-labelledby="select2-multicol-country-container"><span
                                        class="select2-selection__rendered" id="select2-multicol-country-container"
                                        role="textbox" aria-readonly="true"><span
                                            class="select2-selection__placeholder">Select value</span></span><span
                                        class="select2-selection__arrow" role="presentation"><b
                                            role="presentation"></b></span></span></span><span class="dropdown-wrapper"
                                aria-hidden="true"></span></span></div>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="collapsible-state">Select Date</label>
                    <input type="text" id="formtabs-birthdate" class="form-control dob-picker flatpickr-input active"
                        placeholder="YYYY-MM-DD">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-state">Rider Name</label>
                    <input type="text" class="form-control" placeholder="Rider Name" readonly>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-state">Rider Contact Number</label>
                    <input type="text" class="form-control" placeholder="Rider Contact Number" readonly>
                </div>
                <div class="col-md-5">
                    <label class="form-label" for="collapsible-state">Rider Address</label>
                    <input type="text" class="form-control" placeholder="Rider Address" readonly>
                </div>
                <div class="col-md-1">
                    <label class="form-label" for="collapsible-state">Total Parcel</label>
                    <input type="text" class="form-control" placeholder="Total Parcel" readonly>
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="collapsible-state">Note</label>
                    <textarea class="form-control" name="" id="" cols="" rows="3"></textarea>
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
                            <h5 class="card-header">Parcel List</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr class="text-nowrap">
                                            <th><input type="checkbox" class="form-check-input"></th>
                                            <th>Invoice No</th>
                                            <th>Merchant Order</th>
                                            <th>Merchant Name</th>
                                            <th>Merchant Number</th>
                                            <th>Merchant Address</th>
                                            <th>Customer Name</th>
                                            <th>Customer Number</th>
                                            <th>Action</th>
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
                                        </tr>
                                    </tbody>
                                </table>
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
@endsection
