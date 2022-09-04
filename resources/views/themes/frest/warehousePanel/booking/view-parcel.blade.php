<div class="modal-header">
    <h5 class="modal-title">View Details</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    {{ $parcel }}
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Parcel Information</h5>
                    <table class="table table-style">
                        <tbody>
                            <tr>
                                <th style="width: 40%"> Parcel ID </th>
                                <td style="width: 10%"> : </td>
                                <td style="width: 50%"> {{ $parcel->parcel_id }}</td>
                            </tr>
                            <tr>
                                <th style="width: 40%"> Branch Name </th>
                                <td style="width: 10%"> : </td>
                                <td style="width: 50%"> {{ $parcel->branchs->name }}</td>
                            </tr>
                            <tr>
                                <th style="width: 40%"> Merchant Name </th>
                                <td style="width: 10%"> : </td>
                                <td style="width: 50%"> {{ $parcel->merchant->name }}</td>
                            </tr>
                            <tr>
                                <th style="width: 40%"> Merchant Order ID </th>
                                <td style="width: 10%"> : </td>
                                <td style="width: 50%"> {{ $parcel->merchant_order_id }}</td>
                            </tr>
                            <tr>
                                <th style="width: 40%">Customer Name </th>
                                <td style="width: 10%"> : </td>
                                <td style="width: 50%"> {{ $parcel->customer_name }} </td>
                            </tr>
                            <tr>
                                <th style="width: 40%">Delivery Address </th>
                                <td style="width: 10%"> : </td>
                                <td style="width: 50%"> {{ $parcel->delivery_address }} </td>
                            </tr>

                            <tr>
                                <th style="width: 40%">Start Date </th>
                                <td style="width: 10%"> : </td>
                                <td style="width: 50%"> {{ $parcel->created_at }} </td>
                            </tr>
                            <tr>
                                <th style="width: 40%">Status </th>
                                <td style="width: 10%"> : </td>
                                <td style="width: 50%">
                                    <span class="badge bg-success">{{ $parcel->status }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Merchant Information</h5>
                            <table class="table table-style">
                                <tbody>
                                    <tr>
                                        <th style="width: 40%"> Name </th>
                                        <td style="width: 10%"> : </td>
                                        <td style="width: 50%"> {{ $parcel->merchant->name }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 40%"> Contact Number </th>
                                        <td style="width: 10%"> : </td>
                                        <td style="width: 50%">{{ $parcel->merchant->phone }} </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 40%"> Order Number </th>
                                        <td style="width: 10%"> : </td>
                                        <td style="width: 50%"> {{ $parcel->merchant_order_id }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"> Delivery Information</h5>
                            <table class="table table-style">
                                <tbody>
                                    <tr>
                                        <th style="width: 40%">Customer Name </th>
                                        <td style="width: 10%"> : </td>
                                        <td style="width: 50%"> {{ $parcel->customer_name }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 40%"> Contact Number </th>
                                        <td style="width: 10%"> : </td>
                                        <td style="width: 50%">{{ $parcel->customer_phone }} </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 40%"> Address </th>
                                        <td style="width: 10%"> : </td>
                                        <td style="width: 50%">{{ $parcel->delivery_address }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Table --}}
    {{-- <div class="card">
        <h5 class="card-header">Delivery Run Parcel</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-nowrap">
                        <th>#</th>
                        <th>Order ID</th>
                        <th>Status</th>
                        <th>Merchant Name</th>
                        <th>Merchant Number</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($riderRun->rider_parcel as $key => $item)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $item->parcel->merchant_order_id }}</td>
                            <td>{{ $item->parcel->status }}</td>
                            <td>{{ $item->parcel->merchant->name }}</td>
                            <td>{{ $item->parcel->merchant->phone }}</td>
                            <td>{{ $item->parcel->remarks }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> --}}

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
        Close
    </button>
</div>
