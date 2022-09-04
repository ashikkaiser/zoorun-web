<div class="modal-header">
    <h5 class="modal-title">View Details</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    {{-- {{ $riderRun }} --}}
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Rider Run Information</h5>
                    <table class="table table-style">
                        <tbody>
                            <tr>
                                <th style="width: 40%"> Run ID </th>
                                <td style="width: 10%"> : </td>
                                <td style="width: 50%"> {{ $riderRun->run_id }}</td>
                            </tr>
                            <tr>
                                <th style="width: 40%">Create Date </th>
                                <td style="width: 10%"> : </td>
                                <td style="width: 50%"> {{ $riderRun->create_date_time }} </td>
                            </tr>

                            <tr>
                                <th style="width: 40%">Start Date </th>
                                <td style="width: 10%"> : </td>
                                <td style="width: 50%"> {{ $riderRun->created_at }} </td>
                            </tr>



                            <tr>
                                <th style="width: 40%">Total Parcel </th>
                                <td style="width: 10%"> : </td>
                                <td style="width: 50%"> {{ $riderRun->total_parcel }} </td>
                            </tr>
                            <tr>
                                <th style="width: 40%">Total Run Complete </th>
                                <td style="width: 10%"> : </td>
                                <td style="width: 50%"> {{ $riderRun->complete_parcel }} </td>
                            </tr>
                            <tr>
                                <th style="width: 40%">Status </th>
                                <td style="width: 10%"> : </td>
                                <td style="width: 50%">
                                    <span class="badge bg-success">{{ $riderRun->status }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 40%"> Rider Run Note </th>
                                <td style="width: 10%"> : </td>
                                <td style="width: 50%"> {{ $riderRun->notes }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Rider Information</h5>
                    <table class="table table-style">
                        <tbody>
                            <tr>
                                <th style="width: 40%"> Name </th>
                                <td style="width: 10%"> : </td>
                                <td style="width: 50%"> {{ $riderRun->rider->name ?? 'Not Assaign' }} </td>
                            </tr>
                            <tr>
                                <th style="width: 40%"> Contact Number </th>
                                <td style="width: 10%"> : </td>
                                <td style="width: 50%"> {{ $riderRun->rider->phone ?? 'Not Assaign' }} </td>
                            </tr>
                            <tr>
                                <th style="width: 40%"> Address </th>
                                <td style="width: 10%"> : </td>
                                <td style="width: 50%"> {{ $riderRun->rider->address ?? 'Not Assaign' }} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Table --}}
    <div class="card">
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
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
        Close
    </button>
</div>
