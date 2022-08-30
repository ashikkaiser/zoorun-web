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
    {!! $html->scripts() !!}
@endsection


@section('content')
    <!-- District List Table -->
    <div class="card">

        @include('themes.frest.partials.alerts')

        <div class="card-header border-bottom d-flex">
            <h5 class="card-title">Weight Package List</h5>
            <div class="card-header-elements ms-auto">
                <a href="{{ route('admin.application.weight.package') }}"
                    class="btn btn-sm {{ request()->status !== 'trash' ? 'btn-dark' : '' }}"><span
                        class="tf-icon bx bx-check bx-xs"></span>
                    Active</a>
                <a href="{{ route('admin.application.weight.package', ['status' => 'trash']) }}"
                    class="btn btn-sm {{ request()->status === 'trash' ? 'btn-dark' : '' }}"><span
                        class="tf-icon bx bx-trash bx-xs"></span>
                    Trash</a>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                    data-bs-target="#addNewCCModal"><span class="tf-icon bx bx-plus bx-xs"></span>
                    Add New Weight Package</button>
            </div>
        </div>

        <!-- Add New Districts Modal -->
        <div class="modal fade" id="addNewCCModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3>Add New Weight Package</h3>
                        </div>
                        <form id="addNewCCForm" class="row g-3"
                            action="{{ route('admin.application.weight.package.store') }}" method="POST">
                            @csrf
                            <div class="col-12">
                                <label class="form-label w-100" for="name">Name</label>
                                <div class="input-group input-group-merge">
                                    <input id="name" name="name" class="form-control credit-card-mask" type="text"
                                        placeholder="Name" aria-describedby="name2" required />
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label w-100" for="name">Title</label>
                                <div class="input-group input-group-merge">
                                    <input id="title" name="title" class="form-control credit-card-mask" type="text"
                                        placeholder="Title" aria-describedby="title" required />
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label w-100" for="weight_package">Weight Type</label>
                                <select id="weight_package" class="select2 form-select" data-allow-clear="true" required
                                    name="weight_package">
                                    <option value="">Select</option>
                                    @foreach ($units as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label w-100" for="name">Description</label>
                                <div class="input-group input-group-merge">
                                    <textarea id="description" name="description" class="form-control credit-card-mask" type="text"
                                        placeholder="description" aria-describedby="description"></textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label w-100" for="name">Rate</label>
                                <div class="input-group input-group-merge">
                                    <input id="rate" name="rate" class="form-control credit-card-mask" type="text"
                                        placeholder="rate" aria-describedby="rate" required />
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
        <!--/ Add New Districts Modal -->

        <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3>Edit Weight Package</h3>
                        </div>
                        <form id="editModalForm" class="row g-3" method="POST">
                            @csrf
                            <div class="col-12">
                                <label class="form-label w-100" for="editname">Name</label>
                                <div class="input-group input-group-merge">
                                    <input id="editname" name="name" class="form-control credit-card-mask" type="text"
                                        placeholder="Name" aria-describedby="editname" required />
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label w-100" for="edittitle">Title</label>
                                <div class="input-group input-group-merge">
                                    <input id="edittitle" name="title" class="form-control credit-card-mask" type="text"
                                        placeholder="Title" aria-describedby="title" required />
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label w-100" for="edit_weight_package">Weight Type</label>
                                <select id="edit_weight_package" class="select2 form-select" data-allow-clear="true"
                                    required name="weight_package">
                                    <option value="">Select</option>
                                    @foreach ($units as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label w-100" for="editdescription">Description</label>
                                <div class="input-group input-group-merge">
                                    <textarea id="editdescription" name="description" class="form-control credit-card-mask" type="text"
                                        placeholder="description" aria-describedby="description"></textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label w-100" for="editrate">Rate</label>
                                <div class="input-group input-group-merge">
                                    <input id="editrate" name="rate" class="form-control credit-card-mask" type="text"
                                        placeholder="rate" aria-describedby="rate" required />
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


        <div class="card-datatable table-responsive">
            {!! $html->table(['class' => 'datatables-users table border-top']) !!}
        </div>


    </div>
@endsection

@section('inline-js')
    <script type="text/javascript">
        function editRow(data) {
            var myModal = new bootstrap.Modal(document.getElementById('editModal'), {
                keyboard: false
            })
            myModal.show();
            $("#edit_weight_package").val(data.unit_id).trigger('change');
            $("#editname").val(data.name)
            $("#edittitle").val(data.title)
            $("#editdescription").val(data.description)
            $("#editrate").val(data.rate)
            let url = "{{ route('admin.application.weight.package.update', 'id') }}"
            url = url.replace("id", data.id);
            $("#editModalForm").attr("action", url);
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

                    const basePath = "{{ route('admin.application.weight.package.delete') }}"

                    window.location.href = `${basePath}?id=${id}&status=${status}`;
                }
            });
        }
    </script>
@endsection
