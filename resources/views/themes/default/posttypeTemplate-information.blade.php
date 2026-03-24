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

<!-- information section start -->
<section class="uk-section">
    <div class="uk-container uk-container-small">
        <h4 class="text-secondary fw-600"></h4>
        <p class="uk-text-justify uk-margin-remove">
            {!! $data->content !!}
        </p>
        <div class="bg-light-blue uk-padding border-rounded uk-box-shadow-medium">
            <p class="uk-text-justify">
                {!! $data->brief !!}
            </p>
        </div>
    </div>
</section>
<!-- information section end -->

@stop