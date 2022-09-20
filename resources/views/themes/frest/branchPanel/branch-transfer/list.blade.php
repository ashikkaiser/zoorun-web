@extends('themes.frest.partials.branchPanel.app')
@section('title', 'Branch - Generate Branch Transfer')

@section('css')
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/select2/select2.css') }}" />
@endsection

@section('js')
    <script src="/frest/vendor/libs/select2/select2.js"></script>
@endsection


@section('content')
    <!-- Merchnat List Table -->
    <div class="card">

        @include('themes.frest.partials.alerts')

        <h5 class="card-header">Generate Branch Transfer</h5>
        <form class="card-body" data-select2-id="21">
            <div class="row g-3" data-select2-id="20">
                <div class="col-md-6">
                    <label class="form-label" for="collapsible-state">Select Rider</label>
                    <div class="position-relative">
                        <select id="riderSelect" class="select2 form-select " data-allow-clear="true" name="rider_id"
                            data-placeholder="Select Rider" required>
                            <option value="">Select Branch</option>
                            @foreach ($branches as $branch)
                                <option value={{ $branch->id }} data-detials="{{ $branch }}">
                                    {{ $branch->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="collapsible-state">Select Date</label>
                    <input type="text" id="formtabs-birthdate" class="form-control dob-picker flatpickr-input active"
                        placeholder="YYYY-MM-DD">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-state">Branch Name</label>
                    <input type="text" class="form-control" placeholder="Branch Name" readonly>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-state">Branch Contact Number</label>
                    <input type="text" class="form-control" placeholder="Branch Contact Number" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="collapsible-state">Branch Address</label>
                    <input type="text" class="form-control" placeholder="Branch Address" readonly>
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="collapsible-state">Total Transfer Parcel</label>
                    <input type="text" class="form-control" placeholder="Total Transfer Parcel" readonly>
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
