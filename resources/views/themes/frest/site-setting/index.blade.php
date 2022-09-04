@extends('themes.frest.layouts.app')
@section('content')
    <div class="card mb-4">
        <h5 class="card-header">Site Setting</h5>
        <form class="card-body" action="{{ route('site.setting.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h6 class="fw-normal">1. Contact Info</h6>
            <div class="row g-3">
                <input type="hidden" name="id" value="{{ $site_setting->id }}">
                <div class="col-md-4">
                    <label class="form-label">Website Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $site_setting->name ?? '' }}"
                        placeholder="Website Name">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Website Emaill</label>
                    <input type="email" class="form-control" name="email" value="{{ $site_setting->email ?? '' }}"
                        placeholder="Website Email Address">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Website Phone</label>
                    <input type="text" class="form-control" name="phone" value="{{ $site_setting->phone ?? '' }}"
                        placeholder="Website Phone Number">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Website Address</label>
                    <textarea class="form-control" name="address" placeholder="{{ $site_setting->address ?? '' }}">{{ $site_setting->address ?? '' }}</textarea>
                </div>
            </div>
            <hr class="my-4 mx-n4">
            <h6 class="fw-normal">2. Site Content</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Website Logo</label>
                    <input class="form-control" type="file" name="logo">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Website Favicon Icon</label>
                    <input class="form-control" type="file" name="favicon">
                </div>
                <div class="col-md-6">
                    <div class="card shadow-none bg-light border border-primary mb-3" style="max-height: 150px">
                        <div class="card-body">
                            <img class="card-img-left" src="/app/{{ $site_setting->logo ?? '' }}" alt="Card image"
                                width="100px">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-none bg-light border border-primary mb-3" style="max-height: 150px">
                        <div class="card-body">
                            <img class="card-img-left" src="/app/{{ $site_setting->favicon ?? '' }}" alt="Card image"
                                width="100px">
                        </div>
                    </div>
                </div>

            </div>
            <hr class="my-4 mx-n4">
            <h6 class="fw-normal">2. SEO & Social</h6>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Website Copyright</label>
                    <input type="text" class="form-control" name="copyright" value="{{ $site_setting->copyright ?? '' }}"
                        placeholder="Website Copyright">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Website Facebook Link</label>
                    <input type="text" class="form-control" name="facebook" value="facebook"
                        placeholder="Website Facebook Link">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Website Meta Title</label>
                    <input type="text" class="form-control" name="meta_title"
                        value="{{ $site_setting->meta_title ?? '' }}" placeholder="Website Meta Title">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Website Meta Description</label>
                    <textarea class="form-control" name="meta_description" placeholder="{{ $site_setting->meta_description ?? '' }}">{{ $site_setting->meta_description ?? '' }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Website Meta Keyword</label>
                    <input type="text" class="form-control" name="meta_keywords"
                        value="{{ $site_setting->meta_keywords ?? '' }}" placeholder="Website Meta Keyword">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Google Map Link</label>
                    <input type="text" class="form-control" name="google_map"
                        value="{{ $site_setting->google_map ?? '' }}" placeholder="Website Name">
                </div>
            </div>
            <div class="pt-4">
                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            </div>
        </form>
    </div>
@endsection
