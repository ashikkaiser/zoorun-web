@extends('admin::partials.merchantPanel.app')
@section('title', 'Merchant Order Tracking')
@section('css')
@endsection

@section('js')
@endsection


@section('content')
    @include('themes.frest.partials.alerts')

    <div class="card mb-4">
        <h5 class="card-header">Order Tracking</h5>
        <form class="card-body" action="{{ route('merchant.order.track.details') }}" method="GET">
            <div class="row g-3">
                {{-- <div class="col-md-5">
                    <label class="form-label" for="parcel-number">Order Number</label>
                    <input type="text" id="" name="parcel_id" class="form-control" placeholder="Enter Parcel Invoice Barcode">
                </div> --}}
                <div class="col-md-10">
                    <label class="form-label" for="merchant-order-id">Merchant Order ID</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-barcode"></i></span>
                        <input type="text" name="merchant_order_id" class="form-control"
                            placeholder="please Input Merchant Order Code">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary mt-4 w-100">
                        <span class="tf-icons bx bx-search-alt-2"></span> Search
                    </button>
                </div>
            </div>

        </form>
    </div>

    {{-- Tracking Destils --}}

    <div class="card" style="display: none">
        <h5 class="card-header">Your Shipment Timeline</h5>
        <div class="card-body">
            <ul class="timeline timeline-dashed mt-4">
                <li class="timeline-item timeline-item-primary mb-4">
                    <span class="timeline-indicator timeline-indicator-primary">
                        <i class="bx bx-paper-plane"></i>
                    </span>
                    <div class="timeline-event">
                        <div class="timeline-header border-bottom mb-3">
                            <h6 class="mb-0">Order Created</h6>
                            <small class="text-muted">3rd October</small>
                        </div>
                        <div class="d-flex justify-content-between flex-wrap mb-2">
                            <div>
                                <span>Order Placed By Marchant.</span>
                            </div>
                            <div>
                                <span>6:30 AM</span>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="timeline-item timeline-item-success mb-4">
                    <span class="timeline-indicator timeline-indicator-success">
                        <i class="bx bx-paint"></i>
                    </span>
                    <div class="timeline-event">
                        <div class="timeline-header border-bottom mb-3">
                            <h6 class="mb-0">Order Created</h6>
                            <small class="text-muted">3rd October</small>
                        </div>
                        <div class="d-flex justify-content-between flex-wrap mb-2">
                            <div>
                                <span>Order Placed By Marchant.</span>
                            </div>
                            <div>
                                <span>6:30 AM</span>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="timeline-item timeline-item-danger mb-4">
                    <span class="timeline-indicator timeline-indicator-danger">
                        <i class="bx bx-shopping-bag"></i>
                    </span>
                    <div class="timeline-event">
                        <div class="timeline-header border-bottom mb-3">
                            <h6 class="mb-0">Order Created</h6>
                            <small class="text-muted">3rd October</small>
                        </div>
                        <div class="d-flex justify-content-between flex-wrap mb-2">
                            <div>
                                <span>Order Placed By Marchant.</span>
                            </div>
                            <div>
                                <span>6:30 AM</span>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="timeline-item timeline-item-info mb-4">
                    <span class="timeline-indicator timeline-indicator-info">
                        <i class="bx bx-user-circle"></i>
                    </span>
                    <div class="timeline-event">
                        <div class="timeline-header border-bottom mb-3">
                            <h6 class="mb-0">Order Created</h6>
                            <small class="text-muted">3rd October</small>
                        </div>
                        <div class="d-flex justify-content-between flex-wrap mb-2">
                            <div>
                                <span>Order Placed By Marchant.</span>
                            </div>
                            <div>
                                <span>6:30 AM</span>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="timeline-item timeline-item-dark mb-4">
                    <span class="timeline-indicator timeline-indicator-dark">
                        <i class="bx bx-bell"></i>
                    </span>
                    <div class="timeline-event">
                        <div class="timeline-header border-bottom mb-3">
                            <h6 class="mb-0">Order Created</h6>
                            <small class="text-muted">3rd October</small>
                        </div>
                        <div class="d-flex justify-content-between flex-wrap mb-2">
                            <div>
                                <span>Order Placed By Marchant.</span>
                            </div>
                            <div>
                                <span>6:30 AM</span>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="timeline-end-indicator">
                    <i class="bx bx-check-circle"></i>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('inline-js')
@endsection
