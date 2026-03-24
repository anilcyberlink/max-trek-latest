@extends('themes.default.common.master')
@section('title', $data->title)
@section('meta_keyword', $data->title)
@section('meta_description', $data->content)
@section('thumbnail', $data->banner)
@section('brief', $data->content)
@section('content')

<!-- banner section start -->
<section>
    <div class=" uk-innerpage-banner uk-flex uk-flex-center uk-flex-middle">
        <div class="uk-text-center uk-margin-top">
            <span class="section-tag uk-text-uppercase uk-margin-small-top"><a href="{{url('/')}}" class="text-white">Home</a> / Trekking</span>
            <h1 class="uk-text-uppercase text-white fw-600 uk-margin-small-top uk-margin-remove-bottom ls-4">{{ $data->title }}</h1>
            <div class="divider">
                <span class="line"></span>
                <span class="icon"><i class="fa-solid fa-plane"></i></span>
                <span class="line"></span>
            </div>
        </div>
    </div>
</section>
<!-- banner section end -->

<!-- introduction section start  -->
<section class="uk-section uk-position-relative">
    <div class="uk-container uk-container-large">
        <div class="uk-flex uk-flex-left">
            <h1 class="text-primary fw-600 hb-bottom">{{ $data->excerpt }}<span class="text-secondary"></span></h1>
        </div>
        <p class="uk-margin-remove uk-text-justify">
            {!! $data->content !!}
        </p>
    </div>
    <img src="{{asset('themes-assets/img/tree.png')}}" alt="" class="tree-image">
</section>
<!-- introduction section end  -->

<!-- package section start -->
<section class="uk-section bg-light-blue">
    <div class="uk-container-large uk-container">
        <div class=" uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l uk-grid-small" uk-grid>
            @foreach($trips as $row)
                <div class="uk-margin-top">
                    <div class="uk-travel-card bg-white">
                        <div>
                            <a href="{{ url('page/' . tripurl($row->uri)) }}"class="uk-media-220 uk-inline-clip uk-transition-toggle border-rounded">
                                <img src="{{ $row->thumbnail ? asset('uploads/original/'.$row->thumbnail) : asset('themes-assets/img/mountain/mountain-1.jpeg') }}" class="border-rounded uk-transition-scale-up uk-transition-opaque" loading="lazy" height="500" width="500" alt="{{$row->trip_title}}">
                            </a>
                        </div>
                        <div class="uk-travel-text uk-grid-collapse uk-grid ">
                            <div class="uk-width-2-3">
                                <a href="{{ url('page/' . tripurl($row->uri)) }}"class="two-line">{{$row->trip_title}}</a>
                            </div>
                            <div class="uk-width-1-3  text-primary uk-text-right ">
                                <!-- <i class="fa-solid fa-star text-secondary"></i> 4.0 -->
                            </div>
                        </div>
                        <div class="uk-travel-price uk-flex uk-flex-between">
                            <div>
                                @if($row->starting_price)
                                <span>
                                    <b class="text-primary f-18">${{ $row->starting_price }}</b>
                                </span>
                                @endif
                            </div>
                            <div class="uk-flex uk-flex-middle">
                                @if($row->peak_name)
                                <span uk-icon="icon: location" class="uk-margin-small-right text-secondary"></span>{{ $row->peak_name}}
                                @endif
                            </div>
                            <div class="uk-flex uk-flex-middle">
                                @if($row->duration)
                                <span uk-icon="icon: calendar" class="uk-margin-small-right text-secondary"></span>
                                {{ $row->duration }} Days
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div>
            {!! $trips->links('themes.default.common.pagination') !!}
        </div>
    </div>
</section>
<!-- package section end -->

@stop
