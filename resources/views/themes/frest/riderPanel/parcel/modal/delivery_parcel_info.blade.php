<div class="modal-header">
    <h5 class="modal-title" id="title">Parcel Information View
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="card card-action">
        <div class="card-header align-items-center">
            <h5 class="card-action-title mb-0">Parcel Information </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xl-7 col-12">
                    <dl class="row mb-0">
                        <dt class="col-sm-4 mb-2">Parcel ID :</dt>
                        <dd class="col-sm-8">{{ $parcel->parcel_id }} </dd>
                    </dl>
                </div>
                <div class="col-xl-5 col-12">
                    <dl class="row mb-0">
                        <dt class="col-sm-4 mb-2">Date:</dt>
                        <dd class="col-sm-8">{{ $parcel->created_at }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>


    <div class="card card-action mt-3 mb-3">
        <div class="card-header align-items-center">
            <h5 class="card-action-title mb-0">Parcel Charge </h5>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xl-7 col-12">
                    <dl class="row mb-0">
                        <dt class="col-sm-6 mb-2">Weight Package :</dt>
                        <dd class="col-sm-6">Upto 1 kg</dd>
                        <dt class="col-sm-6 mb-2">COD Percent :</dt>
                        <dd class="col-sm-6">1 %</dd>
                        <dt class="col-sm-6 mb-2">Collection Amount :</dt>
                        <dd class="col-sm-6"> {{ $parcel->collection_amount }}</dd>
                    </dl>
                </div>
                <div class="col-xl-5 col-12">
                    <dl class="row mb-0">
                        <dt class="col-sm-6 mb-2">Delivery Charge:</dt>
                        <dd class="col-sm-6">10</dd>
                        <dt class="col-sm-6 mb-2">COD Charge:</dt>
                        <dd class="col-sm-6">10</dd>
                        <dt class="col-sm-6 mb-2">Total Charge :</dt>
                        <dd class="col-sm-6">30</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="card card-action">
                <div class="card-header align-items-center">
                    <h5 class="card-action-title mb-0">Merchant Information
                    </h5>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <dl class="row mb-0">
                                <dt class="col-sm-6 mb-2">Name :</dt>
                                <dd class="col-sm-6">{{ $parcel->merchant->name }}</dd>
                                <dt class="col-sm-6 mb-2">Contact :</dt>
                                <dd class="col-sm-6">{{ $parcel->merchant->phone }}</dd>
                                <dt class="col-sm-6 mb-2">Address :</dt>
                                <dd class="col-sm-6">Cumilla, Dhaka

                                </dd>
                            </dl>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-action">
                <div class="card-header align-items-center">
                    <h5 class="card-action-title mb-0">Customer Information

                    </h5>

                </div>

                <div class="card-body">
                    <div class="row">
                        <dt class="col-sm-6 mb-2">Name :</dt>
                        <dd class="col-sm-6">{{ $parcel->customer_name }}</dd>
                        <dt class="col-sm-6 mb-2">Contact :</dt>
                        <dd class="col-sm-6">{{ $parcel->customer_phone }}</dd>
                        <dt class="col-sm-6 mb-2">Address :</dt>
                        <dd class="col-sm-6">{{ $parcel->address }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-6">
            <div class="card card-action">
                <div class="card-header align-items-center">
                    <h5 class="card-action-title mb-0">Pickup Branch Information

                    </h5>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <dl class="row mb-0">
                                <dt class="col-sm-6 mb-2">Pickup Date :</dt>
                                <dd class="col-sm-6">09/08/2022
                                </dd>
                                <dt class="col-sm-6 mb-2">Name :</dt>
                                <dd class="col-sm-6">Himal</dd>
                                <dt class="col-sm-6 mb-2">Contact :</dt>
                                <dd class="col-sm-6">01918183822</dd>
                                <dt class="col-sm-6 mb-2">Address :</dt>
                                <dd class="col-sm-6">Cumilla, Dhaka </dd>
                            </dl>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-action">
                <div class="card-header align-items-center">
                    <h5 class="card-action-title mb-0">Pickup Rider Information</h5>

                </div>
                <div class="card-body">
                    <div class="row">
                        <dt class="col-sm-6 mb-2">Pickup Date :</dt>
                        <dd class="col-sm-6">09/08/2022
                        </dd>
                        <dt class="col-sm-6 mb-2">Name :</dt>
                        <dd class="col-sm-6">Himal</dd>
                        <dt class="col-sm-6 mb-2">Contact :</dt>
                        <dd class="col-sm-6">01918183822</dd>
                        <dt class="col-sm-6 mb-2">Address :</dt>
                        <dd class="col-sm-6">Cumilla, Dhaka</dd>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
        Close
    </button>
    <button type="button" class="btn btn-primary">Save</button>
</div>
