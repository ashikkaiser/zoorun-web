@extends('themes.frest.partials.merchantPanel.app')
@section('title', 'Merchant Delivery Parcel List')
@section('content')
    <div class="col-md-12 col-lg-12">
        <div class="card mb-3">
            @include('themes.frest.partials.alerts')
            <div class="card-body">
                <h5 class="card-title">Bulk Parcel Upload</h5>
                <p class="card-text">For Download Sample File
                    <a href="/sample-file/bulk_upload.xlsx">Click Here</a>
                </p>
                <div class="row">

                    <div class="col-md-10">
                        <form action="{{ route('merchant.parcel.booking.bulk.process') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="file" class="form-control" name="file" accept=".xlsx, .xls">
                            </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Start Process</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
