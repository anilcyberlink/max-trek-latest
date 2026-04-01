<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Max Trekking</title>
    <link rel="stylesheet" href="{{ asset('themes-assets/css/uikit.css')}}">
    <script src="{{ asset('themes-assets/js/uikit.js')}}"></script>
    <script src="{{ asset('themes-assets/js/uikit-icons.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('themes-assets/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('themes-assets/css/global.css')}}">
    <script src="https://kit.fontawesome.com/7254a5967d.js" crossorigin="anonymous"></script>

    <!-- Include Toastr CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Include Toastr JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>

<body>
    @include('themes.default.common.response')
    <div uk-sticky="start: 300; animation: uk-animation-slide-top; cls-active:uk-navbar-sticky; sel-target:.uk-navbar-container; class:uk-sticky;">
        <!-- desktop view start -->
        <nav class="uk-navbar-container uk-visible@l" style="position: absolute; width:100%; z-index: 1000;">
            <div class=" uk-container uk-navbar-lenght uk-box-shadow-medium border-rounded" style="background:#f8f8f8; margin-top: 9px;">
                <div uk-navbar>

                    <div class="uk-navbar-left">
                        <a class="uk-navbar-item uk-logo " href="{{ url('/') }}">
                            <img src="{{ asset('themes-assets/img/logo.jpeg')}}" alt="" width="100" class="uk-logo-white">
                        </a>
                    </div>
                    <div class="uk-navbar-center ">
                        <ul class="uk-navbar-nav uk-position-relative">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li>
                                <a>Company <span uk-navbar-parent-icon></span></a>
                                <div class="uk-navbar-dropdown">
                                    <ul class="uk-nav uk-navbar-dropdown-nav">
                                        @foreach ($navigations as $row)
                                            <li><a href="{{ route('page.posttype_detail',$row->uri) }}">{{ $row->post_type}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a>Expedition <span uk-navbar-parent-icon></span></a>
                                <div class="uk-dropbar uk-dropbar-top" uk-drop="offset: 5; boundary:!.uk-navbar-lenght; stretch: x; flip: false; animation: reveal-top; delay-hide: 100; duration: 700;">
                                    <div class="uk-container ">
                                        <ul class="uk-flex-center uk-travel-tabs" data-uk-tab="{connect:'.uk-switcher'}">
                                            @foreach($expeditions as $row)
                                                @if(trip_byDestinations($row->id)->count()>0)
                                                    <li><a>{{ $row->title }}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <div class="uk-switcher uk-width-expand@m uk-padding-menu ">
                                            @foreach($expeditions as $row)
                                                @if (trip_byDestinations($row->id)->count() > 0)
                                                    <div>
                                                        <div class="uk-position-relative uk-visible-toggle" tabindex="-1" uk-slider="sets: true; finite: true;">
                                                            <ul class="uk-slider-items uk-child-width-1-3@m uk-grid-small" uk-grid>
                                                                @foreach (trip_byDestinations($row->id) as $_keyEx => $_rowEx)
                                                                    <li>
                                                                        <div>
                                                                            <div class="uk-megamenu-sub-menu">
                                                                                <img src="{{ $_rowEx->thumbnail ? asset('uploads/original/'.$_rowEx->thumbnail) : asset('themes-assets/img/mountain/mountain1.jpeg')}}" class="image" alt="{{$_rowEx->trip_title}}">
                                                                                <a href="{{ url('page/' . tripurl($_rowEx->uri)) }}">
                                                                                    <div class="overlay">
                                                                                        <h4 class="uk-margin-top uk-margin-remove-bottom text-white uk-position-bottom">
                                                                                            {{$_rowEx->trip_title}}
                                                                                        </h4>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            <div class="uk-flex uk-flex-middle uk-flex-between uk-margin uk-margin-remove-bottom">
                                                                <a class="arrow-prev uk-padding-remove" uk-icon="icon:arrow-left; ratio: 1.5" uk-slider-item="previous"></a>
                                                                <a href="{{ route('page.destinationlist', $row->uri) }}" class=" uk-small-btn uk-small-btn-primary" style="padding: 4px 16px !important;"> View All
                                                                    <span class="uk-icon " uk-icon="icon:arrow-right; ratio: 1.5" uk-scrollspy="cls: uk-animation-slide-right; delay: 400; repeat: false;"></span>
                                                                </a>
                                                                <a class="arrow-next uk-padding-remove" uk-icon="icon:arrow-right; ratio: 1.5" uk-slider-item="next"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a>Trekking <span uk-navbar-parent-icon></span></a>
                                <div class="uk-dropbar uk-dropbar-top" uk-drop="offset: 5; boundary:!.uk-navbar-lenght; stretch: x; flip: false; animation: reveal-top; delay-hide: 100; duration: 700;">
                                    <div class="uk-container ">
                                        <ul class="uk-flex-center uk-travel-tabs" data-uk-tab="{connect:'.uk-switcher'}">
                                            @foreach($regions as $row)
                                                @if (tripbyregions($row->id)->count() > 0)
                                                    <li><a>{{ $row->title }}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <div class="uk-switcher uk-width-expand@m uk-padding-menu ">
                                            @foreach ($regions as $row)
                                                <div>
                                                    @if(tripbyregions($row->id)->count() > 0)
                                                        <div class="uk-position-relative uk-visible-toggle" tabindex="-1" uk-slider="sets: true; finite: true;">
                                                            <ul class="uk-slider-items uk-child-width-1-3@m uk-grid-small" uk-grid>
                                                                @foreach (tripbyregions($row->id) as $_keyEx => $_rowEx)
                                                                    <li>
                                                                        <div>
                                                                            <div class="uk-megamenu-sub-menu">
                                                                                <img src="{{ $_rowEx->thumbnail ? asset('uploads/original/'.$_rowEx->thumbnail) : asset('themes-assets/img/mountain/mountain1.jpeg')}}" class="image" alt="{{ $_rowEx->trip_title }}">
                                                                                <a href="{{ url('page/' . tripurl($_rowEx->uri)) }}">
                                                                                    <div class="overlay">
                                                                                        <h4 class="uk-margin-top uk-margin-remove-bottom text-white uk-position-bottom">
                                                                                            {{ $_rowEx->trip_title }}
                                                                                        </h4>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            <div class="uk-flex uk-flex-middle uk-flex-between uk-margin uk-margin-remove-bottom">
                                                                <a class="arrow-prev uk-padding-remove" uk-icon="icon:arrow-left; ratio: 1.5" uk-slider-item="previous"></a>
                                                                <a href="{{ route('page.regionlist', $row->uri) }}" class=" uk-small-btn uk-small-btn-primary" style="padding: 4px 16px !important;"> View All
                                                                    <span class="uk-icon " uk-icon="icon:arrow-right; ratio: 1.5" uk-scrollspy="cls: uk-animation-slide-right; delay: 400; repeat: false;"></span>
                                                                </a>
                                                                <a class="arrow-next uk-padding-remove" uk-icon="icon:arrow-right; ratio: 1.5" uk-slider-item="next"></a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li><a href="{{ route('page.posttype_detail',$blogs->uri) }}">{{ $blogs->post_type }}</a></li>
                        </ul>
                    </div>
                    <div class="uk-navbar-right">
                        <div class="uk-flex uk-flex-middle uk-flex-right">
                            <a href="{{ route('page.posttype_detail',$contact->uri) }}" class="uk-flex uk-btn uk-btn-secondary">
                                <div class="uk-btn-front">
                                    {{ $contact->post_type }}
                                </div>
                                <div class="uk-btn-back">
                                    <i class="fa-solid fa-circle-arrow-right"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- desktop view end -->

        <!-- mobile view start -->
        <div class="uk-header-mobile uk-hidden@l shadow-lg" uk-header="" style="position: absolute; width:100%; z-index: 1000;">
            <div class="uk-navbar-container uk-container">
                <div class="uk-container uk-container-expand uk-box-shadow-medium border-rounded" style="background:#f8f8f8; margin-top: 9px;">
                    <nav class="uk-navbar">
                        <div class="uk-navbar-left">
                            <a href="{{ url('/') }}" class=" uk-navbar-item">
                                <img alt="" loading="eager" src="{{ asset('themes-assets/img/logo.jpeg') }}" width="100">
                            </a>
                        </div>
                        <div class="uk-navbar-right">
                            <button class="uk-button uk-button-default uk-can-btn" type="button" uk-toggle="target: #offcanvas-flip"><i class="fa-solid fa-bars"></i></button>

                            <div id="offcanvas-flip" uk-offcanvas="flip: true; overlay: true">
                                <div class="uk-offcanvas-bar uk-width-1-1 uk-padding-remove bg-light-blue">
                                    <div class="uk-offcanvas-header uk-flex uk-flex-center uk-flex-middle" style="background:#f8f8f8;">
                                        <div>
                                            <a class="uk-navbar-item uk-logo " href="{{ url('/') }}">
                                                <img src="{{ asset('themes-assets/img/logo.jpeg') }}" alt="" width="120" class="uk-logo-white">
                                            </a>
                                        </div>
                                        <div>
                                            <button class="uk-offcanvas-close" type="button" uk-close></button>
                                        </div>
                                    </div>
                                    <div class="uk-offcanvas-body uk-padding-large">
                                        <ul class="uk-offcanvas-nav uk-position-relative" uk-nav="multiple: true;">
                                            <li><a href="{{ url('/') }}">Home</a></li>
                                            <li class="uk-parent">
                                                <a href="#">Company<span uk-nav-parent-icon></span></a>
                                                <ul class=" uk-padding-remove">
                                                    @foreach ($navigations as $row)
                                                        <li><a href="{{ route('page.posttype_detail',$row->uri) }}">{{ $row->post_type}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li class="uk-parent">
                                                <a href="#">Expedition<span uk-nav-parent-icon></span></a>
                                                <ul class=" uk-padding-remove">
                                                    @foreach($expeditions as $row)
                                                        @if(trip_byDestinations($row->id)->count()>0)
                                                            <li><a href="{{ route('page.destinationlist', $row->uri) }}">{{ $row->title }}</a></li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li class="uk-parent">
                                                <a href="#">Trekking<span uk-nav-parent-icon></span></a>
                                                <ul class=" uk-padding-remove">
                                                    @foreach($regions as $row)
                                                        @if (tripbyregions($row->id)->count() > 0)
                                                            <li><a href="{{ route('page.regionlist', $row->uri) }}">{{ $row->title }} </a></li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li><a href="{{ route('page.posttype_detail',$blogs->uri) }}">{{ $blogs->post_type }}</a></li>
                                            <li><a href="{{ route('page.posttype_detail',$contact->uri) }}">{{ $contact->post_type }}</a></li>
                                        </ul>
                                    </div>
                                    <div class="uk-offcanvas-footer uk-padding-small uk-padding-remove-top">
                                        <div class="uk-flex uk-flex-center">
                                            <div class="uk-footer-icon uk-flex uk-flex-center">
                                                <a href="" class="uk-icon-button uk-margin-small-right uk-text-white" uk-icon="facebook" style="background: #342F7F!important; border-radius: 10px;"></a>
                                                <a href="" class="uk-icon-button uk-margin-small-right uk-text-white" uk-icon="instagram" style="background: #BA0202!important; border-radius: 10px;"></a>
                                                <a href="" class="uk-icon-button uk-margin-small-right uk-text-white" uk-icon="x" style="background: #000!important;border-radius: 10px;"></a>
                                                <a href="" class="uk-icon-button uk-text-white" uk-icon="youtube" style="background: #D44139!important; border-radius: 10px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!--mobile view end -->
    </div>
