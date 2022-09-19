@extends('themes.frest.layouts.app')
@section('title', 'Admin Dashboard')

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4">Welcome Back - {{ Auth::user()->name }}</h4>
    <div class="row">
        <!-- Total Branch-->
        <div class="col-lg-3 col-md-3 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="avatar mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-success">
                            <i class="bx bx-home fs-4"></i></span>
                    </div>
                    <span class="d-block text-nowrap">Total Branch</span>
                    <h2 class="mb-0">{{ $total_branch }}</h2>
                </div>
            </div>
        </div>
        <!-- Total Branch-->
        <!-- Total merchant-->
        <div class="col-lg-3 col-md-3 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="avatar mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-success">
                            <i class="bx bx-user-check fs-4"></i></span>
                    </div>
                    <span class="d-block text-nowrap">Total Merchant</span>
                    <h2 class="mb-0">{{ $total_merchants }}</h2>
                </div>
            </div>
        </div>
        <!-- Total merchant-->
        <!-- Total rider-->
        <div class="col-lg-3 col-md-3 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="avatar mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-success">
                            <i class="bx bx-run fs-4"></i></span>
                    </div>
                    <span class="d-block text-nowrap">Total Rider</span>
                    <h2 class="mb-0">{{ $total_riders }}</h2>
                </div>
            </div>
        </div>
        <!-- Total merchant-->
        <!-- Total parcels-->
        <div class="col-lg-3 col-md-3 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="avatar mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-success">
                            <i class="bx bx-box fs-4"></i></span>
                    </div>
                    <span class="d-block text-nowrap">Total Parcels</span>
                    <h2 class="mb-0">{{ $total_parcels }}</h2>
                </div>
            </div>
        </div>
        <!-- Total parcels-->
    </div>
@endsection
