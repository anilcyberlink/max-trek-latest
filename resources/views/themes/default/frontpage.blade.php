@extends('themes.default.common.master')
@section('content')

<!-- banner section start -->
@if($banners)
    <section>
        <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow="autoplay: true">
            <div class="uk-slideshow-items" uk-height-viewport>
                <!--for video-->
                <!-- <div style="height:100vh;">
                    <div class="uk-position-relative " id="ytbg3" data-ytbg-fade-in="true" data-ytbg-mute-button="true" data-youtube="https://youtu.be/es4x5R-rV9s?si=wyQYZVjmGVmvsE_P" ></div>
                    <div class="uk-overlay-primary uk-position-cover uk-img-banner-overlay"></div>
                    <div class="uk-overlay uk-position-center uk-text-center " uk-scrollspy="cls: uk-animation-fade; target: h1,p,a; delay: 200;">
                        <h1 class="text-white fw-600 uk-margin-remove uk-h1">Adventure Awaits In The Mountain</h1>
                        <p class="text-white fw-600 uk-margin-small-top">Our handpicked itineraries for your next holidays</p>
                        <div>
                            <a href="list.php" class="uk-small-btn uk-small-btn-primary">
                                View Trips <span uk-icon="icon: arrow-right"></span>
                            </a>
                        </div>
                    </div>
                </div> -->

                <!--for image-->
                @foreach($banners as $row)
                    <div>
                        <img src="{{$row->banner ? asset('uploads/banners/' . $row->banner) : asset('themes-assets/img/mountain/mountain-3.jpeg')}}" alt="{{ $row->trip_title }}" uk-cover>
                        <div class="uk-overlay-primary uk-position-cover uk-img-banner-overlay"></div>
                        <div class="uk-overlay uk-position-center uk-text-center " uk-scrollspy="cls: uk-animation-fade; target: h1,p,a; delay: 200;">
                            @if($row->sub_title)
                                <h1 class="text-white fw-600 uk-margin-remove uk-h1">{{ $row->sub_title }}</h1>
                            @else
                                <h1 class="text-white fw-600 uk-margin-remove uk-h1">Adventure Awaits In The Mountain</h1>
                            @endif
                            <p class="text-white fw-600 uk-margin-small-top"></p>
                            <div>
                                <a href="{{ url('page/' . tripurl($row->uri)) }}" class="uk-small-btn uk-small-btn-primary">
                                    View Trips <span uk-icon="icon: arrow-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <a class="uk-position-center-left uk-position-small uk-hidden-hover" href uk-slidenav-previous uk-slideshow-item="previous"></a>
            <a class="uk-position-center-right uk-position-small uk-hidden-hover" href uk-slidenav-next uk-slideshow-item="next"></a>
        </div>
    </section>
@else
    <div class="bg-light-blue uk-homepage-banner uk-position-relative" uk-scrollspy="cls: uk-animation-fade; target: h1,p,a; delay: 200;">

        <div class="uk-text-center uk-homepage-banner-text uk-width-1-1" style="padding: 35px;">
            <h1 class="text-primary fw-600 uk-margin-remove uk-h1">Adventure Awaits <span class="text-secondary">In The Mountain</span></h1>
            <p class="text-primary fw-600 uk-margin-small-top">Our handpicked itineraries for your next holidays</p>
            <div>
                <!-- <a href="" class="uk-small-btn uk-small-btn-primary">
                    View Trips <span uk-icon="icon: arrow-right"></span>
                </a> -->
            </div>
        </div>
        <img src="{{ asset('themes-assets/img/banner.png') }}" loading="lazy">
    </div>
@endif
<!-- banner section end -->

<!-- about section start -->
@if($about)
    <section class="uk-section-large bg-primary uk-padding-remove-top">
        <div class="uk-container-large uk-container pt-40">
            <div class="uk-flex uk-flex-middle" uk-grid>
                <div class="uk-width-1-3@m">
                    <div class="uk-grid-collapse uk-grid" uk-scrollspy="cls: uk-animation-fade; target: h2,img; delay: 200;">
                        <div class="uk-width-auto">
                            <div class="rotated-text">
                                <h2 class="text-secondary">{!! $about->brief !!}<span class="text-white"></span></h2>
                            </div>
                        </div>
                        <div class="uk-width-expand">
                            <div class="uk-media-400">
                                <img src="{{ $about->banner ? asset('uploads/original/'.$about->banner) : asset('themes-assets/img/mountain/mountain-1.jpeg')}}" alt="{{ $about->post_type }}" class="about-img" loading="lazy">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-2-3@m" uk-scrollspy="cls: uk-animation-fade; target: span,h1,p,a; delay: 200;">
                    <div>
                        <span class="section-tag">Trending Destination <i class="fa-solid fa-plane uk-margin-small-left"></i></span>
                        <h1 class="text-white fw-600 uk-margin-small-top"></h1>
                        <p class="text-white uk-text-justify">
                            {!! $about->content !!}
                        </p>
                        <a href="{{ route('page.posttype_detail',$about->uri) }}" class="uk-small-btn uk-small-btn-white">
                            View More <span uk-icon="icon: arrow-right"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
<!-- about section end -->
<!-- trekking section start -->
@if($expeditions->count() > 0)
    <section class="uk-section bg-light-blue uk-blue-shape-bottom uk-position-relative">
        <div class="uk-container-large uk-container">
            <div>
                <div class="uk-position-relative uk-visible-toggle uk-margin-top" tabindex="-1" uk-slider>
                    <div class="uk-margin-medium-bottom" uk-grid uk-scrollspy="cls: uk-animation-fade; target: span,h1,a; delay: 200;">
                        <div class="uk-width-2-3@s">
                            <span class="section-tag">Traveler's Choice <i class="fa-solid fa-plane uk-margin-small-left"></i></span>
                            <h1 class="text-primary fw-600 uk-margin-small-top">Featured Expedition Iternaries </h1>
                        </div>
                        <div class="uk-width-1-3@s uk-visible@s">
                            <div class="uk-flex uk-flex-right">
                                <a class="uk-position-bottom-right uk-position-small arrow-prev" href uk-slidenav-previous uk-slider-item="previous" style="left: 18px !important;"></a>
                                <a class="uk-position-bottom-right uk-position-small arrow-next " href uk-slidenav-next uk-slider-item="next"></a>
                            </div>
                        </div>
                    </div>
                    <div class="uk-slider-items uk-child-width-1-2@s uk-child-width-1-3@m  uk-child-width-1-4@l  uk-grid uk-grid-small " uk-scrollspy="cls: uk-animation-fade; target: .uk-travel-card; delay: 200;">
                        @foreach($expeditions as $exped)
                            <div>
                                <div class="uk-travel-card bg-white">
                                    <div>
                                        <a href="{{ url('page/' . tripurl($exped->uri)) }}" class="uk-media-220 uk-inline-clip uk-transition-toggle border-rounded">
                                            <img src="{{$exped->thumbnail ? asset('uploads/original/'.$exped->thumbnail) : asset('themes-assets/img/mountain/mountain-2.jpeg')}}" class="border-rounded uk-transition-scale-up uk-transition-opaque" loading="lazy" height="500" width="500" alt="{{$exped->trip_title}}">
                                        </a>
                                    </div>
                                    <div class="uk-travel-text uk-grid-collapse uk-grid ">
                                        <div class="uk-width-2-3">
                                            <a href="{{ url('page/' . tripurl($exped->uri)) }}" class="two-line">{{$exped->trip_title}}</a>
                                        </div>
                                        <div class="uk-width-1-3  text-primary uk-text-right ">
                                            <!-- <i class="fa-solid fa-star text-secondary"></i> 4.0 -->
                                        </div>
                                    </div>
                                    <div class="uk-travel-price uk-flex uk-flex-between">
                                        <div>
                                            @if($exped->starting_price)
                                            <span>
                                                <b class="text-primary f-18">${{ $exped->starting_price }}</b>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="uk-flex uk-flex-middle">
                                            @if($exped->peak_name)
                                            <span uk-icon="icon: location" class="uk-margin-small-right text-secondary"></span>{{ $exped->peak_name}}
                                            @endif
                                        </div>
                                        <div class="uk-flex uk-flex-middle">
                                            @if($exped->duration)
                                            <span uk-icon="icon: calendar" class="uk-margin-small-right text-secondary"></span>
                                            {{ $exped->duration }} Days
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="uk-flex uk-flex-center uk-hidden@s">
                        <a class="uk-position-bottom-right uk-position-small arrow-prev" href uk-slidenav-previous uk-slider-item="previous" style="left: 18px !important;"></a>
                        <a class="uk-position-bottom-right uk-position-small arrow-next " href uk-slidenav-next uk-slider-item="next"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
<!-- trekking section end -->

<!-- destination section start -->
@if($trekRegion->count() > 0)
    <section class="uk-section">
        <div class="uk-container-large uk-container">
            <div>
                <div class="uk-position-relative uk-visible-toggle uk-margin-top" tabindex="-1" uk-slider>
                    <div class="uk-margin-medium-bottom" uk-grid uk-scrollspy="cls: uk-animation-fade; target: span,h1,a; delay: 200;">
                        <div class="uk-width-2-3@s">
                            <span class="section-tag">Trending Destination <i class="fa-solid fa-plane uk-margin-small-left"></i></span>
                            <h1 class="text-primary fw-600 uk-margin-small-top">Experience New Destination </h1>
                        </div>
                        <div class="uk-width-1-3@s uk-visible@s">
                            <div class="uk-flex uk-flex-right">
                                <a class="uk-position-bottom-right uk-position-small arrow-prev" href uk-slidenav-previous uk-slider-item="previous" style="left: 18px !important;"></a>
                                <a class="uk-position-bottom-right uk-position-small arrow-next " href uk-slidenav-next uk-slider-item="next"></a>
                            </div>
                        </div>
                    </div>
                    <div class="uk-slider-items uk-child-width-1-2@s uk-child-width-1-4@m uk-child-width-1-5@l uk-grid uk-grid-small" uk-scrollspy="cls: uk-animation-fade; target: .uk-region; delay: 200;">
                        @foreach($trekRegion as $trek)
                            <div class="uk-region">
                                <a href="{{ route('page.regionlist', $trek->uri) }}" class="uk-display-block uk-inline-clip uk-transition-toggle border uk-media-400 border-rounded">
                                    <img src="{{ $trek->banner ? asset('uploads/banners/'.$trek->banner) : asset('themes-assets/img/mountain/mountain1.jpeg') }}" class="border uk-transition-scale-up uk-transition-opaque" loading="lazy" alt="{{ $trek->title }}">
                                    <div class="uk-overlay-default uk-position-cover uk-destination-overlay"></div>
                                    <div class="uk-overlay uk-position-center ">
                                        <h2 class="uk-text-uppercase uk-text-bold uk-text-center text-white f-28">{{ $trek->title }}</h2>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="uk-flex uk-flex-center uk-hidden@s">
                        <a class="uk-position-bottom-right uk-position-small arrow-prev" href uk-slidenav-previous uk-slider-item="previous" style="left: 18px !important;"></a>
                        <a class="uk-position-bottom-right uk-position-small arrow-next " href uk-slidenav-next uk-slider-item="next"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
<!-- destination section end -->

<!-- package section start -->
 @if($trekking->count() > 0)
    <section class="uk-section bg-light-blue">
        <div class="uk-container-large uk-container">
            <div uk-grid uk-scrollspy="cls: uk-animation-fade; target: span,h1,a; delay: 200;">
                <div class="uk-width-2-3@s">
                    <span class="section-tag">Traveler's Tours <i class="fa-solid fa-plane uk-margin-small-left"></i></span>
                    <h1 class="text-primary fw-600 uk-margin-small-top">Featured travel Packages</h1>
                </div>
                <div class="uk-width-1-3@s uk-visible@s uk-flex uk-flex-right uk-flex-middle">
                    <a href="{{ route('page.packagelist')}}" class="uk-flex uk-btn uk-btn-primary">
                        <div class="uk-btn-front">
                            View All Trip
                        </div>
                        <div class="uk-btn-back">
                            <i class="fa-solid fa-circle-arrow-right"></i>
                        </div>
                    </a>
                </div>
            </div>
            <div class=" uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l uk-grid-small" uk-grid uk-scrollspy="cls: uk-animation-fade; target: .uk-travel-card; delay: 200;">
                @foreach($trekking as $trekData)
                    <div class="uk-margin-top">
                        <div class="uk-travel-card bg-white">
                            <div>
                                <a href="{{ url('page/' . tripurl($trekData->uri)) }}" class="uk-media-220 uk-inline-clip uk-transition-toggle border-rounded">
                                    <img src="{{$trekData->thumbnail ? asset('uploads/original/'.$trekData->thumbnail) : asset('themes-assets/img/mountain/mountain1.jpeg')}}" class="border-rounded uk-transition-scale-up uk-transition-opaque" loading="lazy" height="500" width="500" alt="{{ $trekData->trip_title }}">
                                </a>
                            </div>
                            <div class="uk-travel-text uk-grid-collapse uk-grid ">
                                <div class="uk-width-2-3">
                                    <a href="{{ url('page/' . tripurl($trekData->uri)) }}" class="two-line">{{ $trekData->trip_title }}</a>
                                </div>
                                <div class="uk-width-1-3  text-primary uk-text-right ">
                                    <!-- <i class="fa-solid fa-star text-secondary"></i> 4.0 -->
                                </div>
                            </div>
                            <div class="uk-travel-price uk-flex uk-flex-between">
                                <div>
                                    @if($trekData->starting_price)
                                    <span>
                                        <b class="text-primary f-18">${{ $trekData->starting_price }}</b>
                                    </span>
                                    @endif
                                </div>
                                <div class="uk-flex uk-flex-middle">
                                    @if($trekData->peak_name)
                                    <span uk-icon="icon: location" class="uk-margin-small-right text-secondary"></span>{{ $trekData->peak_name}}
                                    @endif
                                </div>
                                <div class="uk-flex uk-flex-middle">
                                    @if($trekData->duration)
                                    <span uk-icon="icon: calendar" class="uk-margin-small-right text-secondary"></span>
                                    {{ $trekData->duration }} Days
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class=" uk-margin-top uk-hidden@s">
                <a href="{{ route('page.packagelist')}}" class="uk-flex uk-btn uk-btn-primary uk-flex-center uk-flex-middle">
                    <div class="uk-btn-front">
                        View All Trip
                    </div>
                    <div class="uk-btn-back">
                        <i class="fa-solid fa-circle-arrow-right"></i>
                    </div>
                </a>
            </div>
        </div>
    </section>
@endif
<!-- package section end -->

<!-- review section start -->
@if($reviews->count() > 0)
    <section class="uk-section">
        <div class="uk-container-large uk-container">
            <div class="uk-grid-collapse" uk-grid uk-scrollspy="cls: uk-animation-fade; target: span,h1,img; delay: 200;">
                <div class="uk-width-2-3@s">
                    <span class="section-tag">Traveler's Review <i class="fa-solid fa-plane uk-margin-small-left"></i></span>
                    <h1 class="text-primary fw-600 uk-margin-small-top">Know What Our Customers Say</h1>
                </div>
                <div class="uk-width-1-3@s  uk-flex uk-flex-center uk-flex-right@s uk-flex-middle">
                    <img src="{{asset('themes-assets/img/trip.png')}}" height="150"  loading="lazy" style="height:85px;">
                </div>
            </div>
            <div class="uk-position-relative uk-visible-toggle uk-margin-top" tabindex="-1" uk-slider>

                <div class="uk-slider-items uk-child-width-1-1 uk-child-width-1-2@m uk-child-width-1-3@l uk-grid " uk-scrollspy="cls: uk-animation-fade; target: .mt-65; delay: 200;">
                    @foreach($reviews as $review)
                        <div class="mt-65">
                            <div class="uk-client-review uk-box-shadow-small border-rounded uk-padding-small">
                                <div>
                                    <img src="{{$review->image ? asset('storage/reviews/'.$review->image) : asset('themes-assets/img/04.png')}}" alt="{{$review->name}}" class="uk-client-img" loading="lazy" >
                                </div>
                                <div class="uk-margin-small-top">
                                    <div class="uk-flex uk-flex-between uk-flex-middle">
                                        <div>
                                            <h4 class="f-20 uk-text-bold uk-margin-remove text-primary">{{ $review->name }} {{ $review->last_name }}</h4>
                                            <small class="f-16">{{$review->sub_title}}</small>
                                        </div>
                                        <div>
                                            <div class="uk-flex uk-flex-right">
                                                @for ($i=1 ; $i<= ($review->rating) ; $i++)
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
                    <a class="uk-position-bottom-right uk-position-small arrow-prev" href uk-slidenav-previous uk-slider-item="previous" style="left: 18px !important;"></a>
                    <a class="uk-position-bottom-right uk-position-small arrow-next " href uk-slidenav-next uk-slider-item="next"></a>
                </div>
            </div>
        </div>
    </section>
@endif
<!-- review section end -->

<!-- blog section start -->
@if($blogs->count() > 0)
    <section class="uk-section bg-light-blue">
        <div class="uk-container-large uk-container">
            <div uk-grid uk-scrollspy="cls: uk-animation-fade; target: span,h1,a; delay: 200;">
                <div class="uk-width-2-3@s">
                    <span class="section-tag">{{ $blog->post_type }} <i class="fa-solid fa-plane uk-margin-small-left"></i></span>
                    <h1 class="text-primary fw-600 uk-margin-small-top">{{ $blog->post_tag }}</h1>
                </div>
                <div class="uk-width-1-3@s uk-visible@s uk-flex uk-flex-right uk-flex-middle">
                    <a href="{{ route('page.posttype_detail',$blog->uri) }}" class="uk-flex uk-btn uk-btn-primary">
                        <div class="uk-btn-front">
                            View All Blogs
                        </div>
                        <div class="uk-btn-back">
                            <i class="fa-solid fa-circle-arrow-right"></i>
                        </div>
                    </a>
                </div>
            </div>
            <div class=" uk-child-width-1-1 uk-child-width-1-2@s uk-grid-small" uk-grid uk-scrollspy="cls: uk-animation-fade; target: .uk-blog-card; delay: 200;">
                @foreach($blogs as $row)
                    <div class="uk-margin-top">
                        <div class="uk-blog-card">
                            <div>
                                <a href="{{ route('page.pagedetail', $row->uri) }}" class="uk-media-260 uk-inline-clip uk-transition-toggle border-rounded">
                                    <img src="{{$row->page_thumbnail ? asset('uploads/medium/'.$row->page_thumbnail) : asset('themes-assets/img/mountain/mountain-4.jpeg')}}" class="border-rounded uk-transition-scale-up uk-transition-opaque" loading="lazy" height="500" width="500" alt="{{ $row->post_title }}">
                                </a>
                            </div>
                            <div class="uk-travel-text uk-grid-collapse uk-grid ">
                                <div class="uk-width-1-1">
                                    <a href="{{ route('page.pagedetail', $row->uri) }}" class="two-line">
                                        <h3 class="f-20 fw-600 uk-margin-remove">{{ $row->post_title }}</h3>
                                    </a>
                                </div>
                            </div>
                            <div class="uk-travel-price uk-margin-remove uk-grid-collapse uk-flex uk-flex-middle" uk-grid>
                                <div class=" uk-width-1-2@m uk-width-2-3@l">
                                    <div class="uk-flex " style="gap:25px;">
                                        <!-- <div class="uk-flex uk-flex-middle text-primary fw-600">
                                            <span uk-icon="icon: location" class="uk-margin-small-right text-secondary"></span>Nepal
                                        </div> -->
                                        <div class="uk-flex uk-flex-middle text-primary fw-600">
                                            <span uk-icon="icon: calendar" class="uk-margin-small-right text-secondary"></span>
                                            {{ date('F j, Y', strtotime($row->post_date)) }}
                                        </div>
                                    </div>
                                </div>
                                <div class=" uk-width-1-2@m uk-width-1-3@l uk-flex uk-flex-left uk-flex-right@m uk-flex-middle uk-margin-small-top">
                                    <a href="{{ route('page.pagedetail', $row->uri) }}" class="uk-flex uk-btn uk-btn-primary">
                                        <div class="uk-btn-front">
                                            View The Blog
                                        </div>
                                        <div class="uk-btn-back">
                                            <i class="fa-solid fa-circle-arrow-right"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class=" uk-margin-top uk-hidden@s">
                <a href="{{ route('page.posttype_detail',$blog->uri) }}" class="uk-flex uk-btn uk-btn-primary uk-flex-center uk-flex-middle">
                    <div class="uk-btn-front">
                        View All Blogs
                    </div>
                    <div class="uk-btn-back">
                        <i class="fa-solid fa-circle-arrow-right"></i>
                    </div>
                </a>
            </div>
        </div>
    </section>
@endif
<!-- blog section end -->

<!-- contact section start -->
<section class="uk-section uk-section-small uk-padding-remove-bottom bg-light-blue" uk-scrollspy="cls: uk-animation-fade; target: img,p,a; delay: 200;">
    <div class="uk-container uk-container-small">
        <div class="border-rounded bg-primary uk-text-center uk-padding uk-blue-contact">
            <img src="{{ asset('themes-assets/img/logo_white.png')}}"  loading="lazy">
            <p class="text-white">
                {!! $contact->content !!}
            </p>
            <div class="uk-flex uk-flex-center uk-flex-middle">
                <a href="{{ route('page.posttype_detail',$contact->uri) }}" class="uk-flex uk-btn uk-btn-secondary">
                    <div class="uk-btn-front">
                        Contact Us
                    </div>
                    <div class="uk-btn-back">
                        <i class="fa-solid fa-circle-arrow-right"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- contact section end -->

<script>
    document.querySelectorAll('.read-more-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const text = this.previousElementSibling;

            text.classList.toggle('expanded');

            this.textContent = text.classList.contains('expanded') ?
                "Read Less" :
                "Read More";
        });
    });
</script>

@endsection
