@extends('themes.frest.layouts.app')


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
            <h5 class="card-title">Add New Rider</h5>
            <a href="{{ route('admin.team.merchant') }}" class="btn btn-sm btn-primary"> <span
                    class="tf-icon bx bx-left-arrow-alt bx-xs"></span>Go back</a>
        </div>
    </div>
    <div class="card mt-4">

        <div class="card">

            <div class="card-body">
                <form class="form" method="POST" id="jquery-val-form" enctype="multipart/form-data"
                    action="{{ route('admin.team.rider.modify') }}" novalidate="novalidate">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6 col-12 mb-3">
                                <label class="form-label required" for="fullname">Full Name</label>
                                <input type="text" id="fullname" class="form-control" name="name"
                                    placeholder="Full Name" required>

                            </div>
                            <div class="col-md-6 col-12 mb-2 mb-3">
                                <label class="form-label" for="address">Full Address</label>
                                <textarea class="form-control" name="address" rows="3" placeholder="Full Address" spellcheck="false"
                                    id="address" required style="color: rgb(48, 65, 86);"></textarea>
                            </div>
                        </div>

                        <div class="row">
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
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-12 mb-3">
                                <label class="form-label" for="phone">Contact Number</label>
                                <div class="input-group">
                                    <input type="text" id="phone" class="form-control" name="phone" required
                                        placeholder="Contact Number">
                                </div>
                            </div>


                            <div class="col-md-6 col-12 mb-3">
                                <label class="form-label" for="profile_image">Choose Image</label>
                                <div class="input-group">
                                    <input type="file" class="form-control" id="profile_image" name="profile_image">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12 mb-3">
                                <label class="form-label" for="email">Email</label>
                                <div class="input-group">
                                    <input type="email" id="email" class="form-control" name="email" required
                                        placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group">
                                    <input type="text" id="password" class="form-control" name="password" required
                                        placeholder="Password">
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr />



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
            // $('#zone').empty().trigger('change');
            // $('#area').empty().trigger('change');
            // fetch(`{{ route('admin.application.getzone') }}?district=${e.target.value}`)
            //     .then(async res => await res.json())
            //     .then(data => {
            //         var defaultOption = new Option("", "", true, true);
            //         $('#zone').append(defaultOption).trigger('change');
            //         data.map(item => {
            //             var newOption = new Option(item.name, item.id, true, false);
            //             $('#zone').append(newOption).trigger('change');
            //         })
            //     }).catch(err => {
            //         console.log(err)
            //     })
        });
    </script>
@endsection
