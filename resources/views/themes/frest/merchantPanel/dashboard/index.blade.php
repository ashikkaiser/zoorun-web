@extends('themes.frest.partials.merchantPanel.app')
@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4">Welcome Back - {{ Auth::user()->name }}</h4>
    <div class="row">
        <!-- Total Parcel-->
        <div class="col-lg-3 col-md-3 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="avatar mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-success">
                            <i class="bx bx-package fs-4"></i></span>
                    </div>
                    <span class="d-block text-nowrap">Total Parcel</span>
                    <h2 class="mb-0">{{ $total_parcels }}</h2>
                </div>
            </div>
        </div>
        <!-- Total Parcel-->
        <!-- Total Cancel Parcel-->
        <div class="col-lg-3 col-md-3 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="avatar mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-danger">
                            <i class="bx bx-package fs-4"></i></span>
                    </div>
                    <span class="d-block text-nowrap">Total Cancel Parcel</span>
                    <h2 class="mb-0">Count Progress</h2>
                </div>
            </div>
        </div>
        <!-- Total Cancel Parcel-->
        <!-- Total Delivery Parcel-->
        <div class="col-lg-3 col-md-3 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="avatar mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-primary">
                            <i class="bx bx-package fs-4"></i></span>
                    </div>
                    <span class="d-block text-nowrap">Total Delivery Parcel</span>
                    <h2 class="mb-0">Count Progress</h2>
                </div>
            </div>
        </div>
        <!-- Total Delivery Parcel-->
        <!-- Total Return Parcel-->
        <div class="col-lg-3 col-md-3 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="avatar mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-warning">
                            <i class="bx bx-purchase-tag fs-4"></i></span>
                    </div>
                    <span class="d-block text-nowrap">Total Return Parcel</span>
                    <h2 class="mb-0">Count Progress</h2>
                </div>
            </div>
        </div>
        <!-- Total Return Parcel-->
        <!-- Total Waiting Pickup Parcel-->
        <div class="col-lg-3 col-md-3 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="avatar mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-info">
                            <i class="bx bx-box fs-4"></i></span>
                    </div>
                    <span class="d-block text-nowrap">Total Waiting Pickup Parcel</span>
                    <h2 class="mb-0">{{ $total_pickup_pending }}</h2>
                </div>
            </div>
        </div>
        <!-- Total Waiting Pickup Parcel-->
        <!-- Total Waiting Delivery Parcel-->
        <div class="col-lg-3 col-md-3 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="avatar mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-info">
                            <i class="bx bxs-package fs-4"></i></span>
                    </div>
                    <span class="d-block text-nowrap">Total Waiting Delivery Parcel</span>
                    <h2 class="mb-0">{{ $total_delivery_parcel_pending }}</h2>
                </div>
            </div>
        </div>
        <!-- Total Waiting Delivery Parcel-->

        <!-- Total Delivery Complete Parcel-->
        <div class="col-lg-3 col-md-3 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="avatar mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-success">
                            <i class="bx bxs-package fs-4"></i></span>
                    </div>
                    <span class="d-block text-nowrap">Total Delivery Complete Parcel</span>
                    <h2 class="mb-0">{{ $total_delivery_parcel_complete }}</h2>
                </div>
            </div>
        </div>
        <!-- Total Delivery Complete Parcel-->

        <!-- Total Return Complete Parcel-->
        <div class="col-lg-3 col-md-3 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="avatar mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-secondary">
                            <i class="bx bx-package fs-4"></i></span>
                    </div>
                    <span class="d-block text-nowrap">Total Return Complete Parcel</span>
                    <h2 class="mb-0">Count Progress</h2>
                </div>
            </div>
        </div>
        <!-- Total Return Complete Parcel-->
        <!-- Total Pending Collect Amount-->
        <div class="col-lg-3 col-md-3 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="avatar mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-warning">
                            <i class="bx bx-money fs-4"></i></span>
                    </div>
                    <span class="d-block text-nowrap">Total Pending Collect Amount</span>
                    <h2 class="mb-0">Count Progress</h2>
                </div>
            </div>
        </div>
        <!-- Total Pending Collect Amount-->
        <!-- Total Collect Amount-->
        <div class="col-lg-3 col-md-3 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="avatar mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-success">
                            <i class="bx bx-money fs-4"></i></span>
                    </div>
                    <span class="d-block text-nowrap">Total Collect Amount</span>
                    <h2 class="mb-0">Count Progress</h2>
                </div>
            </div>
        </div>
        <!-- Total Collect Amount-->
    </div>
@endsection
