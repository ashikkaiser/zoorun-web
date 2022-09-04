@extends('themes.frest.partials.merchantPanel.app')

@section('title', 'New Parcel Booking')
@section('css')
    <link rel="stylesheet" href="/frest/vendor/libs/select2/select2.css" />
    <style>
        #map {
            height: 200px;
            width: 100%;
        }
    </style>
@endsection

@section('js')
    <script src="/frest/vendor/libs/select2/select2.js"></script>
@endsection


@section('content')
    <div class="row">


        @include('themes.frest.partials.alerts')

        <form action="{{ route('merchant.parcel.booking.store') }}" class="row" method="POST">
            @csrf

            <div class="card col-md-8">
                <h5 class="card-header">Booking New Parcel</h5>
                <div class="card-body">
                    {{-- <div id="example"></div> --}}
                    <div class="mt-4">
                        <div class="card shadow-none bg-light border border-primary mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Customer Information</h5>
                                <div class="row g-3 mb-2">
                                    <div class="col-md-4">
                                        <label class="form-label" for="customer_name">Customer Name</label>
                                        <input type="text" id="" name="customer_name" class="form-control"
                                            placeholder="Customer Name" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="customer_phone">Customer Contact Number</label>
                                        <input type="text" id="" name="customer_phone" class="form-control"
                                            placeholder="Customer Contact Number" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="delivery_address">Customer Address</label>
                                        <textarea name="delivery_address" class="form-control" id="sender_address" placeholder="Customer Address" rows="1"
                                            required> </textarea>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label" for="sender_district_id">Select District</label>
                                        <x-district-select id="district" name="district_id" next_id="#area" required />
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label" for="sender_area_id">Select Area</label>
                                        <select id="area" class="select2 form-select" data-allow-clear="true" required
                                            data-placeholder="Select Area" name="area_id">
                                            <option value="">Select Area</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 delivery_type">
                                        <label class="form-label" for="delivery_type">Delevery Type</label>
                                        <select id="delivery_type" class="select2 form-select" data-allow-clear="true"
                                            data-placeholder="Select Delivery Type" name="delivery_type">
                                            <option value="">Select Delivery Types</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card shadow-none bg-light border border-primary mb-3">
                        <div class="card-body">
                            <div id="map"></div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="card shadow-none bg-light border border-primary mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Parcel Information</h5>
                                <div class="row g-3 mb-2">
                                    <div class="col-md-4">
                                        <label class="form-label" for="merchant_order_id">Merchant Order ID</label>
                                        <input type="text" id="merchant_order_id" name="merchant_order_id"
                                            class="form-control" placeholder="Enter Merchant Order ID" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="weight_package_id">Select Weight Package</label>
                                        <select id="weight_packages" class="select2 form-select" data-allow-clear="true"
                                            required data-placeholder="Select Weight Package" name="weight_package_id">

                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="category_id">Select Item Category</label>
                                        <select id="category_id" class="select2 form-select" data-allow-clear="true"
                                            required data-placeholder="Select Item Category" name="category_id">
                                            <option value="">Select Item Category</option>
                                            @foreach ($item_categories as $item_category)
                                                <option value="{{ $item_category->id }}">
                                                    {{ $item_category->name }}-({{ $item_category->rate }} TK)</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label" for="product_details">Product(s) Brief</label>
                                        <textarea name="product_details" class="form-control" placeholder="Write Down Here..." id="product_details"
                                            rows="1" required></textarea>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" for="product_amount">Product Amount</label>
                                        <input type="number" id="product_amount" name="product_amount"
                                            class="form-control" placeholder="0.00" step="any" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" for="collection_amount">Total Collection
                                            Amount</label>
                                        <input type="number" id="collection_amount" name="collection_amount"
                                            step="any" class="form-control" placeholder="0.00" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" for="parcel-number">Remarks</label>
                                        <textarea name="remarks" class="form-control" placeholder="Write Down Here..." id="remarks" rows="1"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button class="btn btn-primary" type="submit"> Submit</button>
                </div>

            </div>

            {{-- Customer information --}}


            <div class="col-md-4">
                <div class="card shadow-none border border-primary mb-3" style="position: sticky; top: 85px;">
                    <div class="card-header">
                        <h5 class="card-title">Parcel Charge</h5>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <select id="pickup_address" class="select2 form-select" data-allow-clear="true" required
                                data-placeholder="Select Pickup Address" name="pickup_address_id">
                                <option value="">Select Pickup point</option>
                                @foreach ($pickupAddress as $pickup)
                                    <option value="{{ $pickup->id }}">
                                        {{ $pickup->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <dl class="row mb-0" id="section-block">
                            <dt class="col-6 fw-normal">Weight Package</dt>
                            <dd class="col-6 text-end w-package">Not Confirm</dd>
                            <dt class="col-6 fw-normal">Category Charge</dt>
                            <dd class="col-6 text-end w-catcharge">Not Confirm</dd>
                            <dt class="col-6 fw-normal">Cod Percent</dt>
                            <dd class="col-6 text-end w-cod">Not Confirm</dd>

                            <dt class="col-6 fw-normal">Delivery Charges</dt>
                            <dd class="col-6 text-end w-dcharge">0.00</dd>
                            <hr>
                            <dt class="col-6">Total</dt>
                            <dd class="col-6 fw-semibold text-end mb-0 total-charge">0.00</dd>
                        </dl>
                    </div>
                </div>


            </div>





        </form>


    </div>
    </div>
    {{-- Parcel Information --}}

    {{-- info --}}
    <button id="blockbtn" hidden type="button"></button>
@endsection

@section('inline-js')
    <script>
        var autocomplete = null;
        var map = null
        const latLong = {
            lat: 23.8103,
            lng: 90.4125
        };

        function initAutocomplete() {
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 4,
                center: latLong,
            });
            const marker = new google.maps.Marker({
                position: latLong,
                map: map,
            });

            var address = document.getElementById('sender_address');
            var options = {
                // types: ['address'],
                componentRestrictions: {
                    country: ['bd'],

                },
                fields: ["address_components", "geometry", "icon", "name"],
            };
            autocomplete = new google.maps.places.Autocomplete(address, options);
            autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace();
                console.log(place);
                // console.log($('#district').text())
                place.address_components.forEach(function(element) {
                    if (element.types.includes('administrative_area_level_1')) {}
                    if (element.types.includes('locality')) {}
                    if (element.types.includes('postal_code')) {
                        fetch("{{ route('merchant.ajax.get_area_by_zip') }}?postal_code=" + element
                                .long_name)
                            .then(res => res.json())
                            .then(data => {
                                const {
                                    area,
                                    zone,
                                    district
                                } = data
                                $('#area').empty().trigger('change');
                                $('#area').append(new Option(area.name, area.id, true, true)).trigger(
                                    'change');
                                $('#zone').empty().trigger('change');
                                $('#zone').append(new Option(zone.name, zone.id, true, true))
                                    .trigger('change');
                                $('#district').empty().trigger('change');
                                $('#district').append(new Option(district.name, district.id, true,
                                    true)).trigger('change');
                                $('#area,#delivery_type').trigger('select2:select');
                            })
                    }
                    if (element.types.includes('route')) {}
                    if (element.types.includes('street_number')) {}
                });

                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
            });


        }
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete&language=en&output=json&key=AIzaSyDNLzN1W7LEWXFF8ssJPU7OZyh3e9-mUrM"
        async defer></script>
    <script>
        $('.delivery_type').hide();

        $('#area').on('change', function() {
            $('#delivery_type').empty().trigger('change');
            $('#weight_packages').empty().trigger('change');
            var defaultOption = new Option("", "", true, true);
            axios.post("{{ route('merchant.ajax.get_weight_packages') }}", {
                area_id: $('#area').val(),
            }).then(res => {
                if (res.data.type === 'single') {
                    $('#weight_packages').empty().trigger('change');

                    $('#weight_packages').append(defaultOption).trigger('change');
                    $('#weight_packages').select2({
                        data: res.data.packages,
                        placeholder: 'Select Weight Package',
                        allowClear: false,
                    });
                }
                if (res.data.type === 'multiple') {
                    $('.delivery_type').show();
                    $('#delivery_type').append(defaultOption).trigger('change');
                    $('#delivery_type').select2({
                        data: res.data.delevery_types,
                        placeholder: 'Select Delivery Type',
                        allowClear: false,
                    });
                    $('#delivery_type').trigger('change')
                }
                if (res.data.type === 'none') {
                    $('.delivery_type').hide();
                    $('#weight_packages').empty().trigger('change');
                    $('#delivery_type').empty().trigger('change');
                }

            })
        })

        $("#delivery_type").on('select2:select', function() {

            $('#weight_packages').empty().trigger('change');
            $('#weight_packages').append(new Option("", "", true, true)).trigger('change');
            axios.post('{{ route('merchant.ajax.get_weight_package') }}', {
                delivery_type_id: $('#delivery_type').val(),
            }).then(res => {
                $('#weight_packages').empty().trigger('change');
                $('#weight_packages').append(new Option("", "", true, true)).trigger('change');
                $('#weight_packages').select2({
                    data: res.data.packages,
                    placeholder: 'Select Weight Package',
                });
            })

        });

        function calculation() {

            if ($('#area').val() && $('#weight_packages').val()) {
                $('#blockbtn').click();
                axios.post("{{ route('merchant.ajax.get_total_calculation') }}", {
                    package_id: $('#weight_packages').val(),
                    category_id: $('#category_id').val(),
                    area_id: $('#area').val(),
                    dtype: $('#delivery_type').val(),
                    _token: "{{ csrf_token() }}",
                    amount: $('#collection_amount').val(),
                }).then(res => {
                    $('.w-package').html(res.data.packageTitle)
                    $('.w-cod').html(res.data.service_area_cod)
                    $('.w-catcharge').html(res.data.category_charge)
                    $('.total-charge').html(res.data.total)
                    $('.w-dcharge').html(res.data.packageRate)
                })
            } else {

                $('.w-package').html('Not Confirm')
                $('.w-cod').html('Not Confirm')
                $('.w-catcharge').html('Not Confirm')
                $('.total-charge').html('Not Confirm')
                $('.w-dcharge').html('Not Confirm')
                // alert('Please select area,category and delivery type')
            }
        }

        $('#area,#delivery_type,#weight_packages,#category_id').on('change', function(e) {
            calculation()

        })
        var timer = null;
        $('#collection_amount').on('keyup', function(e) {
            clearTimeout(timer);
            timer = setTimeout(function() {
                calculation()

            }, 1000)


        });


        $('#blockbtn').on('click', function() {
            $('#section-block').block({
                message: '<div class="sk-wave mx-auto"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div>',
                timeout: 1000,
                css: {
                    backgroundColor: 'transparent',
                    border: '0'
                },
                overlayCSS: {
                    opacity: 0.5
                }
            });
        });
    </script>
@endsection
