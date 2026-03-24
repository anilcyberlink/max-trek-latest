@extends('themes.default.common.master')
@section('title',$data->title)
@section('meta_keyword',$data->meta_keyword)
@section('meta_description',$data->meta_description)
@section('thumbnail',$data->thumbnail)
@section('brief',$data->brief)
@section('content')

<section>
    <div class=" uk-innerpage-banner uk-flex uk-flex-center uk-flex-middle">
        <div class="uk-text-center uk-margin-top">
            <span class="section-tag uk-text-uppercase uk-margin-small-top"><a href="{{ url('/')}}" class="text-white">Home</a> / {{ $data->post_type }}</span>
            <h1 class="uk-text-uppercase text-white fw-600 uk-margin-small-top uk-margin-remove-bottom ls-4">{{ $data->post_tag }}</h1>
            <div class="divider">
                <span class="line"></span>
                <span class="icon"><i class="fa-solid fa-plane"></i></span>
                <span class="line"></span>
            </div>
        </div>
    </div>
</section>

<section class="uk-section">
    <div class="uk-container  mt-50">
        <div class=" uk-inline-clip uk-transition-toggle border-rounded uk-media-400 uk-margin-bottom">
            <img src="{{ $data->page_banner ? asset('uploads/banners/'.$data->page_banner) : asset('themes-assets/img/mountain1.jpg') }}" class="border-rounded uk-transition-scale-up uk-transition-opaque" loading="lazy" height="500" width="500" alt="{{$data->post_title}}">
        </div>
        <div uk-grid>
            <div class="uk-width-2-3@m uk-margin-top">
                <div>
                    <h3 class="f-20 fw-600 uk-margin-remove">{{$data->post_title}}</h3>
                    <hr style="border-top: 3px dotted grey;">
                    <div class="uk-flex " style="gap:25px;">
                        <!-- <div class="uk-flex uk-flex-middle text-primary fw-600">
                            <span uk-icon="icon: location" class="uk-margin-small-right text-secondary"></span>Nepal
                        </div> -->
                        <div class="uk-flex uk-flex-middle text-primary fw-600">
                            <span uk-icon="icon: calendar" class="uk-margin-small-right text-secondary"></span>
                            {{ date('F j, Y', strtotime($data->post_date)) }}
                        </div>
                    </div>
                    <p class="uk-text-justify">
                        {!! $data->post_excerpt !!}
                    </p>
                    {!! $data->post_content !!}
                </div>
            </div>
            <div class="uk-width-1-3@m uk-margin-top">
                <div  uk-sticky="end: true;offset: 100;" style="z-index:100;">
                    @include('themes.default.common.sidebar')
                    <div class="uk-margin-top">
                        <h4 class="text-primart fw-600 uk-margin-remove">SHARE THIS:</h4>
                        <div class="uk-share-icon  uk-text-left   uk-margin-bottom">
                            <a href="#" target="_blank" class="uk-icon-button uk-margin-small-right" uk-icon="instagram"></a>
                            <a href="#" target="_blank" class="uk-icon-button  uk-margin-small-right" uk-icon="facebook"></a>
                            <a href="#" target="_blank" class="uk-icon-button  uk-margin-small-right" uk-icon="x"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop