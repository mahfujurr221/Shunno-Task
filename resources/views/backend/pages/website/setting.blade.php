@extends('backend.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-7 col-xl-9">
        <div class="tab-content" id="v-pills-tabContent">
            {{-- Basic Information --}}
            <div class="tab-pane fade show active" id="v-pills-basic-information" role="tabpanel"
                aria-labelledby="v-pills-basic-information-tab">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="mb-0 card-title">Edit Basic Information</h5>
                    </div>

                    <div class="my-3 card-body">
                        <form action="{{ route('settings.update', $setting->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="update_section" value="basic_information">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="validationCustom01" class="form-label font-weight-bold">
                                        Website Name</label>
                                    <input type="text" class="form-control" id="validationCustom01" name="site_name"
                                        value="{{ $setting->site_name }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="validationCustom02" class="form-label font-weight-bold">
                                        Website Title</label>
                                    <input type="text" class="form-control" id="validationCustom02" name="site_title"
                                        value="{{ $setting->site_title }}">
                                </div>

                                <div class="mb-5 col-md-6">
                                    <label for="validationCustom05" class="form-label font-weight-bold">
                                        Website Logo</label>
                                    <input class="mr-5 form-control" id="validationCustom05" type="file" name="logo"
                                        accept="image/*">
                                    <img style="max-width: 200px; max-height: 200px; margin-top:25px" id="logo"
                                        src="{{ asset('uploads') }}/{{ $setting->logo }}"
                                        alt="{{ $setting->site_name }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="validationCustom06" class="form-label font-weight-bold">
                                        Website Favicon</label>
                                    <input class="mr-5 form-control" id="validationCustom06" type="file" name="favicon"
                                        accept="image/*">
                                    <img style="max-width: 250px; max-height: 150px; margin-top:25px" id="favicon"
                                        src="{{ asset('uploads') }}/{{ $setting->favicon }}"
                                        alt="{{ $setting->site_name }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="validationCustom07" class="form-label font-weight-bold">
                                        Phone Number</label>
                                    <input type="text" class="form-control" id="validationCustom07" name="phone"
                                        value="{{ $setting->phone }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="validationCustom08" class="form-label font-weight-bold">
                                        Email Address</label>
                                    <input type="text" class="form-control" id="validationCustom08" name="email"
                                        value="{{ $setting->email }}">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="validationCustom08" class="form-label font-weight-bold">
                                        Footer Text</label>
                                    <input type="text" class="form-control" id="validationCustom08" name="footer_text"
                                        value="{{ $setting->footer_text }}">
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="validationCustom08" class="form-label font-weight-bold">
                                         Newslatter Text</label>
                                    <input type="text" class="form-control" id="validationCustom08" name="newslatter_text"
                                        value="{{ $setting->newslatter_text }}">
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="validationCustom08" class="form-label font-weight-bold">
                                         Headline</label>
                                    <input type="text" class="form-control" id="validationCustom08" name="headline"
                                        value="{{ $setting->headline }}">
                                </div>


                                <div class="mb-3 col-md-12">
                                    <label for="validationCustom03" class="form-label font-weight-bold">
                                        Website Address</label>
                                    <textarea class="form-control" id="validationCustom03" rows="5"
                                        name="address">{{ $setting->address }}</textarea>
                                </div>
                                <div class="mb-3 col-md-12" hidden>
                                    <label for="validationCustom04" class="form-label font-weight-bold">
                                        Website Address2</label>
                                    <input type="text" class="form-control" id="validationCustom04" name="address2"
                                        value="{{ $setting->address2 }}">
                                </div>
                            </div>
                            <div class="mt-3 text-center col-md-12">
                                <button type="submit" class="btn btn-primary font-16">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Social --}}
            <div class="tab-pane fade" id="v-pills-social" role="tabpanel" aria-labelledby="v-pills-social-tab">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="mb-2 card-title">Social Media Links</h5>
                    </div>
                    <div class="my-3 card-body">
                        <form action="{{ route('settings.update', $setting->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="update_section" value="social">
                            <div class="form-row">
                                <div class="mb-3 col-md-12">
                                    <label for="validationCustom09" class="form-label font-weight-bold">
                                        Facebook</label>
                                    <input type="text" class="form-control" id="validationCustom09" name="facebook"
                                        value="{{ $setting->facebook }}">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="validationCustom10" class="form-label font-weight-bold">
                                        Twitter</label>
                                    <input type="text" class="form-control" id="validationCustom10" name="twitter"
                                        value="{{ $setting->twitter }}">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="validationCustom11" class="form-label font-weight-bold">
                                        Instagram</label>
                                    <input type="text" class="form-control" id="validationCustom11" name="instagram"
                                        value="{{ $setting->instagram }}">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="validationCustom12" class="form-label font-weight-bold">
                                        Youtube</label>
                                    <input type="text" class="form-control" id="validationCustom12" name="youtube"
                                        value="{{ $setting->youtube }}">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="validationCustom13" class="form-label font-weight-bold">
                                        Linkedin</label>
                                    <input type="text" class="form-control" id="validationCustom13" name="linkedin"
                                        value="{{ $setting->linkedin }}">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="validationCustom14" class="form-label font-weight-bold">
                                        Pinterest</label>
                                    <input type="text" class="form-control" id="validationCustom14" name="pinterest"
                                        value="{{ $setting->pinterest }}">
                                </div>
                            </div>
                            <div class="mt-3 text-center col-md-12">
                                <button type="submit" class="btn btn-primary font-16">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- SEO --}}
            <div class="tab-pane fade" id="v-pills-seo" role="tabpanel" aria-labelledby="v-pills-seo-tab">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="mb-0 card-title">SEO</h5>
                    </div>
                    <div class="my-3 card-body">
                        <form action="{{ route('settings.update', $setting->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="update_section" value="seo">
                            <div class="form-row">
                                <div class="mb-3 col-md-12">
                                    <label for="validationCustom15" class="form-label font-weight-bold">
                                        Meta Title</label>
                                    <input type="text" class="form-control" id="validationCustom15" name="meta_title"
                                        value="{{ $setting->meta_title }}">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="validationCustom16" class="form-label font-weight-bold">
                                        Meta Keywords</label>
                                    <input type="text" class="form-control tagsinput" id="validationCustom16"
                                        data-role="tagsinput" placeholder="Enter Meta Keywords" name="meta_keywords"
                                        value="{{ json_decode($setting->meta_keywords) }}">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="validationCustom17" class="form-label font-weight-bold">
                                        Meta Description</label>
                                    <textarea class="form-control" id="validationCustom17" rows="5"
                                        placeholder="Enter Meta Description"
                                        name="meta_description">{{ $setting->meta_description }}</textarea>
                                </div>
                            </div>
                            <div class="mt-3 text-center col-md-12">
                                <button type="submit" class="btn btn-primary font-16">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Google Map API --}}
            <div class="tab-pane fade" id="v-pills-google-map" role="tabpanel" aria-labelledby="v-pills-google-map-tab">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="mb-0 card-title">Google Map</h5>
                    </div>
                    <div class="my-3 card-body">
                        <form action="{{ route('settings.update', $setting->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="update_section" value="google_map">
                            <div class="form-row">
                                <div class="mb-3 col-md-12">
                                    <label for="validationCustom15" class="form-label font-weight-bold">
                                        Google Map </label>
                                    <input type="text" class="form-control" id="validationCustom15"
                                        name="google_map" value="{{ $setting->google_map }}">
                                </div>
                            </div>
                            <div class="mt-3 text-center col-md-12">
                                <button type="submit" class="btn btn-primary font-16">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- side nav -->
    <div class="col-lg-5 col-xl-3">
        <div class="card m-b-30">
            <div class="card-header">
                <h5 class="mb-0 card-title">Website Setting</h5>
            </div>
            <div class="py-3 card-body">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="mb-2 nav-link active" id="v-pills-basic-information-tab" data-toggle="pill"
                        href="#v-pills-basic-information" role="tab" aria-controls="v-pills-basic-information"
                        aria-selected="false">
                        <i class="mr-2 feather icon-info"></i>
                        Basic Information
                    </a>

                    <a class="mb-2 nav-link" id="v-pills-social-tab" data-toggle="pill" href="#v-pills-social"
                        role="tab" aria-controls="v-pills-social" aria-selected="false">
                        <i class="mr-2 feather icon-link"></i>
                        Social Media Links
                    </a>
                    <a class="mb-2 nav-link" id="v-pills-seo-tab" data-toggle="pill" href="#v-pills-seo" role="tab"
                        aria-controls="v-pills-seo" aria-selected="false">
                        <i class="mr-2 feather icon-search"></i>
                        SEO
                    </a>
                    <a class="nav-link" id="v-pills-google-map-tab" data-toggle="pill" href="#v-pills-google-map"
                        role="tab" aria-controls="v-pills-google-map" aria-selected="false">
                        <i class="mr-2 feather icon-map"></i>
                        Google Map API
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End col -->
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('.nav-pills a').on('click', function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });
    $('#validationCustom05').on('change', function() {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onloadend = function() {
            $('#logo').attr('src', reader.result);
        }
        reader.readAsDataURL(file);
    });
    // name="favicon"
    $('#validationCustom06').on('change', function() {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onloadend = function() {
            $('#favicon').attr('src', reader.result);
        }
        reader.readAsDataURL(file);
    });
</script>
@endpush
