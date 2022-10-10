@extends('themes.frest.layouts.app')
@section('title', 'Admin - Edit Merchant')


@section('css')
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
@endsection

@section('js')
    <script src="{{ asset('frest/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('frest/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('frest/js/forms-selects.js') }}"></script>
@endsection

@section('content')
    <!-- Users List Table -->
    <div class="card">

        @include('themes.frest.partials.alerts')

        <div class="card-header">
            <h5 class="card-title">Edit New Merchant</h5>
            <a href="{{ route('admin.team.merchant') }}" class="btn btn-sm btn-primary"> <span
                    class="tf-icon bx bx-left-arrow-alt bx-xs"></span>Go back</a>
        </div>
    </div>
    <div class="card mt-4">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit New Merchant</h4>
            </div>
            <div class="card-body">
                <form class="form" method="POST" id="jquery-val-form" enctype="multipart/form-data"
                    action="{{ route('admin.team.merchant.modify') }}" novalidate="novalidate">
                    @csrf
                    <input type="hidden" name="id" value="{{ $merchant->id }}">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6 col-12 mb-3">
                                <label class="form-label required" for="fullname">Full Name</label>
                                <input type="text" id="fullname" class="form-control" name="name"
                                    value="{{ $merchant->name }}" placeholder="Full Name" required>

                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label class="form-label" for="company">Company Name</label>
                                <div class="input-group">
                                    <input type="text" id="company" class="form-control" name="company" required
                                        value="{{ $merchant->company }}" placeholder="Company Name">

                                </div>
                            </div>
                            <div class="col-md-6 col-12 mb-2 mb-3">
                                <label class="form-label" for="personal_address">Full Address</label>
                                <textarea class="form-control" name="personal_address" rows="3" placeholder="Full Address" spellcheck="false"
                                    value="{{ $merchant->personal_address }}" id="personal_address" required style="color: rgb(48, 65, 86);">{{ $merchant->personal_address }}</textarea>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label class="form-label" for="company_address">Business Address</label>
                                <textarea class="form-control" name="company_address" rows="3" placeholder="Business Address" id="company_address"
                                    spellcheck="false" style="color: rgb(48, 65, 86);">{{ $merchant->company_address }}</textarea>
                            </div>

                            <div class="col-md-3 col-12 mb-3">
                                <label class="form-label" for="district_id">District</label>
                                <select class="district_id form-control select2" name="district_id" data-allow-clear="true"
                                    data-placeholder='Select District' id="district" required>
                                    <option value="">Select District</option>
                                    @foreach ($districts as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-12 mb-3">
                                <label class="form-label" for="zone_id">Zone</label>
                                <div class="form-group">
                                    <select class="select2 form-control zone_id" name="zone_id" id="zone"
                                        data-allow-clear="true" data-placeholder="Select Zone" required>
                                        <option value="">Select Zone</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-12 mb-3">
                                <label class="form-label" for="area_id">Area</label>
                                <div class="form-group">
                                    <select class="form-control area_id select2" name="area_id" id="area"
                                        data-allow-clear="true" data-placeholder="Select Area" required>
                                        <option value="">Select Area</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-12 mb-3">
                                <label class="form-label" for="branch_id">Branch</label>
                                <div class="form-group">
                                    <select class="form-control branch_id select2" name="branch_id" required
                                        data-allow-clear="true" data-placeholder="Select Branch">
                                        <option value="">Select Branch</option>
                                        @foreach ($branchs as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-12 mb-3">
                                <label class="form-label" for="phone">Contact Number</label>
                                <div class="input-group">
                                    <input type="text" id="phone" value="{{ $merchant->phone }}"
                                        class="form-control" name="phone" required placeholder="Contact Number">
                                </div>
                            </div>
                            <div class="col-md-4 col-12 mb-3">
                                <label class="form-label" for="facebook">Facebook URL</label>
                                <div class="input-group">
                                    <input type="text" id="facebook" class="form-control" name="facebook"
                                        placeholder="Facebook URL">
                                </div>
                            </div>
                            <div class="col-md-4 col-12 mb-3">
                                <label class="form-label" for="website">Website URL</label>
                                <div class="input-group">
                                    <input type="text" id="website" class="form-control" name="website"
                                        placeholder="Website URL">
                                </div>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label class="form-label" for="profile_image">Choose Image</label>
                                <div class="input-group">
                                    <input type="file" class="form-control" id="profile_image" name="profile_image">
                                </div>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label class="form-label" for="cod_charge">COD %</label>
                                <div class="input-group">
                                    <input type="text" id="cod_charge" class="form-control" name="cod_charge"
                                        placeholder="COD %">

                                </div>
                            </div>
                            <div class="col-md-4 col-12 mb-3">
                                <label class="form-label" for="email">Email</label>
                                <div class="input-group">
                                    <input value="{{ $merchant->email }}" type="email" id="email"
                                        class="form-control" name="email" required placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-4 col-12 mb-3">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group">
                                    <input type="text" id="password" value="{{ $merchant->password }}"
                                        class="form-control" name="password" required placeholder="Password">
                                </div>
                            </div>
                            <div class="col-md-4 col-12 mb-3">
                                <label class="form-label" for="email">Status</label>
                                <select name="is_active" class="form-select">
                                    <option value="pending" {{ $merchant->is_active == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>
                                    <option value="active"{{ $merchant->is_active == 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="inactive"{{ $merchant->is_active == 'is_active' ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>
                            </div>
                        </div>
                        <hr />

                        <div class="row">
                            <div class="col-12">
                                <h6 class="py-50">Service Area Charge</h6>
                            </div>
                            @foreach ($serviceAreas as $key => $item)
                                <input type="hidden" name="service_area_id[]" id="service_area_id{{ $key }}"
                                    value="{{ $item->id }}">
                                <div class="col-md-4 col-12">
                                    <label class="form-label"
                                        for="service_charrge_{{ $key }}">{{ $item->name }}
                                        Charge</label>
                                    <div class="input-group">

                                        <input type="number" id="service_charrge_{{ $key }}"
                                            class="form-control" name="charge[]"
                                            placeholder="{{ $item->name }} Charge">



                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-12">
                                <h6 class="py-50">Service Area Return Charge</h6>
                            </div>
                            @foreach ($serviceAreas as $key => $item)
                                <div class="col-md-4 col-12 mb-3">
                                    <label class="form-label"
                                        for="return_charge_{{ $key }}">{{ $item->name }} Return
                                        Charge</label>
                                    <div class="form-label-group ">

                                        <input type="text" id="return_charge_{{ $key }}"
                                            class="form-control" name="return_charge[]"
                                            placeholder="{{ $item->name }} Return Charge">


                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <h6 class="py-50">Banking Information</h6>
                            </div>
                            <div class="col-md-4 col-12 mb-3">
                                <label class="form-label" for="bank_acc_name">Bank Account Name</label>

                                <div class="input-group">
                                    <input type="text" id="bank_acc_name" class="form-control" name="bank_acc_name"
                                        placeholder="Bank Account Name">


                                </div>
                            </div>
                            <div class="col-md-4 col-12 mb-3">
                                <label class="form-label" for="bank_acc_number">Bank Account Number</label>

                                <div class="input-group">

                                    <input type="text" id="bank_acc_number" class="form-control"
                                        name="bank_acc_number" placeholder="Bank Account Number">

                                </div>
                            </div>
                            <div class="col-md-4 col-12 mb-3">
                                <label class="form-label" for="bank_name">Bank Name</label>

                                <div class="input-group">
                                    <input type="text" id="bank_name" class="form-control" name="bank_name"
                                        placeholder="Bank Name">


                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <label class="form-label" for="bkash">BKash Number</label>

                                <div class="input-group">

                                    <input type="text" id="bkash" class="form-control" name="bkash"
                                        placeholder="BKash Number">

                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <label class="form-label" for="nagad">Nagad Number</label>

                                <div class="input-group">

                                    <input type="text" id="nagad" class="form-control" name="nagad"
                                        placeholder="Nagad Number">

                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <label class="form-label" for="rocket">Rocket Number</label>

                                <div class="input-group">

                                    <input type="text" id="rocket" class="form-control" name="rocket"
                                        placeholder="Rocket Number">

                                </div>
                            </div>


                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-12">
                                <h6 class="py-50">ID Proof</h6>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="nid">NID Card</label>
                                    <div class="input-group">

                                        <input type="file" class="form-control" id="nid_image_url"
                                            name="nid_image_url">

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="trade_license_image_url">Choose Trade
                                        License</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="trade_license_image_url"
                                            name="trade_license_image_url">

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label" for="tin_certificate_image_url">Choose TIN
                                    Certificate</label>
                                <div class="input-group">
                                    <input type="file" class="form-control" id="tin_certificate_image_url"
                                        name="tin_certificate_image_url">

                                </div>

                            </div>

                        </div>

                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mr-1">Submit</button>
                            <button type="reset" class="btn btn-light-secondary">Reset</button>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
@endsection

@section('inline-js')
    <script type="text/javascript">
        $('#district').on('select2:select', function(e) {
            $('#zone').empty().trigger('change');
            $('#area').empty().trigger('change');
            fetch(`{{ route('admin.application.getzone') }}?district=${e.target.value}`)
                .then(async res => await res.json())
                .then(data => {
                    var defaultOption = new Option("", "", true, true);
                    $('#zone').append(defaultOption).trigger('change');
                    data.map(item => {
                        var newOption = new Option(item.name, item.id, true, false);
                        $('#zone').append(newOption).trigger('change');
                    })
                }).catch(err => {
                    console.log(err)
                })
        });

        $('#zone').on('select2:select', function(e) {
            $('#area').empty().trigger('change');
            fetch(`{{ route('admin.application.getarea') }}?zone=${e.target.value}`)
                .then(async res => await res.json())
                .then(data => {
                    var defaultOption = new Option("", "", true, true);
                    $('#area').append(defaultOption).trigger('change');
                    data.map(item => {
                        var newOption = new Option(item.name, item.id, true, false);
                        $('#area').append(newOption).trigger('change');
                    })
                }).catch(err => {
                    console.log(err)
                })
        });
    </script>
@endsection
