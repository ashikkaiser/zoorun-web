@extends('themes.frest.layouts.app')

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
    <script src="{{ asset('frest/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('frest/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('frest/js/forms-selects.js') }}"></script>
@endsection


@section('content')
    <!-- District List Table -->
    <div class="card">

        @include('themes.frest.partials.alerts')

        <div class="card-header border-bottom d-flex">
            <h5 class="card-title">Create Service Area List</h5>
            <div class="card-header-elements ms-auto">

                <a href="{{ route('admin.application.service.area.setting') }}" class="btn btn-sm btn-primary"><span
                        class="tf-icon bx bx-plus bx-xs"></span>
                    Service Area Settings</a>
            </div>
        </div>

        <div class="card-body mt-4">
            <form class="row g-3" action="{{ route('admin.application.service.area.setting.store') }}" method="POST">
                @csrf

                <div class="col-12">
                    <label class="form-label w-100" for="district">Service Area</label>
                    <select id="service_area_id" class="select2 form-select" data-allow-clear="true" required
                        name="service_area_id">
                        <option value="">Select</option>
                        @foreach ($serviceAreas as $item)
                            <option value="{{ $item->id }}"
                                {{ old('service_area_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                @foreach ($weightPackages as $package)
                    <div class="col-2">
                        <label class="form-label w-100" for="district">{{ $package->name }}</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <input class="form-check-input" type="checkbox"
                                    onclick="changeStatus(this, {{ $package->id }})" name="weight_package_id[]"
                                    value="{{ $package->id }}"
                                    {{ old('packagerateCheck' . $package->id) === 'on' ? 'checked' : '' }}>
                            </span>
                            <input type="text" class="form-control" name="rates[]" id="packagerate{{ $package->id }}"
                                value="{{ old('packagerate' . $package->id, $package->rate) }}"
                                {{ old('packagerateCheck' . $package->id) === 'on' ? '' : 'disabled' }}>
                        </div>
                    </div>
                @endforeach



                <div class="col-12 text-center mt-4">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                    <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>
                </div>
            </form>
        </div>

    </div>
@endsection

@section('inline-js')
    <script>
        function changeStatus(e, id) {
            if (e.checked) {
                $(`#packagerate${id}`).prop('disabled', false);
            } else {
                $(`#packagerate${id}`).prop('disabled', true);
            }
        }
    </script>
@endsection
