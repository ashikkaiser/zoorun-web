@extends('themes.frest.partials.branchPanel.app')
@section('title', 'Branch - Vehicle Setting')

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
    {!! $html->scripts() !!}
@endsection


@section('content')
    <!-- District List Table -->
    <div class="card">

        @include('themes.frest.partials.alerts')

        <div class="card-header border-bottom d-flex">
            <h5 class="card-title">Vehicle List</h5>
            <div class="card-header-elements ms-auto">
                <a href="{{ route('admin.parcel.setting.vehicle') }}"
                    class="btn btn-sm {{ request()->status !== 'trash' ? 'btn-dark' : '' }}"><span
                        class="tf-icon bx bx-check bx-xs"></span>
                    Active</a>
                <a href="{{ route('admin.parcel.setting.vehicle', ['status' => 'trash']) }}"
                    class="btn btn-sm {{ request()->status === 'trash' ? 'btn-dark' : '' }}"><span
                        class="tf-icon bx bx-trash bx-xs"></span>
                    Trash</a>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                    data-bs-target="#addNewCCModal"><span class="tf-icon bx bx-plus bx-xs"></span>
                    Add New Vehicle</button>
            </div>
        </div>

        <!-- Add New Vehicle Modal -->
        <div class="modal fade" id="addNewCCModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3>Add New Vehicle</h3>
                        </div>
                        <form id="addNewCCForm" class="row g-3" action="{{ route('admin.parcel.setting.vehicle.store') }}"
                            method="POST">
                            @csrf
                            <div class="col-12">
                                <label class="form-label w-100" for="name">Vehicle Name</label>
                                <div class="input-group input-group-merge">
                                    <input id="name" name="name" class="form-control credit-card-mask"
                                        type="text" placeholder="Vehicle" aria-describedby="name2" required />
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label w-100" for="sl_no">Vehicle Sl No</label>
                                <div class="input-group input-group-merge">
                                    <input id="sl_no" name="sl_no" class="form-control credit-card-mask"
                                        type="text" placeholder="Vehicle Sl No" aria-describedby="sl_no" required />
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label w-100" for="number">Vehicle No</label>
                                <div class="input-group input-group-merge">
                                    <input id="number" name="number" class="form-control credit-card-mask"
                                        type="text" placeholder="Vehicle No" aria-describedby="number" required />
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label w-100" for="driver_name">Vehicle Driver Name</label>
                                <div class="input-group input-group-merge">
                                    <input id="driver_name" name="driver_name" class="form-control credit-card-mask"
                                        type="text" placeholder="Vehicle Driver Name" aria-describedby="driver_name"
                                        required />
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="driver_contact" class="form-label">Driver Contact Number
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon11">+88</span>
                                    <input type="number" class="form-control" placeholder="01700000000" aria-label="Phone"
                                        aria-describedby="basic-addon11" id="driver_contact" name="driver_contact"
                                        required="">
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label w-100" for="road">Vehicle Road</label>
                                <div class="input-group input-group-merge">
                                    <input id="road" name="road" class="form-control credit-card-mask"
                                        type="text" placeholder="Vehicle Road" aria-describedby="road" required />
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
        <!--/ Add New Vehicle Modal -->


        <div class="card-datatable table-responsive">
            {!! $html->table(['class' => 'datatables-users table border-top']) !!}
        </div>

        <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3>Edit Area</h3>
                        </div>
                        <form id="editModalForm" class="row g-3" method="POST">
                            @csrf
                            <div class="col-12">
                                <label class="form-label w-100" for="editname">Vehicle Name</label>
                                <div class="input-group input-group-merge">
                                    <input id="editname" name="name" class="form-control credit-card-mask"
                                        type="text" placeholder="Vehicle" aria-describedby="name2" required />
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label w-100" for="editsl_no">Vehicle Sl No</label>
                                <div class="input-group input-group-merge">
                                    <input id="editsl_no" name="sl_no" class="form-control credit-card-mask"
                                        type="text" placeholder="Vehicle Sl No" aria-describedby="sl_no" required />
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label w-100" for="editnumber">Vehicle No</label>
                                <div class="input-group input-group-merge">
                                    <input id="editnumber" name="number" class="form-control credit-card-mask"
                                        type="text" placeholder="Vehicle No" aria-describedby="number" required />
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label w-100" for="editdriver_name">Vehicle Driver Name</label>
                                <div class="input-group input-group-merge">
                                    <input id="editdriver_name" name="driver_name" class="form-control credit-card-mask"
                                        type="text" placeholder="Vehicle Driver Name" aria-describedby="driver_name"
                                        required />
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="editdriver_contact" class="form-label">Driver Contact Number
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon11">+88</span>
                                    <input type="number" class="form-control" placeholder="01700000000"
                                        aria-label="Phone" aria-describedby="basic-addon11" id="editdriver_contact"
                                        name="driver_contact" required="">
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label w-100" for="editroad">Vehicle Road</label>
                                <div class="input-group input-group-merge">
                                    <input id="editroad" name="road" class="form-control credit-card-mask"
                                        type="text" placeholder="Vehicle Road" aria-describedby="road" required />
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


    </div>
@endsection

@section('inline-js')
    <script type="text/javascript">
        function editRow(data) {
            var myModal = new bootstrap.Modal(document.getElementById('editModal'), {
                keyboard: false
            })

            $("#editname").val(data.name)
            $("#editsl_no").val(data.sl_no)
            $("#editnumber").val(data.number)
            $("#editdriver_name").val(data.driver_name)
            $("#editdriver_contact").val(data.driver_contact)
            $("#editroad").val(data.road)
            let url = "{{ route('admin.parcel.setting.vehicle.update', 'id') }}"
            url = url.replace("id", data.id);
            $("#editModalForm").attr("action", url);
            myModal.show();
        }

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

                    const basePath = "{{ route('admin.parcel.setting.vehicle.delete') }}"

                    window.location.href = `${basePath}?id=${id}&status=${status}`;
                }
            });
        }
    </script>
@endsection
