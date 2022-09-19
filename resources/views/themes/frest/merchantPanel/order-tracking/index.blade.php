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
        <form class="card-body">
            <div class="row g-3">
                <div class="col-md-5">
                    <label class="form-label" for="parcel-number">Order Number</label>
                    <input type="text" id="" class="form-control" placeholder="Enter Parcel Invoice Barcode">
                </div>
                <div class="col-md-5">
                    <label class="form-label" for="merchant-order-id">Merchant Order ID</label>
                    <input type="text" id="" class="form-control" placeholder="Enter Merchant Order ID">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary mt-4 w-100">
                        <span class="tf-icons bx bx-search-alt-2"></span> Search
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('inline-js')
@endsection
