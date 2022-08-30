@extends('themes.frest.partials.branchPanel.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('frest/vendor/css/pages/page-profile.css') }}">
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
    <script src="{{ asset('frest/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('frest/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('frest/js/forms-selects.js') }}"></script>
    {{-- {!! $html->scripts() !!} --}}
@endsection


@section('content')
    @include('themes.frest.partials.alerts')

    <div class="card mb-4">
        <h5 class="card-header">Order Tracking</h5>
        <form class="card-body">
            <div class="row g-3">
                <div class="col-md-5">
                    <label class="form-label" for="parcel-number">Order Number</label>
                    <input type="text" id="" class="form-control" placeholder="Enter Parcel Invoice Barcode">
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
        </form>
    </div>
@endsection

@section('inline-js')
@endsection
