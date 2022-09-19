@extends('themes.frest.partials.branchPanel.app')
@section('title', 'Branch - Parcel Setting')

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
            <h5 class="card-title">Item List</h5>
            <div class="card-header-elements ms-auto">
                <a href="{{ route('admin.parcel.setting.item') }}"
                    class="btn btn-sm {{ request()->status !== 'trash' ? 'btn-dark' : '' }}"><span
                        class="tf-icon bx bx-check bx-xs"></span>
                    Active</a>
                <a href="{{ route('admin.parcel.setting.item', ['status' => 'trash']) }}"
                    class="btn btn-sm {{ request()->status === 'trash' ? 'btn-dark' : '' }}"><span
                        class="tf-icon bx bx-trash bx-xs"></span>
                    Trash</a>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                    data-bs-target="#addNewCCModal"><span class="tf-icon bx bx-plus bx-xs"></span>
                    Add New Item</button>
            </div>
        </div>

        <!-- Add New Item Category Modal -->
        <div class="modal fade" id="addNewCCModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3>Add New Item</h3>
                        </div>
                        <form id="addNewCCForm" class="row g-3" action="{{ route('admin.parcel.setting.item.store') }}"
                            method="POST">
                            @csrf
                            <div class="col-12">
                                <label class="form-label w-100" for="item_category_id">Item Category</label>
                                <select id="item_category_id" class="select2 form-select" data-allow-clear="true" required
                                    name="item_category_id">
                                    <option value="">Select</option>
                                    @foreach ($itemCategories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label w-100" for="name">Name</label>
                                <div class="input-group input-group-merge">
                                    <input id="name" name="name" class="form-control credit-card-mask"
                                        type="text" placeholder="Name" aria-describedby="name2" required />
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label w-100" for="unit_id">Unit</label>
                                <select id="unit_id" class="select2 form-select" data-allow-clear="true" required
                                    name="unit_id">
                                    <option value="">Select</option>
                                    @foreach ($units as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label w-100" for="od_rate">OD Rate</label>
                                <div class="input-group input-group-merge">
                                    <input id="od_rate" name="od_rate" class="form-control credit-card-mask"
                                        type="text" placeholder="OD Rate" aria-describedby="name2" required />
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label w-100" for="hd_rate">HD Rate</label>
                                <div class="input-group input-group-merge">
                                    <input id="hd_rate" name="hd_rate" class="form-control credit-card-mask"
                                        type="text" placeholder="HD Rate" aria-describedby="hd_rate" required />
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label w-100" for="transit_od">Transit OD</label>
                                <div class="input-group input-group-merge">
                                    <input id="transit_od" name="transit_od" class="form-control credit-card-mask"
                                        type="text" placeholder="Vehicle" aria-describedby="transit_od" required />
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label w-100" for="transit_hd">Transit HD</label>
                                <div class="input-group input-group-merge">
                                    <input id="transit_hd" name="transit_hd" class="form-control credit-card-mask"
                                        type="text" placeholder="Vehicle" aria-describedby="transit_hd" required />
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
        <!--/ Add New Item Category Modal -->


        <div class="card-datatable table-responsive">
            {!! $html->table(['class' => 'datatables-users table border-top']) !!}
        </div>

        <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3>Edit Item</h3>
                        </div>
                        <form id="editModalForm" class="row g-3" method="POST">
                            @csrf


                            <div class="col-12">
                                <label class="form-label w-100" for="edititem_category_id">Item Category</label>
                                <select id="edititem_category_id" class="select2 form-select" data-allow-clear="true"
                                    required name="item_category_id">
                                    <option value="">Select</option>
                                    @foreach ($itemCategories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label w-100" for="editname">Name</label>
                                <div class="input-group input-group-merge">
                                    <input id="editname" name="name" class="form-control credit-card-mask"
                                        type="text" placeholder="Vehicle" aria-describedby="name2" required />
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label w-100" for="editunit_id">Unit</label>
                                <select id="editunit_id" class="select2 form-select" data-allow-clear="true" required
                                    name="unit_id">
                                    <option value="">Select</option>
                                    @foreach ($units as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label w-100" for="editod_rate">OD Rate</label>
                                <div class="input-group input-group-merge">
                                    <input id="editod_rate" name="od_rate" class="form-control credit-card-mask"
                                        type="text" placeholder="OD Rate" aria-describedby="name2" required />
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label w-100" for="edithd_rate">HD Rate</label>
                                <div class="input-group input-group-merge">
                                    <input id="edithd_rate" name="hd_rate" class="form-control credit-card-mask"
                                        type="text" placeholder="HD Rate" aria-describedby="hd_rate" required />
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label w-100" for="edittransit_od">Transit OD</label>
                                <div class="input-group input-group-merge">
                                    <input id="edittransit_od" name="transit_od" class="form-control credit-card-mask"
                                        type="text" placeholder="Vehicle" aria-describedby="transit_od" required />
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label w-100" for="edittransit_hd">Transit HD</label>
                                <div class="input-group input-group-merge">
                                    <input id="edittransit_hd" name="transit_hd" class="form-control credit-card-mask"
                                        type="text" placeholder="Vehicle" aria-describedby="transit_hd" required />
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
            $("#edititem_category_id").val(data.item_category_id).trigger('change');
            $("#editunit_id").val(data.unit_id).trigger('change');
            $("#editod_rate").val(data.od_rate)
            $("#edithd_rate").val(data.hd_rate)
            $("#edittransit_od").val(data.transit_od)
            $("#edittransit_hd").val(data.transit_hd)
            let url = "{{ route('admin.parcel.setting.item.update', 'id') }}"
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

                    const basePath = "{{ route('admin.parcel.setting.item.delete') }}"

                    window.location.href = `${basePath}?id=${id}&status=${status}`;
                }
            });
        }
    </script>
@endsection
