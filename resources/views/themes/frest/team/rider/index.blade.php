@extends('themes.frest.layouts.app')
@section('title', 'Admin - Riders List')

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


    {!! $html->scripts() !!}
@endsection


@section('content')

    <!-- Users List Table -->
    <div class="card">
        <div class="card-header border-bottom d-flex">
            <h5 class="card-title">Riders List</h5>
            <div class="card-header-elements ms-auto">
                <a href="{{ route('admin.team.branch') }}"
                    class="btn btn-sm {{ request()->status !== 'trash' ? 'btn-dark' : '' }}"><span
                        class="tf-icon bx bx-check bx-xs"></span>
                    Active</a>
                <a href="{{ route('admin.team.branch', ['status' => 'trash']) }}"
                    class="btn btn-sm {{ request()->status === 'trash' ? 'btn-dark' : '' }}"><span
                        class="tf-icon bx bx-trash bx-xs"></span>
                    Trash</a>
                <a href="{{ route('admin.team.rider.create') }}" type="button" class="btn btn-sm btn-primary"><span
                        class="tf-icon bx bx-plus bx-xs"></span>
                    Add New Rider</a>
            </div>
        </div>

        <div class="card-datatable table-responsive">
            {!! $html->table(['class' => 'datatables-users table border-top']) !!}
        </div>

    </div>

@section('inline-js')
    <script type="text/javascript">
        function deleteRow(id, status) {
            Swal.fire({
                title: 'Are you sure ?',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-danger',
                },
                buttonsStyling: false,
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'NO',
            }).then(function(result) {
                if (result.isConfirmed) {

                    const basePath = "{{ route('admin.team.branch.delete') }}"

                    window.location.href = `${basePath}?id=${id}&status=${status}`;
                }
            });
        }
    </script>
@endsection

@endsection
