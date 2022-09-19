@extends('admin::partials.merchantPanel.app')
@section('title', 'Merchant Pickup Point List')
@section('css')
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/select2/select2.css') }}" />
@endsection

@section('js')
    <script src="{{ asset('frest/vendor/libs/select2/select2.js') }}"></script>
@endsection


@section('content')
    @include('themes.frest.partials.alerts')

    <h5 class="card-header">Pickup Points</h5>
    <form class="card-body">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-body text-center">
                        <div class="avatar avatar-md mx-auto mb-3">
                            <a type="button" data-bs-toggle="modal" data-bs-target="#addModal"
                                class="avatar-initial rounded-circle bg-label-info"><i class="bx bx-plus fs-3"></i></a>
                        </div>
                        <span class="d-block mb-1 text-nowrap">Add New Pickup Point</span>
                    </div>
                </div>
            </div>

            @foreach ($pickup_points as $pickup_point)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 me-2">{{ $pickup_point->name }}</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="timelineWapper" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="timelineWapper"
                                    style="">
                                    <a class="dropdown-item" href="javascript:void(0);" onclick="editModal()">Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                {{ $pickup_point->address }}, {{ $pickup_point->district->name }},
                                {{ $pickup_point->area->name }},
                                {{ $pickup_point->phone }},
                                {{ $pickup_point->alt_phone }}
                            </p>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </form>

    <!-- Add New Addrres Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3>Add New Pickup Point</h3>
                    </div>
                    <form class="row g-3" action="{{ route('merchant.pickup.point.store') }}" method="POST">
                        @csrf

                        <div class="col-12">
                            <label class="form-label w-100" for="name">Name</label>
                            <div class="input-group input-group-merge">
                                <input id="name" name="name" class="form-control credit-card-mask" type="text"
                                    placeholder="Name" required />
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label w-100" for="name">Address</label>
                            <div class="input-group input-group-merge">
                                <textarea name="address" class="form-control" placeholder="Write Down Here..." id="address" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label w-100" for="district">District</label>
                            <select id="district" class="select2 form-select" data-allow-clear="true" required
                                name="district_id">
                                <option value="">Select</option>
                                @foreach ($districts as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label w-100" for="zones">Zone</label>
                            <select id="zone" class="select2 form-select" data-allow-clear="true" required
                                name="zone_id">
                                <option value="">Select</option>

                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label w-100" for="area_id">Service Area</label>
                            <select id="area" class="select2 form-select" data-allow-clear="true" required
                                name="area_id">
                                <option value="">Select</option>

                            </select>
                        </div>


                        <div class="col-12">
                            <label class="form-label w-100" for="postal_code">Phone</label>
                            <div class="input-group input-group-merge">
                                <input id="phone" name="phone" class="form-control" type="text"
                                    placeholder="Phone Number" required />
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label w-100" for="color">Alternative Phone</label>
                            <div class="input-group input-group-merge">
                                <input id="alt_phone" name="alt_phone" class="form-control" type="text"
                                    placeholder="Alternative Phone" />
                            </div>
                        </div>

                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                            <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal"
                                aria-label="Close">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Add New Addrres Modal -->
@endsection

@section('inline-js')
    <script>
        $('#district').on('select2:select', function(e) {
            $('#zone').empty().trigger('change');
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
