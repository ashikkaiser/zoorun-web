@extends('themes.frest.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/select2/select2.css') }}" />
@endsection

@section('js')
    <script src="/frest/vendor/libs/moment/moment.js"></script>
    <script src="/frest/vendor/libs/datatables/jquery.dataTables.js"></script>
    <script src="/frest/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="/frest/vendor/libs/datatables-responsive/datatables.responsive.js"></script>
    <script src="/frest/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js"></script>
    {!! $html->scripts() !!}
    <script src="/frest/vendor/libs/select2/select2.js"></script>
@endsection


@section('content')
    <!-- District List Table -->
    <div class="card">

        @include('themes.frest.partials.alerts')

        <div class="card-header border-bottom d-flex">
            <h5 class="card-title">Area List</h5>
            <div class="card-header-elements ms-auto">
                <a href="{{ route('admin.application.area') }}"
                    class="btn btn-sm {{ request()->status !== 'trash' ? 'btn-dark' : '' }}"><span
                        class="tf-icon bx bx-check bx-xs"></span>
                    Active</a>
                <a href="{{ route('admin.application.area', ['status' => 'trash']) }}"
                    class="btn btn-sm {{ request()->status === 'trash' ? 'btn-dark' : '' }}"><span
                        class="tf-icon bx bx-trash bx-xs"></span>
                    Trash</a>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                    data-bs-target="#addNewCCModal"><span class="tf-icon bx bx-plus bx-xs"></span>
                    Add New Area</button>
            </div>
        </div>

        <!-- Add New Districts Modal -->
        <div class="modal fade" id="addNewCCModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3>Add New Area</h3>
                        </div>
                        <form id="addNewCCForm" class="row g-3" action="{{ route('admin.application.area.store') }}"
                            method="POST">
                            @csrf

                            <div class="col-12">
                                <label class="form-label w-100" for="district">District</label>
                                <select id="district" class="select2 form-select" data-allow-clear="true" required
                                    name="district">
                                    <option value="">Select</option>
                                    @foreach ($districts as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label w-100" for="zones">Zone</label>
                                <select id="zone" class="select2 form-select" data-allow-clear="true" required
                                    name="zone">
                                    <option value="">Select</option>

                                </select>
                            </div>


                            <div class="col-12">
                                <label class="form-label w-100" for="service_area_id">Service Area</label>
                                <select class="select2 form-select" data-allow-clear="true" required
                                    name="service_area_ids[]" multiple>
                                    <option value="">Select</option>
                                    @foreach ($service_areas as $service_area)
                                        <option value="{{ $service_area->id }}">{{ $service_area->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label w-100" for="name">Name</label>
                                <div class="input-group input-group-merge">
                                    <input id="name" name="name" class="form-control credit-card-mask"
                                        type="text" placeholder="Kushtia" aria-describedby="name2" required />
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label w-100" for="postal_code">Postal Code</label>
                                <div class="input-group input-group-merge">
                                    <input id="postal_code" name="postal_code" class="form-control credit-card-mask"
                                        type="text" placeholder="7052" aria-describedby="postal_code" required />
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
                                <label class="form-label w-100" for="districtedit">District</label>
                                <select id="districtedit" class="select2 form-select" data-allow-clear="true" required
                                    name="district">
                                    <option value="">Select</option>
                                    @foreach ($districts as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->district_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label w-100" for="zoneEdit">Zone</label>
                                <select id="zoneEdit" class="select2 form-select" data-allow-clear="true" required
                                    name="zone">

                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label w-100" for="service_area_id">Service Area</label>
                                <select id="service_area_ids" class="select2 form-select" data-allow-clear="true"
                                    required name="service_area_ids[]" multiple>
                                    <option value="">Select</option>
                                    @foreach ($service_areas as $service_area)
                                        <option value="{{ $service_area->id }}" {{-- {{ in_array('$service_area->id', $service_area) ? 'selected' : '' }} --}}>

                                            {{ $service_area->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label w-100" for="editName">Name</label>
                                <div class="input-group input-group-merge">
                                    <input id="editName" name="name" class="form-control credit-card-mask"
                                        type="text" placeholder="Kushtia" aria-describedby="name2" required />
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label w-100" for="postal_codeedit">Postal Code</label>
                                <div class="input-group input-group-merge">
                                    <input id="postal_codeedit" name="postal_code" class="form-control credit-card-mask"
                                        type="text" placeholder="7052" aria-describedby="postal_code" required />
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
            $("#districtedit").val(data.district_id).trigger('change');
            $("#editName").val(data.name)
            $("#service_area_ids").val(JSON.parse(data.service_area_ids)).trigger('change');

            $("#postal_codeedit").val(data.postal_code)

            fetch(`{{ route('admin.application.getzone') }}?district=${data.district_id}`)
                .then(async res => await res.json())
                .then(resdData => {
                    resdData.map(item => {
                        var newOption = new Option(item.name, item.id, true, false);
                        $('#zoneEdit').append(newOption).trigger('change');
                    })

                    myModal.show();

                    console.log(data.zone_id)

                    $("#zoneEdit").val(data.zone_id).trigger('change');
                }).catch(err => {
                    console.log(err)
                })

            let url = "{{ route('admin.application.area.update', 'id') }}"
            url = url.replace("id", data.id);
            $("#editModalForm").attr("action", url);
        }

        $('#districtedit').on('select2:select', function(e) {
            $('#zoneEdit').empty().trigger('change');
            fetch(`{{ route('admin.application.getzone') }}?district=${e.target.value}`)
                .then(async res => await res.json())
                .then(data => {
                    var defaultOption = new Option("", "", true, true);
                    $('#zoneEdit').append(defaultOption).trigger('change');
                    data.map(item => {
                        var newOption = new Option(item.name, item.id, true, false);
                        $('#zoneEdit').append(newOption).trigger('change');
                    })
                }).catch(err => {
                    console.log(err)
                })
        });


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

                    const basePath = "{{ route('admin.application.area.delete') }}"

                    window.location.href = `${basePath}?id=${id}&status=${status}`;
                }
            });
        }

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
    </script>
@endsection
