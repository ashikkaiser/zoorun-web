@extends('themes.frest.layouts.app')
@section('title', 'Admin - Edit Branch')


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
            <h5 class="card-title">Edit Beranch</h5>
            <a href="{{ route('admin.team.branch') }}" class="btn btn-sm btn-primary"> <span
                    class="tf-icon bx bx-left-arrow-alt bx-xs"></span>Go back</a>
        </div>
    </div>
    <div class="card mt-4">

        <form action="{{ route('admin.team.branch.update', $branch->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class=" card-body">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Branch Name"
                        name="name" required value="{{ $branch->name }}" />
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label">Full Address</label>
                    <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="Branch Address"
                        name="address" required value="{{ $branch->address }}" />
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label w-100" for="district">District</label>
                        <select id="district" class="select2 form-select" data-allow-clear="true" required name="district"
                            required>
                            <option value="">Select</option>
                            @foreach ($districts as $item)
                                <option value="{{ $item->id }}"
                                    {{ $branch->district_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label w-100" for="zones">Zone</label>
                        <select id="zone" class="select2 form-select" data-allow-clear="true" required name="zone[]"
                            multiple required>
                            <option value="">Select</option>
                        </select>
                    </div>

                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label">Phone</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon11">+88</span>
                        <input type="number" class="form-control" placeholder="01700000000" aria-label="Phone"
                            aria-describedby="basic-addon11" id="exampleFormControlInput3" name="phone" required
                            value="{{ $branch->phone }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput4" class="form-label">Email</label>
                    <input type="email" class="form-control" id="exampleFormControlInput4" placeholder="Branch Email"
                        name="email" required value="{{ $branch->email }}" />
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput5" class="form-label">Image</label>
                    <div class="input-group">
                        <input type="file" class="form-control" id="exampleFormControlInput5" name="file">

                    </div>
                    <div class="mt-2">
                        <img src="{{ asset('/uploads/branch/' . $branch->image_url) }}"
                            style="height: 100px; weidth: 160px" />
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary"> <span
                            class="tf-icon bx bx-right-arrow-alt bx-xs"></span>Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection

{{-- @php
dd(json_decode($branch->zone_ids, JSON_NUMERIC_CHECK));
@endphp --}}
@section('inline-js')

    <script type="text/javascript">
        var currentData = JSON.parse("{{ $branch->zone_ids }}".replace(/&quot;/g, '"'));

        $('#district').on('select2:select', function(e) {
            $('#zone').empty().trigger('change');
            $('#area').empty().trigger('change');
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



        //get default data
        function getUp() {
            fetch(`{{ route('admin.application.getzone') }}?district={{ $branch->district_id }}`)
                .then(async res => await res.json())
                .then(data => {
                    console.log(data)
                    var defaultOption = new Option("", "", true, true);
                    $('#zone').append(defaultOption).trigger('change');
                    data.map(item => {
                        var newOption = new Option(item.name, item.id, true, false);
                        $('#zone').append(newOption).trigger('change');
                    })

                    $("#zone").val(currentData).trigger('change');

                }).catch(err => {
                    console.log(err)
                })
        }
        getUp();

        // function getArea() {
        //     fetch(`{{ route('admin.application.getarea') }}?zone={{ $branch->zone_id }}`)
        //         .then(async res => await res.json())
        //         .then(data => {
        //             var defaultOption = new Option("", "", true, true);
        //             $('#area').append(defaultOption).trigger('change');
        //             data.map(item => {
        //                 var newOption = new Option(item.name, item.id, true, false);
        //                 $('#area').append(newOption).trigger('change');
        //             })
        //             $("#area").val({{ $branch->area_id }}).trigger('change');
        //         }).catch(err => {
        //             console.log(err)
        //         })
        // }
        // getArea();
    </script>
@endsection
