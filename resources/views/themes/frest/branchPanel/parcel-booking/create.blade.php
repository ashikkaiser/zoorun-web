@extends('themes.frest.partials.branchPanel.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
@endsection

@section('js')
    <script src="/frest/vendor/libs/select2/select2.js"></script>

    {{-- {!! $html->scripts() !!} --}}
@endsection


@section('content')
    <!-- Merchnat List Table -->
    <div class="card">

        @include('themes.frest.partials.alerts')

        <h5 class="card-header">Booking New Parcel</h5>
        <form class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label" for="booking_type">Parcel Booking Type</label>
                    <select id="booking_type" class="select2 form-select" data-allow-clear="true" required
                        data-placeholder="Select Booking Type" name="booking_type">
                        <option value="">Select Booking Type</option>
                        <option value="1">General</option>
                        <option value="2">Condition</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="pickup">Pickup</label>
                    <select class="select2 form-select" data-allow-clear="true" data-placeholder="Select Pickup Type">
                        <option value="">Select Pickup Type</option>
                        <option value="Australia">Australia</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Brazil">Brazil</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="merchant_id">Merchant</label>
                    <select id="merchant_id" class="select2 form-select" data-allow-clear="true" required
                        data-placeholder="Select Merchant" name="merchant_id">
                        <option value="">Select Merchant</option>
                        <option value="1">General</option>
                        <option value="1">Condition</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="rider_id">Rider</label>
                    <select id="rider_id" class="select2 form-select" data-allow-clear="true" required name="rider_id"
                        data-placeholder="Select Rider">
                        <option value="">Select Rider</option>
                        <option value="1">General</option>
                        <option value="1">Condition</option>
                    </select>
                </div>

            </div>
            {{-- Sender information --}}
            <div class="mt-4">
                <div class="card shadow-none bg-light border border-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Sender Information</h5>
                        <div class="row g-3 mb-2">
                            <div class="col-md-3">
                                <label class="form-label" for="parcel-number">Sender Name</label>
                                <input type="text" id="" name="sender_name" class="form-control"
                                    placeholder="Sender Name">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="parcel-number">Contact Number</label>
                                <input type="text" id="" name="sender_contact_number" class="form-control"
                                    placeholder="Contact Number">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="parcel-number">Sender Address</label>
                                <textarea name="sender_address" class="form-control" placeholder="Sender Address" id="" rows="1"></textarea>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="parcel-number">National ID</label>
                                <input type="text" id="" name="sender_nid" class="form-control"
                                    placeholder="Enter Sender NID Number">
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label" for="sender_division_id">Select Division</label>
                                <select id="sender_division_id" class="select2 form-select" data-allow-clear="true"
                                    required data-placeholder="Select Division" name="sender_division_id">
                                    <option value="">Select Division</option>
                                    <option value="1">General</option>
                                    <option value="2">Condition</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="sender_district_id">Select District</label>
                                <select id="sender_district_id" class="select2 form-select" data-allow-clear="true"
                                    required data-placeholder="Select Division" name="sender_district_id">
                                    <option value="">Select District</option>
                                    <option value="1">General</option>
                                    <option value="2">Condition</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="sender_upazilla_id">Select Upazilla</label>
                                <select id="sender_upazilla_id" class="select2 form-select" data-allow-clear="true"
                                    required data-placeholder="Select Zone" name="sender_upazilla_id">
                                    <option value="">Select Upazilla</option>
                                    <option value="1">General</option>
                                    <option value="2">Condition</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="sender_area_id">Select Area</label>
                                <select id="sender_area_id" class="select2 form-select" data-allow-clear="true" required
                                    data-placeholder="Select Division" name="sender_area_id">
                                    <option value="">Select Area</option>
                                    <option value="1">General</option>
                                    <option value="2">Condition</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            {{-- Receiver Information --}}
            <div class="mt-4">
                <div class="card shadow-none bg-light border border-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Receiver Information</h5>
                        <div class="row g-3 mb-2">
                            <div class="col-md-3">
                                <label class="form-label" for="parcel-number">Receiver Name</label>
                                <input type="text" id="" name="receiver_name" class="form-control"
                                    placeholder="Receiver Name">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="parcel-number">Receiver Number</label>
                                <input type="text" id="" name="receiver_contact_number" class="form-control"
                                    placeholder="Contact Number">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="parcel-number">Receiver Address</label>
                                <textarea name="receiver_address" class="form-control" placeholder="Receiver Address" id=""
                                    rows="1"></textarea>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label" for="receiver_division_id">Select Division</label>
                                <select id="receiver_division_id" class="select2 form-select" data-allow-clear="true"
                                    required data-placeholder="Select Division" name="receiver_division_id">
                                    <option value="">Select Division</option>
                                    <option value="1">General</option>
                                    <option value="2">Condition</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="receiver_district_id">Select District</label>
                                <select id="receiver_district_id" class="select2 form-select" data-allow-clear="true"
                                    required data-placeholder="Select Division" name="receiver_district_id">
                                    <option value="">Select District</option>
                                    <option value="1">General</option>
                                    <option value="2">Condition</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="receiver_upazilla_id">Select Upazilla</label>
                                <select id="receiver_upazilla_id" class="select2 form-select" data-allow-clear="true"
                                    required data-placeholder="Select Zone" name="receiver_upazilla_id">
                                    <option value="">Select Upazilla</option>
                                    <option value="1">General</option>
                                    <option value="2">Condition</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="receiver_area_id">Select Area</label>
                                <select id="receiver_area_id" class="select2 form-select" data-allow-clear="true"
                                    required data-placeholder="Select Division" name="receiver_area_id">
                                    <option value="">Select Area</option>
                                    <option value="1">General</option>
                                    <option value="2">Condition</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            {{-- Destination Branch & Parcel Type --}}
            <div class="mt-4">
                <div class="card shadow-none bg-light border border-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Destination Branch & Parcel Type</h5>
                        <div class="row g-3 mb-2">
                            <div class="col-md-4">
                                <label class="form-label" for="destination_branch_id">Select Destination Branch</label>
                                <select id="destination_branch_id" class="select2 form-select" data-allow-clear="true"
                                    required data-placeholder="Select Destination Branch" name="destination_branch_id">
                                    <option value="">Select Destination Branch</option>
                                    <option value="1">General</option>
                                    <option value="2">Condition</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="delivery_type">Select Delivery Type</label>
                                <select id="delivery_type" class="select2 form-select" data-allow-clear="true" required
                                    data-placeholder="Select Delivery Type" name="delivery_type">
                                    <option value="">Select Delivery Type</option>
                                    <option value="od">Office Delivery (OD)</option>
                                    <option value="tod">Transit Office Delivery (TOD)</option>
                                    <option value="hd">Home Delivery (HD)</option>
                                    <option value="thd">Transit Home Delivery (THD)</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="parcel-number">Note</label>
                                <textarea name="note" class="form-control" placeholder="Enter Note" id="" rows="1"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Item Information --}}
            <div class="mt-4">
                <div class="card shadow-none bg-light border border-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Item Information</h5>
                        <div class="row g-3 mb-2">
                            <div class="col-md-3">
                                <label class="form-label" for="category_id">Item Category</label>
                                <select id="category_id" class="select2 form-select" data-allow-clear="true" required
                                    data-placeholder="Select Item Category" name="category_id">
                                    <option value="">Select Item Category</option>
                                    <option value="1">General</option>
                                    <option value="2">Condition</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="item_name">Item Name</label>
                                <input type="text" id="" name="item_name" class="form-control"
                                    placeholder="Item Name">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="item_unit_id">Item Unit</label>
                                <select id="item_unit_id" class="select2 form-select" data-allow-clear="true" required
                                    data-placeholder="Select Unit" name="item_unit_id">
                                    <option value="">Select Unit</option>
                                    <option value="1">General</option>
                                    <option value="2">Condition</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <label class="form-label" for="unit_price">Unit Price</label>
                                <input type="text" id="" name="unit_price" class="form-control"
                                    placeholder="Unit Price">
                            </div>
                            <div class="col-md-1">
                                <label class="form-label" for="item_quantity">Quantity</label>
                                <input type="number" id="" name="item_quantity" class="form-control"
                                    placeholder="Unit Price">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success mt-4 w-100">
                                    <span class="tf-icons bx bxs-cart-add"></span> Add
                                </button>
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
        $('.select2').select2();
    </script>
@endsection
