@extends('themes.frest.partials.branchPanel.app')
@section('title', 'Branch - Profile')

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

    <!-- Header -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="user-profile-header-banner">
                    <img src="/frest/img/pages/profile-banner.png" alt="Banner image" class="rounded-top" />
                </div>
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        @if (isset($profile_data->image_url))
                            <img src="/uploads/branch/users/{{ $profile_data->image_url }}" alt="user image"
                                class="d-block h-auto ms-0 ms-sm-4 rounded-3 user-profile-img" />
                        @else
                            <img src="/frest/img/avatars/1.png" alt="user image"
                                class="d-block h-auto ms-0 ms-sm-4 rounded-3 user-profile-img" />
                        @endif
                    </div>
                    <div class="flex-grow-1 mt-3 mt-sm-5">
                        <div
                            class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                            <div class="user-profile-info">
                                <h4>{{ $profile_data->name }}</h4>
                                <ul
                                    class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                    <li class="list-inline-item fw-semibold" style="text-transform: capitalize;"><i
                                            class="bx bx-star"></i>
                                        {{ $profile_data->user_type }} User
                                    </li>
                                    <li class="list-inline-item fw-semibold"><i class="bx bx-flag"></i>
                                        {{ $profile_data->branch->name }}
                                    </li>
                                    <li class="list-inline-item fw-semibold">
                                        <i class="bx bx-calendar-alt"></i> Joined
                                        {{ $profile_data->created_at->format('d/m/Y') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Header -->

    <!-- User Profile Content -->
    <div class="row">
        <div class="col-xl-4 col-lg-5 col-md-5">
            <!-- About User -->
            <div class="card mb-4">
                <div class="card-body">
                    <small class="text-muted text-uppercase">About</small>
                    <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-user"></i><span class="fw-semibold mx-2">Full Name:</span>
                            <span>{{ $profile_data->name }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-check"></i><span class="fw-semibold mx-2">Status:</span>
                            <span
                                class="text-{{ $profile_data->status ? 'success' : 'danger' }}">{{ $profile_data->status ? 'Active' : 'Inactive' }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-star"></i><span class="fw-semibold mx-2">Role:</span>
                            <span style="text-transform: capitalize;">{{ $profile_data->user_type }} User</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-map"></i><span class="fw-semibold mx-2">Address:</span>
                            <span style="text-transform: capitalize;">{{ $profile_data->address }} </span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-flag"></i><span class="fw-semibold mx-2">Branch Name:</span>
                            <span>{{ $profile_data->branch->name }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-calendar"></i><span class="fw-semibold mx-2">Joined From:</span>
                            <span>{{ $profile_data->created_at->format('d/m/Y') }}</span>
                        </li>
                    </ul>
                    <small class="text-muted text-uppercase">Contacts</small>
                    <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-phone"></i><span class="fw-semibold mx-2">Phone:</span>
                            <a href="tel:{{ $profile_data->phone }}">{{ $profile_data->phone }}</a>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-envelope"></i><span class="fw-semibold mx-2">Email:</span>
                            <a href="mailto:{{ $profile_data->email }}">{{ $profile_data->email }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--/ About User -->

        </div>
        <div class="col-xl-8 col-lg-7 col-md-7">
            <div class="card mb-4">
                <h5 class="card-header">Merchant List</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Merchant Name</th>
                                <th>Address</th>
                                <th>Contact Number</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($merchants as $key => $merchant)
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>{{ $key + 1 }}</strong>
                                    </td>
                                    <td>{{ $merchant->name }}</td>
                                    <td>{{ $merchant->personal_address }}</td>
                                    <td>{{ $merchant->phone }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            {{-- Rider List Table --}}
            <div class="card mb-4">
                <h5 class="card-header">Rider List</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Rider Name</th>
                                <th>Address</th>
                                <th>Contact Number</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($riders as $key => $rider)
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>{{ $key + 1 }}</strong>
                                    </td>
                                    <td>{{ $rider->name }}</td>
                                    <td>{{ $rider->address }}</td>
                                    <td>{{ $rider->phone }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/ User Profile Content -->
@endsection

@section('inline-js')
@endsection
