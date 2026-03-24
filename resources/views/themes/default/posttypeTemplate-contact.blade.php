@extends('themes.default.common.master')
@section('title', $data->title)
@section('meta_keyword', $data->meta_keyword)
@section('meta_description', $data->meta_description)
@section('thumbnail', $data->thumbnail)
@section('brief', $data->brief)
@section('content')

<!-- banner section start -->
<section>
    <div class=" uk-innerpage-banner uk-flex uk-flex-center uk-flex-middle">
        <div class="uk-text-center uk-margin-top">
            <span class="section-tag uk-text-uppercase uk-margin-small-top"><a href="{{ url('/')}}"
                    class="text-white">Home</a> / {{ $data->post_type }}</span>
            <h1 class="uk-text-uppercase text-white fw-600 uk-margin-small-top uk-margin-remove-bottom ls-4">
                {{ $data->post_tag }}</h1>
            <div class="divider">
                <span class="line"></span>
                <span class="icon"><i class="fa-solid fa-plane"></i></span>
                <span class="line"></span>
            </div>
        </div>
    </div>
</section>
<!-- banner section end -->

<!-- contact section start -->
<section class="uk-section">
    <div class="uk-container uk-container-large">
        <div class="uk-grid  uk-child-width-1-3@m">
            <div class="uk-margin-small-bottom">
                <div class="bg-primary uk-padding-small border-rounded  uk-box-shadow-medium uk-flex uk-flex-middle" style="height:32px;">
                    <img src="{{asset('themes-assets/img/icon/location.png')}}" height="26" width="26" alt="Contact Us" class="uk-margin-right">
                    <div>
                        <p class="text-white fw-500 uk-margin-remove f-14">{{$setting->address}}</p>
                    </div>
                </div>
            </div>
            <div class="uk-margin-small-bottom">
                <div class="bg-primary uk-padding-small border-rounded uk-box-shadow-medium uk-flex uk-flex-middle" style="height:32px;">
                    <img src="{{asset('themes-assets/img/icon/email.png')}}" height="26" width="26" alt="" class="uk-margin-right">
                    <div>
                        <p class="text-white fw-500 uk-margin-remove f-14">{{$setting->email_primary}}</p>
                    </div>
                </div>
            </div>
            <div class="uk-margin-small-bottom">
                <div class="bg-primary uk-padding-small border-rounded uk-box-shadow-medium uk-flex uk-flex-middle" style="height:32px;">
                    <img src="{{ asset('themes-assets/img/icon/phone.png')}}" height="26" width="26" alt="" class="uk-margin-right">
                    <div>
                        <p class="text-white fw-500 uk-margin-remove f-14">
                            {{$setting->phone}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-grid uk-grid-collapse uk-grid-match uk-margin-top uk-child-width-1-2@m">
            <div class="uk-box-shadow-medium uk-padding uk-margin-top">
                <form class="uk-grid-small" uk-grid>
                    @csrf
                    <div class="uk-width-1-2@s">
                        <label class="uk-form-label text-primary" for="Name">Full Name:</label>
                        <input class="uk-input border-rounded bg-text" name="full_name" type="text" aria-label="Name">
                    </div>
                    <div class="uk-width-1-2@s">
                        <label class="uk-form-label text-primary" for="Contact">Contact:</label>
                        <input class="uk-input border-rounded bg-text" name="number" type="number" aria-label="Contact">
                    </div>
                    <div class="uk-width-1-2@s">
                        <label class="uk-form-label text-primary" for="Email">Email:</label>
                        <input class="uk-input border-rounded bg-text" name="email" type="email" aria-label="Email">
                    </div>

                    <div class="uk-width-1-2@s">
                        <label class="uk-form-label text-primary" for="Email">Country:</label>
                        <select name="country" class="uk-select border-rounded bg-text" id="form-stacked-select">
                            <option value="" disabled selected>Select Country</option>
                            <option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option>
                            <option value="Algeria">Algeria</option>

                            <option value="Zimbabwe">Zimbabwe</option>
                        </select>
                    </div>
                    <div class="uk-width-1-1@s">
                        <label class="uk-form-label text-primary" for="adventure">Trip Interested In:</label>
                        <select name="trip" class="uk-select border-rounded bg-text" id="form-stacked-select">
                            <option selected>--Select Trip--</option>
                            <option value="122">MT. EVEREST EXPEDITIO</option>
                            <option value="123">MT. LHOTSE EXPEDITION (8,516M)</option>
                            <option value="125">ISLAND PEAK EXPEDITION (6,476M)</option>
                            <option value="126">MERA PEAK EXPEDITION (6,476M)</option>

                        </select>
                    </div>
                    <div class="uk-width-1-1">
                        <textarea class="uk-textarea border-rounded bg-text" name="comments" rows="5" placeholder="Message" aria-label="Message"></textarea>
                    </div>
                    <div class="uk-width-1-1 uk-text-center uk-margin-top">
                        <button type="submit" class="uk-small-btn uk-small-btn-primary" style="border:none;">SUBMIT<span uk-icon="icon: arrow-right"></span></button>
                    </div>
                </form>
            </div>
            <div class="uk-margin-top">
                <iframe src="{!!$setting->google_map!!}" width="600" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

        </div>
    </div>
</section>
<!-- contact section end -->

@stop