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
        <form class="card-body" action="" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-10">
                    <label class="form-label" for="merchant-order-id">Merchant Order ID</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-barcode"></i></span>
                        <input type="text" class="form-control" placeholder="please Input Merchant Order Code">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary mt-4 w-100">
                        <span class="tf-icons bx bx-search-alt-2"></span> Search
                    </button>
                </div>
            </div>

        </form>
    </div>

    {{-- Tracking Destils --}}

    <div class="card">
        <h5 class="card-header">Your Parcel <span class="text-success">{{ strtoupper($parcel->merchant_order_id) }}</span>
            Timeline</h5>
        <div class="card-body">
            <ul class="timeline timeline-dashed mt-4">
                @foreach ($parcel_history as $history)
                    <li class="timeline-item timeline-item-success mb-4">
                        <span class="timeline-indicator timeline-indicator-success">
                            <i class="bx bx-check"></i>
                        </span>
                        <div class="timeline-event">
                            <div class="timeline-header border-bottom mb-3">
                                <h6 class="mb-0">{{ $history->message->message_en }}</h6>
                                <small class="text-muted">{{ $history->message->created_at->format('d-M-Y') }}</small>
                            </div>
                            <div class="d-flex justify-content-between flex-wrap mb-2">
                                <div>
                                    <span>Order Placed By Marchant.</span>
                                </div>
                                <div>
                                    <span>{{ $history->message->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>
@endsection

@section('inline-js')
@endsection
