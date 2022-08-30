<form id="confirmForm" action="{{ route('rider.parcel.confirmParcel', $parcel->id) }}" method="POST">
    @csrf

    {{-- <input type="hidden" name="rider_run_id" value="{{ $parcel->rider_run->id }}"> --}}
    <input type="hidden" name="status" value="4">
    <input type="hidden" name="confirmParcel" value="yes">
    <div class="modal-header">
        <h5 class="modal-title" id="title">Parcel Information View
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="card card-action">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0">Parcel Information
                        </h5>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <dl class="row mb-0">
                                    <dt class="col-sm-5 mb-2">Parcel ID :</dt>
                                    <dd class="col-sm-7">{{ $parcel->parcel_id }} </dd>
                                    <dt class="col-sm-5 mb-2">Merchant ID :</dt>
                                    <dd class="col-sm-7">{{ $parcel->merchant_order_id }} </dd>
                                    <dt class="col-sm-5 mb-2">Weight:</dt>
                                    <dd class="col-sm-7">Upto 1 kg</dd>
                                    {{-- TODO: --}}



                                    </dd>
                                </dl>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-12">
                    <div class="card card-action mb-4">
                        <div class="card-header align-items-center">
                            <h5 class="card-action-title mb-0">Merchant Information</h5>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <dt class="col-sm-6 mb-2">Name :</dt>
                                <dd class="col-sm-6">{{ $parcel->merchant->name }}</dd>
                                <dt class="col-sm-6 mb-2">Contact :</dt>
                                <dd class="col-sm-6">{{ $parcel->merchant->phone }}</dd>
                                <dt class="col-sm-6 mb-2">Address :</dt>
                                <dd class="col-sm-6">Cumilla, Dhaka
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <label for="remarks" class="form-label">Remarks</label>
                <textarea class="form-control" rows="4" name="internal_note"></textarea>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
            Close
        </button>
        <button type="submit" name="confirmParcel" value="yes" class="btn btn-primary">Save</button>
    </div>
</form>
