@extends('themes.frest.partials.branchPanel.app')

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
    <script src="/frest/vendor/libs/select2/select2.js"></script>
    {{ $dataTable->scripts() }}
@endsection


@section('content')
    <!-- Merchnat List Table -->
    <div class="card">

        @include('themes.frest.partials.alerts')

        <div class="card-header border-bottom d-flex">
            <h5 class="card-title">Pickup Parcel List</h5>
        </div>

        <div class="card-datatable table-responsive text-nowrap">
            {{ $dataTable->table(['class' => 'datatables-users table border-top']) }}
        </div>



    </div>
@endsection

@section('inline-js')
    <script>
        function statusChange(id, status) {

            var url = "{{ route('branch.parcel.pickup.status', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    type: status
                },
                success: function(data) {
                    $('#pickup-table').DataTable().ajax.reload();
                }
            });
        }
    </script>
@endsection
