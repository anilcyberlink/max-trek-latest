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
            <span class="section-tag uk-text-uppercase uk-margin-small-top"><a href="{{ url('/')}}" class="text-white">Home</a> / {{ $data->post_type }}</span>
            <h1 class="uk-text-uppercase text-white fw-600 uk-margin-small-top uk-margin-remove-bottom ls-4"> {{ $data->post_tag }} </h1>
            <div class="divider">
                <span class="line"></span>
                <span class="icon"><i class="fa-solid fa-plane"></i></span>
                <span class="line"></span>
            </div>
        </div>
    </div>
</section>
<!-- banner section end -->

<!-- blog list section start -->
<section class="uk-section">
    <div class="uk-container uk-container-large">
        <div class=" uk-child-width-1-1 uk-child-width-1-2@s uk-grid-small" uk-grid>
            <!--  -->
            @foreach($posts as $post)
                <div class="uk-margin-top">
                    <div class="uk-blog-card bg-light-grey uk-padding-small border-rounded">
                        <div>
                            <a href="{{ route('page.pagedetail', $post->uri) }}" class="uk-media-260 uk-inline-clip uk-transition-toggle border-rounded">
                                <img src="{{$post->page_thumbnail ? asset('uploads/medium/'.$post->page_thumbnail) :  asset('themes-assets/img/about.jpeg') }}" class="border-rounded uk-transition-scale-up uk-transition-opaque" loading="lazy" height="500" width="500" alt="{{ $post->post_title }}">
                            </a>
                        </div>
                        <div class="uk-travel-text uk-grid-collapse uk-grid ">
                            <div class="uk-width-1-1">
                                <a href="{{ route('page.pagedetail', $post->uri) }}" class="two-line">
                                    <h3 class="f-20 fw-600 uk-margin-remove">{{ $post->post_title }}</h3>
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
                                        {{ date('F j, Y', strtotime($post->post_date)) }}
                                    </div>
                                </div>
                            </div>
                            <div class=" uk-width-1-2@m uk-width-1-3@l uk-flex uk-flex-left uk-flex-right@m uk-flex-middle uk-margin-small-top">
                                <a href="{{ route('page.pagedetail', $post->uri) }}" class="uk-flex uk-btn uk-btn-primary">
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

        <div>
            {!! $posts->links('themes.default.common.pagination') !!}
        </div>
    </div>
</section>
<!-- blog list section end -->

@stop