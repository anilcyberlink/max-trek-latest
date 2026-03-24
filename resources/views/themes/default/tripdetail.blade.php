@extends('themes.default.common.master')
@section('title', $data->trip_title)
@section('meta_keyword', $data->meta_keyword)
@section('meta_description', $data->meta_description)
@section('thumbnail', $data->thumbnail)
@section('brief', $data->trip_excerpt)
@section('content')

<!-- banner section start -->
<section>
    <div>
        <img src="{{$data->banner ? asset('uploads/banners/' . $data->banner) : asset('themes-assets/img/mountain/mountain-3.jpeg')}}" alt="{{ $data->trip_title }}" class="uk-banner-image">
        <div class="uk-overlay-default uk-position-cover uk-banner-overlay"></div>
        <div class="uk-overlay uk-position-center uk-light ">
            <div class="uk-text-center uk-margin-top">
                <h1 class="uk-text-uppercase text-white fw-600 uk-margin-small-top uk-margin-remove-bottom ls-4">
                    {{ $data->trip_title }}
                </h1>
                <div class="divider">
                    <span class="line"></span>
                    <span class="icon"><i class="fa-solid fa-plane"></i></span>
                    <span class="line"></span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- banner section end -->
<div class="uk-position-relative detail-nav bg-primary">
    <div class="  uk-sticky"
        uk-sticky="offset: 95;  animation: uk-animation-slide-top uk-animation-slow uk-transform-origin-bottom-center "
        style="z-index:960;">
        <div class="border uk-light">
            <div class="uk-small-details-nav">
                <div class="uk-container uk-position-relative uk-flex bg-primary uk-box-shadow-large border-rounded">
                    <ul
                        class="uk-width-1-1 uk-navbar-single uk-flex uk-flex-between uk-flex-middle uk-margin-remove-bottom sidenav">
                        <li>
                            <a href="#overview">Overview </a>
                        </li>
                        @if($data->trip_map || !empty($data->trip_highlight))
                        <li>
                            <a href="#maps">Route </a>
                        </li>
                        @endif
                        @if($photos->count() > 0)
                        <li>
                            <a href="#photo">Gallery </a>
                        </li>
                        @endif
                        @if($schedules->count() > 0)
                        <li>
                            <a href="#date">Dates</a>
                        </li>
                        @endif
                        @if($itinerary->count() > 0)
                        <li>
                            <a href="#itinerary">Itinerary </a>
                        </li>
                        @endif
                        @if($cost_includes->count() > 0 || $cost_excludes->count() > 0)
                        <li>
                            <a href="#include">Includes / Excludes</a>
                        </li>
                        @endif
                        @if($usefulInfo->count() > 0)
                        <li>
                            <a href="#info">Useful Info</a>
                        </li>
                        @endif
                        @if($reviews->count() > 0)
                        <li>
                            <a href="#review">Review </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- overview section start -->
<section class="uk-section" id="overview">
    <div class="uk-container uk-container-large">
        <div class=" uk-grid-small uk-grid">
            <div class="uk-width-2-3@m uk-width-3-4@l">

                <div>
                    <div class="uk-grid uk-flex uk-flex-middle ">
                        <div class="uk-width-3-4 uk-margin-top">
                            <div class="uk-flex uk-flex-left">
                                <h2 class="text-primary fw-600 hb-bottom">{{ $data->sub_title }}</h2>
                            </div>
                        </div>
                        <div class="uk-width-1-4 uk-text-right uk-margin-top">
                            <div>
                                <i class="fa-solid fa-calendar-days text-primary" style="font-size:32px;"></i>
                                <h4 class="text-primary fw-600 uk-margin-remove f-18">{{ $data->duration }} Days</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- facilities start -->
                <div class="border-rounded  uk-margin-bottom" style="background: #c7e6ff69; padding:25px 12px;">
                    <div class=" uk-grid-small" uk-grid>
                        <div class="uk-width-1-2 uk-width-1-3@m uk-width-1-4@l">
                            <div class="uk-grid uk-grid-collapse uk-child-width-expand uk-flex-nowrap uk-flex-middle" uk-grid="">
                                <div class="uk-width-auto"><img src="{{ asset('themes-assets/img/icon/map.png')}}" class="uk-feature-icon" ></div>
                                <div>
                                    <div>
                                        <p class="uk-margin-remove"><b>Destination</b></p>
                                        <p class="text-secondary uk-margin-remove">{{ $data->peak_name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($data->trip_grade)
                        <div class="uk-width-1-2 uk-width-1-3@m uk-width-1-4@l">
                            <div class="uk-grid uk-grid-collapse uk-child-width-expand uk-flex-nowrap uk-flex-middle" uk-grid="">
                                <div class="uk-width-auto"><img src="{{ asset('themes-assets/img/icon/speedometer.png')}}" class="uk-feature-icon" ></div>
                                <div>
                                    <div>
                                        <p class="uk-margin-remove"><b>Difficulty </b></p>
                                        <p class="text-secondary uk-margin-remove">
                                            {{ grade_message_trek($data->trip_grade) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($data->max_altitude)
                        <div class="uk-width-1-2 uk-width-1-3@m uk-width-1-4@l">
                            <div class="uk-grid uk-grid-collapse uk-child-width-expand uk-flex-nowrap uk-flex-middle"
                                uk-grid="">
                                <div class="uk-width-auto"><img src="{{ asset('themes-assets/img/icon/mountain.png')}}"
                                        class="uk-feature-icon" >
                                </div>
                                <div>
                                    <div>
                                        <p class="uk-margin-remove" style="line-break: anywhere;"><b>Max Elevation</b>
                                        </p>
                                        <p class="text-secondary uk-margin-remove">{{ $data->max_altitude }}m</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($data->group_size)
                        <div class="uk-width-1-2 uk-width-1-3@m uk-width-1-4@l">
                            <div class="uk-grid uk-grid-collapse uk-child-width-expand uk-flex-nowrap uk-flex-middle"
                                uk-grid="">
                                <div class="uk-width-auto"><img src="{{ asset('themes-assets/img/icon/group.png')}}"
                                        class="uk-feature-icon" >
                                </div>
                                <div>
                                    <div>
                                        <p class="uk-margin-remove"><b>Group Size</b></p>
                                        <p class="text-secondary uk-margin-remove">{{ $data->group_size }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($data->start_location)
                        <div class="uk-width-1-2 uk-width-1-3@m uk-width-1-4@l">
                            <div class="uk-grid uk-grid-collapse uk-child-width-expand uk-flex-nowrap uk-flex-middle"
                                uk-grid="">
                                <div class="uk-width-auto"><img
                                        src="{{ asset('themes-assets/img/icon/starting-point.png')}}"
                                        class="uk-feature-icon" >
                                </div>
                                <div>
                                    <div>
                                        <p class="uk-margin-remove"><b>Starts at</b></p>
                                        <p class="text-secondary uk-margin-remove">{{ $data->start_location }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($data->end_location)
                        <div class="uk-width-1-2 uk-width-1-3@m uk-width-1-4@l">
                            <div class="uk-grid uk-grid-collapse uk-child-width-expand uk-flex-nowrap uk-flex-middle"
                                uk-grid="">
                                <div class="uk-width-auto"><img src="{{ asset('themes-assets/img/icon/end-line.png')}}"
                                        class="uk-feature-icon" >
                                </div>
                                <div>
                                    <div>
                                        <p class="uk-margin-remove"><b>Ends at</b></p>
                                        <p class="text-secondary uk-margin-remove">{{ $data->end_location }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($data->accommodation)
                        <div class="uk-width-1-2 uk-width-1-3@m uk-width-1-4@l">
                            <div class="uk-grid uk-grid-collapse uk-child-width-expand uk-flex-nowrap uk-flex-middle"
                                uk-grid="">
                                <div class="uk-width-auto"><img
                                        src="{{ asset('themes-assets/img/icon/accommodation.png')}}"
                                        class="uk-feature-icon" >
                                </div>
                                <div>
                                    <div>
                                        <p class="uk-margin-remove" style="line-break: anywhere;"><b>Accomendation</b>
                                        </p>
                                        <p class="text-secondary uk-margin-remove">{{ $data->accommodation }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($data->best_season)
                        <div class="uk-width-1-2 uk-width-1-3@m uk-width-1-4@l">
                            <div class="uk-grid uk-grid-collapse uk-child-width-expand uk-flex-nowrap uk-flex-middle"
                                uk-grid="">
                                <div class="uk-width-auto"><img
                                        src="{{ asset('themes-assets/img/icon/accommodation.png')}}"
                                        class="uk-feature-icon" >
                                </div>
                                <div>
                                    <div>
                                        <p class="uk-margin-remove"><b>Best Season</b></p>
                                        <p class="text-secondary uk-margin-remove">{{ $data->best_season }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($data->walking_per_day)
                        <div class="uk-width-1-1 uk-width-1-3@m uk-width-1-4@l">
                            <div class="uk-grid uk-grid-collapse uk-child-width-expand uk-flex-nowrap uk-flex-middle"
                                uk-grid="">
                                <div class="uk-width-auto"><img src="{{ asset('themes-assets/img/icon/safari.png') }}"
                                        class="uk-feature-icon" >
                                </div>
                                <div>
                                    <div>
                                        <p class="uk-margin-remove"><b>Activity</b></p>
                                        <p class="text-secondary uk-margin-remove">{{ $data->walking_per_day }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($data->route)
                        <div class="uk-width-1-1 uk-width-1-3@m uk-width-1-4@l">
                            <div class="uk-grid uk-grid-collapse uk-child-width-expand uk-flex-nowrap uk-flex-middle"
                                uk-grid="">
                                <div class="uk-width-auto"><img
                                        src="{{ asset('themes-assets/img/icon/transportation.png') }}"
                                        class="uk-feature-icon" >
                                </div>
                                <div>
                                    <div>
                                        <p class="uk-margin-remove"><b>Transportation</b></p>
                                        <p class="text-secondary uk-margin-remove">{{ $data->route }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($data->meal)
                        <div class="uk-width-1-1 uk-width-1-3@m uk-width-1-4@l">
                            <div class="uk-grid uk-grid-collapse uk-child-width-expand uk-flex-nowrap uk-flex-middle"
                                uk-grid="">
                                <div class="uk-width-auto"><img src="{{ asset('themes-assets/img/icon/iftar.png')}}"
                                        class="uk-feature-icon" >
                                </div>
                                <div>
                                    <div>
                                        <p class="uk-margin-remove"><b>Meals</b></p>
                                        <p class="text-secondary uk-margin-remove">{{ $data->meal }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <!-- facilities end -->
                <!-- overview start -->
                <div>
                    <span class="section-tag uk-text-uppercase">Overview <i
                            class="fa-solid fa-plane uk-margin-small-left"></i></span>
                    <p class="uk-text-justify">
                        {!! $data->trip_content !!}
                    </p>
                </div>
                <!-- overview end -->
                <!-- best time start -->
                @if(!empty($data->trip_excerpt))
                <div>
                    <span class="section-tag uk-text-uppercase">Best time for expedition
                        <i class="fa-solid fa-plane uk-margin-small-left"></i>
                    </span>
                    <p>
                        {!! $data->trip_excerpt !!}
                    </p>
                </div>
                @endif
                <!-- best time end -->
            </div>
            <div class="uk-width-1-3@m uk-width-1-4@l">
                <div uk-sticky="offset: 150; end: #my-id; " style="z-index: 100;">
                    <div class="uk-card uk-trip-price uk-padding">
                        <div class="uk-flex uk-flex uk-flex-center">
                            <h4 class="text-white fw-600">PRICE: ${{ $data->starting_price }}</h4>
                        </div>
                        <div class="uk-trip-button uk-flex uk-flex-column">
                            <a href="#enquiry-form" uk-toggle type="button"
                                class="uk-small-btn uk-small-btn-secondary uk-flex uk-flex-between uk-flex-middle">Enquiry
                                Now<i class="fa fa-long-arrow-right"></i></a>
                            <a href="{{ route('page.booking', $data->uri) }}"
                                class="uk-small-btn uk-small-btn-white uk-flex uk-flex-between uk-flex-middle uk-margin-top">Book
                                this Trip <i class="fa fa-long-arrow-right"></i></a>

                        </div>
                        <hr>
                        <div class="uk-flex uk-flex-middle ">
                            <span class="text-white f-18 uk-margin-remove">Need Help? </span>
                        </div>
                        <div class="uk-margin-top ">
                            <h5 class="uk-margin-small-bottom text-white"><span class="fa fa-phone uk-margin-small-right text-secondary "></span>
                                    {{ $setting->phone }}
                            </h5>
                            <h5 class="uk-margin-remove  "><a href="mailto:info@maxtrek.com.np" class="text-white"><span class="fa fa-envelope-o uk-margin-small-right text-secondary"></span>{{ $setting->email_primary }}
                            </h5></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="my-id"></div>
</section>
<!-- overview section end -->

<!-- route section start -->
@if($data->trip_map || !empty($data->trip_highlight))
    <section class="uk-section bg-light-blue" id="maps">
        <div class="uk-container uk-container-large">
            <div class="uk-flex uk-flex-middle uk-grid-small" uk-grid>
                <div class="uk-width-1-2@m">
                    <span class="section-tag uk-text-uppercase">expedition route <i
                            class="fa-solid fa-plane uk-margin-small-left"></i></span>
                    <h2 class="text-primary fw-600 hb-bottom uk-margin-small-top">Route You Will See On The Trip</h2>
                    <p class="uk-text-justify">
                        {!! $data->trip_highlight !!}
                    </p>
                </div>
                <div class="uk-width-1-2@m">
                    <div uk-lightbox>
                        @if($data->trip_map)
                        <a class="uk-inline" href="{{ asset('uploads/original/' . $data->trip_map) }}"
                            data-caption="{{ $data->trip_title }}">
                            <img src="{{asset('uploads/original/' . $data->trip_map) }}"
                                width="1800" height="1200" alt="{{ $data->trip_title }}">
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
<!-- route section end -->
@php
    $visibleCount = 4;
    $totalPhotos = count($photos);
@endphp
<!-- gallery section start -->
@if($totalPhotos>0)
<section class="uk-section" id="photo">
    <div class="uk-container">
        <div class="uk-flex uk-flex-column uk-flex-enter ">
            <div class="uk-text-center">
                <span class="section-tag uk-text-uppercase">Gallery <i
                        class="fa-solid fa-plane uk-margin-small-left"></i></span>
                <h2 class="text-primary fw-600  uk-margin-small-top">Photos Of The Trip</h2>
            </div>
        </div>
        <div>
            <div class="uk-gallery ">
                <ul class="uk-grid-collapse uk-grid-small" uk-grid="masonry: true" uk-lightbox="animation: slide;">
                    @foreach ($photos->take($visibleCount) as $index => $photo)
                        @if($loop->first)
                            <li class="uk-width-1-1">
                                <a href="{{ $photo->thumbnail ? asset('uploads/original/' . $photo->thumbnail) : asset('themes-assets/img/mountain1.jpg')}}"
                                    data-caption="{{ $photo->title }}">
                                    <div class="uk-media-400 uk-list-shine">
                                        <img src="{{$photo->thumbnail ? asset('uploads/original/' . $photo->thumbnail) : asset('themes-assets/img/mountain1.jpg')}}"
                                            uk-img>
                                    </div>
                                </a>
                            </li>
                        @else
                            <li class=" uk-width-1-3@m uk-width-1-2">
                                <a href="{{$photo->thumbnail ? asset('uploads/original/' . $photo->thumbnail) : asset('themes-assets/img/about.jpeg')}}"
                                    data-caption="{{ $photo->title }}">
                                    <div class="uk-media-220 uk-list-shine">
                                        <img src="{{ $photo->thumbnail ? asset('uploads/original/' . $photo->thumbnail) : asset('themes-assets/img/about.jpeg')}}"
                                            uk-img>
                                        @if ($index === $visibleCount - 1 && $totalPhotos > $visibleCount)
                                            <span class="uk-h2 uk-position-center uk-light text-white" style="z-index: 2;">
                                                +{{ $totalPhotos - $visibleCount }}
                                            </span>
                                            <div class="uk-overlay-primary uk-position-cover"></div>
                                        @endif
                                    </div>
                                </a>
                            </li>
                        @endif
                    @endforeach

                    @foreach ($photos->skip($visibleCount) as $photo)
                        <li>
                            <a href="{{$photo->thumbnail ? asset('uploads/original/' . $photo->thumbnail) : asset('themes-assets/images/trip/07.jpg')}}"
                                data-caption="{{ $photo->title }}"></a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
@endif
<!-- gallery section end -->

<!-- dates / prices section start -->
@if($schedules->count() > 0)
<section class="uk-section bg-light-blue" id="date">
    <div class="uk-container uk-container-large">
        <div class="uk-flex uk-flex-column uk-flex-enter ">
            <div class="uk-text-center">
                <span class="section-tag uk-text-uppercase">Dates / Prices <i
                        class="fa-solid fa-plane uk-margin-small-left"></i></span>
                <h2 class="text-primary fw-600  uk-margin-small-top">List of our Fixed Departure</h2>
            </div>
        </div>
        <div class="uk-padding uk-padding-remove-top uk-no-padding">
            <div class="uk-overflow-auto">
                <table class="uk-table uk-table-hover uk-table-responsive uk-table-middle uk-table-divider">
                    <thead class="uk-depature-thead">
                        <tr>
                            <th class="uk-text-bold" width="20%">
                                Date
                            </th>
                            <th class="uk-text-bold uk-text-center@m" width="20%">
                                Status
                            </th>
                            <th class="uk-text-bold uk-text-center@m" width="20%">
                                Group Size
                            </th>
                            <th class="uk-text-bold uk-text-center@m" width="50%">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $row)
                            <tr class="bg-white">
                                <td>
                                    <strong>{{ $row->group_size }} Days</strong>
                                    <br> {{ \Carbon\Carbon::parse($row->start_date)->format('Y/m/d') }} -
                                    {{ \Carbon\Carbon::parse($row->end_date)->format('Y/m/d') }}
                                </td>
                                <td class="uk-text-center@m">
                                    @if ($row->availability == 'available')
                                        <span class="uk-text-success">Booking Open</span>
                                    @else
                                        <span class="uk-text-danger">Booking Closed</span>
                                    @endif
                                </td>
                                <td class="uk-text-center@m">
                                    <span class="uk-hidden@m"></span> {!!  $row->remarks !!}
                                </td>
                                <td class="uk-text-right@m" style="padding-bottom:18px;">
                                    <a class="uk-small-btn uk-small-btn-primary" href="#enquiry-form" uk-toggle>Inquire
                                        Now</a>
                                    <a class="uk-small-btn uk-small-btn-secondary"
                                        href="{{ route('page.fixed.booking', $data->uri) }}">Book Now</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endif
<!-- dates / prices section end -->

<!-- Itinerary section start -->
@if($itinerary->count() > 0)
<section class="uk-section bg-primary" id="itinerary">
    <div class="uk-container uk-container-large">
        <div class="uk-flex uk-flex-column uk-flex-enter ">
            <div class="uk-text-center">
                <span class="section-tag uk-text-uppercase">Itinerary <i
                        class="fa-solid fa-plane uk-margin-small-left"></i></span>
                <h2 class="text-white fw-600  uk-margin-small-top">Tailored Trip For You</h2>
            </div>
        </div>
        <div>
            <ul class="uk-padding uk-padding-remove-top uk-light uk-no-padding" uk-accordion="multiple: true">
                @foreach($itinerary as $row)
                    <li class="itinerary-wrapper">
                        <a class="uk-accordion-title" href="#">
                            <div class="itinerary-day">
                                <div class="day-circle">Day {{$row->days}}</div>
                                <div class="itinerary-content">
                                    <h4 class="text-white uk-margin-remove"><span class="day-tag"></span>{{$row->title}}
                                    </h4>
                                    <div class="itinerary-info">
                                        @if($row->meals)
                                        <div class="text-white"><b class="text-secondary">Meals:</b> {{$row->meals}}</div>
                                        @endif
                                        @if($row->accommodation)
                                        <div class="text-white"><b class="text-secondary">Accommodation:</b> {{$row->accommodation}}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="uk-accordion-content ">
                            <div class="itinerary-day">
                                <div class="day-circle" style="visibility: hidden;"></div>
                                <div class="itinerary-text">
                                    <p>
                                        {!! $row->content !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
@endif
<!-- Itinerary section end -->

<!-- cost includes/ excludes  section start -->
@if($cost_includes->count() > 0 || $cost_excludes->count() > 0)
<section class="uk-section uk-white-shape-bottom uk-position-relative" id="include">
    <div class="uk-container uk-container-large">
        <div class=" uk-child-width-1-2@m uk-grid-divider uk-grid">
            <div class="uk-margin-small-bottom">
                <span class="section-tag uk-text-uppercase">Cost includes <i
                        class="fa-solid fa-plane uk-margin-small-left"></i></span>
                <ul class="uk-include-ul">
                    @foreach ($cost_includes as $row)
                        <li>{{ $row->title }}</li>
                    @endforeach
                </ul>
            </div>
            <div>
                <span class="section-tag uk-text-uppercase">Cost Excludes <i
                        class="fa-solid fa-plane uk-margin-small-left"></i></span>
                <ul class="uk-exclude-ul">
                    @foreach ($cost_excludes as $row)
                        <li>{{ $row->title }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
@endif
<!-- cost includes/ excludes  section end -->

<!-- useful info section start -->
@if($usefulInfo->count() > 0 )
<section class="uk-section bg-light-blue" id="info">
    <div class="uk-container uk-container-large">
        <div class="uk-flex uk-flex-column uk-flex-enter ">
            <div class="uk-text-center">
                <span class="section-tag uk-text-uppercase">Information <i
                        class="fa-solid fa-plane uk-margin-small-left"></i></span>
                <h2 class="text-primary fw-600  uk-margin-small-top">What You Need To Know</h2>
            </div>
        </div>
        <div class="uk-padding">
            <ul uk-accordion class="uk-best-ul">
                @foreach ($usefulInfo as $row)
                    <li class="uk-faq-li">
                        <a class="uk-accordion-title fw-600 uk-text-uppercase  uk-faq-title" href>
                            {{ $row->title }}
                        </a>
                        <div class="uk-accordion-content uk-faq-content">
                            <p>
                                {!! $row->description !!}
                            </p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
@endif
<!-- useful info section end -->

<!-- review section start -->
<section class="uk-section uk-position-relative uk-section  uk-background-norepeat uk-background-cover"
    uk-parallax="bgx: -200; easing: 2;" data-src="{{asset('themes-assets/img/review.png')}}" uk-img id="review">
    <div class="uk-overlay-blue uk-position-cover "></div>
    <div class="uk-container-large uk-container uk-position-relative">
        <div class="uk-grid-collapse" uk-grid>
            <div class="uk-width-2-3@s">
                <span class="section-tag">Traveler's Review <i
                        class="fa-solid fa-plane uk-margin-small-left"></i></span>
                <h2 class="text-white fw-600 uk-margin-small-top">Know What Our Customers Say</h2>
            </div>
            <div class="uk-width-1-3@s  uk-flex uk-flex-left uk-flex-right@s uk-flex-middle">
                <a href="#review-form" uk-toggle class="uk-flex uk-btn uk-btn-secondary">
                    <div class="uk-btn-front">
                        Write a Review
                    </div>
                    <div class="uk-btn-back">
                        <i class="fa-solid fa-circle-arrow-right"></i>
                    </div>
                </a>
            </div>
        </div>

        @if($reviews->count() > 0)
            <div class="uk-position-relative uk-visible-toggle uk-margin-top" tabindex="-1" uk-slider>
                <div class="uk-slider-items uk-child-width-1-1 uk-child-width-1-2@m uk-child-width-1-3@l uk-grid ">
                    @foreach($reviews as $review)
                        <div class="mt-65">
                            <div class="uk-client-review uk-box-shadow-small border-rounded uk-padding-small bg-white">
                                <div>
                                    <img src="{{ $review->image ? asset('storage/reviews/' . $review->image) : asset('themes-assets/img/04.png')}}"
                                        alt="{{$review->name}}" class="uk-client-img" loading="lazy">
                                </div>
                                <div class="uk-margin-small-top">
                                    <div class="uk-flex uk-flex-between uk-flex-middle">
                                        <div>
                                            <h4 class="f-20 uk-text-bold uk-margin-remove text-primary">{{$review->name}}
                                                {{ $review->last_name }}</h4>
                                            <small class="f-16">{{$review->sub_title}}</small>
                                        </div>
                                        <div>
                                            <div class="uk-flex uk-flex-right">
                                                @for ($i = 1; $i <= ($review->rating); $i++)
                                                    <i class="fa-solid fa-star text-secondary f-16"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <p class="review-text">
                                        {{ $review->content }}
                                    </p>
                                    <button class="read-more-btn">Read More </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="uk-flex uk-flex-center">
                    <a class="uk-position-bottom-right uk-position-small arrow-prev" href uk-slidenav-previous
                        uk-slider-item="previous" style="left: 18px !important;"></a>
                    <a class="uk-position-bottom-right uk-position-small arrow-next " href uk-slidenav-next
                        uk-slider-item="next"></a>
                </div>
            </div>
        @endif
    </div>
</section>
<!-- review section end -->

<!-- similar trip section start -->
<section class="uk-section">
    <div class="uk-container uk-container-large">
        <div class="uk-flex uk-flex-column uk-flex-enter ">
            <div class="uk-text-center">
                <span class="section-tag uk-text-uppercase">Similar Trips <i
                        class="fa-solid fa-plane uk-margin-small-left"></i></span>
                <h2 class="text-primary fw-600  uk-margin-small-top">Similar Trip You May Like</h2>
            </div>
        </div>
        <div class=" uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l uk-grid-small" uk-grid>
            @foreach($similar_trips as $trip)
                <div class="uk-margin-top">
                    <div class="uk-travel-card bg-light-grey">
                        <div>
                            <a href="{{ url('page/' . tripurl($trip->uri)) }}"
                                class="uk-media-220 uk-inline-clip uk-transition-toggle border-rounded">
                                <img src="{{ $trip->thumbnail ? asset('uploads/original/' . $trip->thumbnail) : asset('themes-assets/img/about.jpeg')}}"
                                    class="border-rounded uk-transition-scale-up uk-transition-opaque" loading="lazy"
                                    height="500" width="500" alt="{{ $trip->trip_title }}">
                            </a>
                        </div>
                        <div class="uk-travel-text uk-grid-collapse uk-grid ">
                            <div class="uk-width-2-3">
                                <a href="{{ url('page/' . tripurl($trip->uri)) }}"
                                    class="two-line">{{ $trip->trip_title }}</a>
                            </div>
                            <div class="uk-width-1-3  text-primary uk-text-right ">
                                <!-- <i class="fa-solid fa-star text-secondary"></i> 4.0 -->
                            </div>
                        </div>
                        <div class="uk-travel-price uk-flex uk-flex-between">
                            <div>
                                <span>
                                    @if($trip->starting_price)
                                    <b class="text-primary f-18">${{ $trip->starting_price }}</b>
                                    @endif
                                </span>
                            </div>
                            <div class="uk-flex uk-flex-middle">
                                @if($trip->peak_name)
                                <span uk-icon="icon: location" class="uk-margin-small-right text-secondary"></span>{{$trip->peak_name}}
                                @endif
                            </div>
                            <div class="uk-flex uk-flex-middle">
                                @if($trip->duration)
                                <span uk-icon="icon: calendar" class="uk-margin-small-right text-secondary"></span>
                                {{ $trip->duration }} Days
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- similar trip section end -->

<!-- enquiry model form -->
<div id="enquiry-form" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-padding-remove">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="bg-primary uk-padding-small uk-custom-padding">
            <div class="uk-padding-small">
                <h4 class="text-white fw-600 uk-text-uppercase uk-margin-remove ">Have Question?</h4>
                <p class="uk-text-uppercase text-white uk-margin-remove">Mt. Annapurna Trekking</p>
            </div>
        </div>
        <div class="uk-padding">

            <fieldset class="uk-fieldset">
                <!--  -->
                <div class="uk-child-width-1-2@m uk-text-left uk-grid-small" uk-grid>
                    <div>
                        <label for="first_name" class="text-primary">First Name <span
                                class="uk-text-danger">*</span></label>
                        <input class="uk-input bg-text border-rounded" type="text" name="first_name"
                            placeholder="First Name *" required>
                    </div>
                    <div>
                        <label for="last_name" class="text-primary">Last Name <span
                                class="uk-text-danger">*</span></label>
                        <input class="uk-input bg-text border-rounded" type="text" name="last_name"
                            placeholder="Last Name *" required>
                    </div>
                    <div>
                        <label for="country" class="text-primary">Country Name <span
                                class="uk-text-danger">*</span></label>
                        <select class="uk-select bg-text border-rounded" name="country" required>
                            <!--<option value="">Select Your Country *</option>-->
                            <option value="">Select Country</option>
                            <option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option>
                            <option value="Algeria">Algeria</option>
                            <option value="American Samoa">American Samoa</option>
                        </select>
                    </div>
                    <div>
                        <label for="email" class="text-primary">Email <span class="uk-text-danger">*</span></label>
                        <input class="uk-input bg-text border-rounded" type="text" name="email" placeholder="Email *"
                            required>
                    </div>
                    <div>
                        <label for="phone" class="text-primary">Phone <span class="uk-text-danger">*</span></label>
                        <input class="uk-input bg-text border-rounded" type="text" name="phone"
                            placeholder="Phone(Landline)">
                    </div>
                    <div>
                        <label for="people" class="text-primary">No of People</label>
                        <input class="uk-input bg-text border-rounded" type="number" name="people"
                            placeholder="No of People">
                    </div>
                    <div>
                        <label for="phone" class="text-primary">Duration of Stay</label>
                        <input class="uk-input bg-text border-rounded" type="text" name="stay"
                            placeholder="Duration of Stay">
                    </div>
                </div>
                <!--  -->
                <div class="uk-child-width-1-1@s uk-child-width-1-1@m uk-text-left uk-margin-small-top uk-margin-bottom "
                    uk-grid>
                    <div>
                        <label for="comments" class="text-primary">Please tell us more about yourself to help you
                            better.</label>
                        <textarea name="comments" class="uk-textarea bg-text border-rounded" rows="4"
                            placeholder="Write your message here"></textarea>
                    </div>
                </div>
                <div class="uk-child-width-1-1@s uk-child-width-1-1@m uk-text-left uk-margin-remove-top  " uk-grid>
                    <div>
                        <button type="submit" class="uk-small-btn uk-small-btn-primary" style="border:none;">SUBMIT<span
                                uk-icon="icon: arrow-right"></span></button>
                    </div>
                </div>

            </fieldset>
        </div>

    </div>
</div>

<!-- review model form -->
<div id="review-form" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-padding-remove">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="bg-primary uk-padding-small uk-custom-padding">
            <div class="uk-padding-small">
                <h4 class="text-white fw-600 uk-text-uppercase uk-margin-remove ">Give us your review</h4>
            </div>
        </div>
        <form action="{{ route('post-review') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="trip_id" value="{{ $data->id }}">
            <div class="uk-padding">
                <fieldset class="uk-fieldset">
                    <!--  -->
                    <div class="uk-child-width-1-2@m uk-text-left uk-grid-small" uk-grid>
                        <div>
                            <label for="fname" class="text-primary">First Name <span
                                    class="uk-text-danger">*</span></label>
                            <input class="uk-input bg-text border-rounded" type="text" name="fname"
                                placeholder="First Name *" required>
                        </div>
                        <div>
                            <label for="lname" class="text-primary">Last Name <span
                                    class="uk-text-danger">*</span></label>
                            <input class="uk-input bg-text border-rounded" type="text" name="lname"
                                placeholder="Last Name *" required>
                        </div>
                        <div>
                            <label for="cname" class="text-primary">Company Name</label>
                            <input class="uk-input bg-text border-rounded" type="text" name="cname"
                                placeholder="Company Name *" required>
                        </div>

                        <div>
                            <label class="uk-form-label uk-text-bold" for="">Rating</label>
                            <div class="star-rating">
                                <input type="radio" id="5-stars" name="rating" value="5">
                                <label for="5-stars" class="star">&#9733;</label>
                                <input type="radio" id="4-stars" name="rating" value="4">
                                <label for="4-stars" class="star">&#9733;</label>
                                <input type="radio" id="3-stars" name="rating" value="3">
                                <label for="3-stars" class="star">&#9733;</label>
                                <input type="radio" id="2-stars" name="rating" value="2">
                                <label for="2-stars" class="star">&#9733;</label>
                                <input type="radio" id="1-star" name="rating" value="1">
                                <label for="1-star" class="star">&#9733;</label>
                            </div>
                        </div>
                        <div>
                            <label class="text-primary">Image</label>
                            <input class="uk-input bg-text border-rounded" type="file" name="image" accept="image/*">
                        </div>

                    </div>
                    <!--  -->
                    <div class="uk-child-width-1-1@s uk-child-width-1-1@m uk-text-left uk-margin-small-top uk-margin-bottom "
                        uk-grid>
                        <div>
                            <label for="comments" class="text-primary">Please tell us more about your trip with
                                us.</label>
                            <textarea name="comments" class="uk-textarea bg-text border-rounded" rows="4"
                                placeholder="Write your message here"></textarea>
                        </div>
                    </div>
                    <div class="uk-child-width-1-1@s uk-child-width-1-1@m uk-text-left uk-margin-remove-top  " uk-grid>
                        <div>
                            <button type="submit" class="uk-small-btn uk-small-btn-primary"
                                style="border:none;">SUBMIT<span uk-icon="icon: arrow-right"></span></button>
                        </div>
                    </div>
                </fieldset>
            </div>
        </form>
    </div>
</div>

<script>
    // Custom smooth scrolling with offset
    document.querySelectorAll('.sidenav a[href^="#"]').forEach(anchor => {
        anchor.addEventListener("click", function (event) {
            event.preventDefault();

            const target = document.querySelector(this.getAttribute("href"));

            if (target) {
                window.scrollTo({
                    top: target.offsetTop - 120,
                    behavior: "smooth"
                });
            }
        });
    });

    // UIkit scrollspyNav only for active state — no scrolling
    spyNav = UIkit.scrollspyNav(".sidenav", {
        closest: "a", // or "li" depending on where you want .uk-active
        scroll: false,
        offset: 120, // same as your scroll offset for accuracy
        cls: "uk-active"
    });
</script>

<script>
    document.querySelectorAll('.read-more-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const text = this.previousElementSibling;

            text.classList.toggle('expanded');

            this.textContent = text.classList.contains('expanded') ?
                "Read Less" :
                "Read More";
        });
    });
</script>

@stop
