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

<!-- documet section start -->
<section class="uk-section">
    <div class="uk-container uk-container-large">
        <div class="uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l uk-grid-small" uk-grid>
            @foreach($posts as $post)
                <div>
                    <div class="uk-doc-card bg-light-grey uk-padding-small border-rounded">
                        <div uk-lightbox>
                            <a href="{{$post->page_banner ? asset('uploads/banners/'.$post->page_banner) : asset('themes-assets/img/paper.jpg')}}" class="uk-media-260 uk-inline-clip uk-transition-toggle border-rounded" data-caption="{{ $post->post_title }}">
                                <img src="{{$post->page_banner ? asset('uploads/banners/'.$post->page_banner) : asset('themes-assets/img/paper.jpg')}}" class="border-rounded uk-transition-scale-up uk-transition-opaque" loading="lazy" height="500" width="500" alt="{{ $post->post_title }}">
                            </a>
                        </div>
                        <h4 class="uk-margin-small-top uk-margin-remove-bottom fw-600">{{ $post->post_title }}</h4>
                    </div>
                </div>
            @endforeach
        </div>
        {!! $posts->links('themes.default.common.pagination') !!}
    </div>
</section>
<!-- documet section end -->

@stop