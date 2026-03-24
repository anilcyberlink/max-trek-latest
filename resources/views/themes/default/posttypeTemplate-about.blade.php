@extends('themes.default.common.master')
@section('title',$data->title)
@section('meta_keyword',$data->meta_keyword)
@section('meta_description',$data->meta_description)
@section('thumbnail',$data->thumbnail)
@section('brief',$data->brief)
@section('content')

<!-- banner section start -->
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
<!-- banner section end -->
<!-- about section start -->
@if($posts->count() > 0)
    <section class="uk-section bg-light-blue uk-position-relative">
        <div class="uk-container-large uk-container pt-40">
            <div class="uk-flex uk-flex-middle" uk-grid>
                <div class="uk-width-1-3@m">
                    <div class="uk-grid-collapse uk-grid">
                        <div class="uk-width-auto">
                            <div class="rotated-text">
                                {!! $posts[0]->post_excerpt !!}
                                <!-- <h2 class="text-secondary fw-600">27 YEARS OF <span class="text-primary">EXCELLENCE</span></h2> -->
                            </div>
                        </div>
                        <div class="uk-width-expand">
                            <div class="uk-media-400">
                                <img src="{{ $posts[0]->page_banner ? asset('uploads/banners/'.$posts[0]->page_banner) : asset('themes-assets/img/mountain/mountain-3.jpeg')}}" alt="{{ $posts[0]->post_title }}" class="about-img" loading="lazy">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-2-3@m">
                    <div>
                        <span class="section-tag">Know More About Us <i class="fa-solid fa-plane uk-margin-small-left"></i></span>
                        <h1 class="text-primary fw-600 uk-margin-small-top">{{ $posts[0]->post_title }}</h1>
                        <p class=" uk-text-justify">
                            {!! $posts[0]->post_content !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <img src="{{ asset('themes-assets/img/tree.png') }}" alt="" class="tree-image">
    </section>
@endif

@if($posts->count() > 1)
    <section class="uk-section">
        <div class="uk-container-large uk-container">
            <div class="uk-flex uk-flex-middle" uk-grid>
                <div class="uk-width-2-3@m uk-flex-last uk-flex-first@m">
                    <div>
                        <div class="uk-flex uk-flex-left">
                            <h1 class="text-primary fw-600 hb-bottom">{{ $posts[1]->post_title }} 
                                <!-- <span class="text-secondary">of Experience</span> -->
                            </h1>
                        </div>

                        <p class=" uk-text-justify">
                            {!! $posts[1]->post_content !!}
                        </p>
                    </div>
                </div>
                <div class="uk-width-1-3@m uk-flex-first uk-flex-last@m">
                    <div class="uk-media-400">
                        <img src="{{ $posts[1]->page_banner ? asset('uploads/banners/'.$posts[1]->page_banner) : asset('themes-assets/img/about.jpeg')}}" alt="{{ $posts[1]->post_title }}" class="about-img-reverse" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
<!-- about section end -->

<!-- review section start -->
@if($posts->count() > 2)
    <section class="uk-section uk-position-relative uk-section  uk-background-norepeat 
        uk-background-cover" uk-parallax="bgx: -200; easing: 2;" data-src="{{asset('themes-assets/img/review.png')}}" uk-img id="review">
        <div class="uk-overlay-blue uk-position-cover "></div>
        <div class="uk-container-large uk-container uk-position-relative">
            <div class="uk-text-center">
                <span class="section-tag">{{ $posts[2]->post_title }}<i class="fa-solid fa-plane uk-margin-small-left"></i></span>
            </div>
            <div class="uk-position-relative uk-visible-toggle uk-margin-top" tabindex="-1" uk-slider>

                <div class="uk-slider-items uk-child-width-1-1 uk-child-width-1-2@m uk-child-width-1-3@l uk-grid ">
                    @foreach($posts[2]->associated_posts as $row)
                        <div class="mt-65">
                            <div class="uk-client-review uk-box-shadow-small border-rounded uk-padding-small bg-white">
                                <div>
                                    <img src="{{ $row->thumbnail ? asset('uploads/associated/'.$row->thumbnail) : asset('themes-assets/img/04.png')}}" alt="{{ $row->title }}" class="uk-client-img" loading="lazy">
                                </div>
                                <div class="uk-margin-small-top">
                                    <div class="uk-flex uk-flex-between uk-flex-middle">
                                        <div>
                                            <h4 class="f-20 uk-text-bold uk-margin-remove text-primary">{{ $row->title }}</h4>
                                            <small class="f-16">{{ $row->sub_title }}</small>
                                        </div>
                                        <div>
                                            <div class="uk-flex uk-flex-right">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $row->star)
                                                        <i class="fa-solid fa-star text-secondary f-16"></i>
                                                    @else
                                                        <i class="fa-regular fa-star text-secondary f-16"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <p class="review-text">{{ $row->brief }}</p>
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

@stop