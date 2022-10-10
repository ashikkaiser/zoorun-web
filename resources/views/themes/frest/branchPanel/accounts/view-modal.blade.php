<div class="card invoice-preview-card">

    <div class="card-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float: right;"></button>
        <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column p-sm-3 p-0">
            <div class="mb-xl-0 mb-4">
                <div class="d-flex svg-illustration mb-3 gap-2">
                    <img src="/app/{{ $site->logo }}" alt="logo" height="75">
                </div>
                <span class="app-brand-text h3 mb-0 fw-bold">{{ $site->name }}</span>
                <p class="mb-1">{{ $site->address }}</p>
                <p class="mb-0">{{ $site->phone }}</p>
                <p class="mb-0">{{ $site->email }}</p>
            </div>
            <div>
                <h4>Invoice #{{ $payment_id->invoice_id }}</h4>
                <div class="mb-2">
                    <span class="me-1">Date Issues:</span>
                    <span class="fw-semibold">{{ $payment_id->created_at->format('d-M-Y') }}</span>
                </div>
                <div class="mb-2">
                    @if ($payment_id->payment_status == 'pending')
                        <span class="badge bg-label-danger" style="font-size: 30px">Pending</span>
                    @else
                        <span class="badge bg-label-success" style="font-size: 30px">Paid</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <hr class="my-0">
    <div class="card-body">
        <div class="row p-sm-3 p-0">
            <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                <h6 class="pb-2">Invoice To:</h6>
                <p class="mb-1">{{ $payment_id->merchant->name }}</p>
                <p class="mb-1">{{ $payment_id->merchant->company }}</p>
                <p class="mb-1">{{ $payment_id->merchant->company_address }}</p>
                <p class="mb-1">{{ $payment_id->merchant->phone }}</p>
                <p class="mb-0">{{ $payment_id->merchant->email }}</p>
            </div>
            <div class="col-xl-6 col-md-12 col-sm-7 col-12">
                <h6 class="pb-2">Payment Details:</h6>
                <table>
                    <tbody>
                        <tr>
                            <td class="pe-3">Total Amount:</td>
                            <td>{{ $payment_id->total_amount }}</td>
                        </tr>
                        <tr>
                            <td class="pe-3">Payment Method:</td>
                            <td>
                                @if ($payment_id->payment_method == null)
                                @else
                                    {{ $payment_id->paymentMethod->name }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="pe-3">Payment Slip:</td>
                            <td>{{ $payment_id->payment_slip }}</td>
                        </tr>
                        <tr>
                            <td class="pe-3">Payment Note:</td>
                            <td>{{ $payment_id->payment_note }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table border-top m-0">
            <thead>
                <tr>
                    <th>Parcel ID</th>
                    <th>Description</th>
                    <th>Delivery Chanrge</th>
                    <th>Qty</th>
                    <th>Collected Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payment_id->parcels as $item)
                    <tr>
                        <td class="text-nowrap">{{ $item->parcel->parcel_id }}</td>
                        <td class="text-nowrap">{{ $item->parcel->product_details }}</td>
                        <td>{{ $item->parcel->delivery_charge }} TK</td>
                        <td>1</td>
                        <td>{{ $item->parcel->collected_amount }} </td>

                    </tr>
                @endforeach

                <tr>
                    <td colspan="3" class="align-top px-4 py-5">

                        <span>Thanks for your business</span>
                    </td>
                    <td class="text-end px-4 py-5">
                        <p class="mb-2">Subtotal:</p>
                        <p class="mb-2">Discount:</p>
                        <p class="mb-2">Delivery Charge:</p>
                        <p class="mb-0">Total:</p>
                    </td>
                    <td class="px-4 py-5">
                        <p class="fw-semibold mb-2">
                            {{ $payment_id->parcels->map(function ($item) {
                                    return $item->parcel->collected_amount;
                                })->sum() }}
                            TK
                        </p>

                        <p class="fw-semibold mb-2">- {{ $payment_id->discount }} TK</p>
                        <p class="fw-semibold mb-2">
                            -
                            {{ $payment_id->parcels->map(function ($item) {
                                    return $item->parcel->delivery_charge;
                                })->sum() }}
                            TK</p>

                        <p class="fw-semibold mb-0">{{ $payment_id->total_amount }}TK</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <span class="fw-semibold">Note:</span>
                <span>It was a pleasure working with you and your team. We hope you will keep us in mind for
                    future. Thank You!</span>
            </div>
        </div>
    </div>
</div>
