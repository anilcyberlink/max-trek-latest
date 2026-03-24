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
 
<!-- why us section start -->
@foreach ($posts as $post)
    @if($loop->iteration  % 2 != 0)
        <section class="uk-section bg-light-blue">
            <div class="uk-container-large uk-container">
                <div class="uk-flex uk-flex-middle" uk-grid>
                    <div class="uk-width-1-3@m">
                        <div>
                            <div class="uk-media-400">
                                <img src="{{$post->page_banner ? asset('uploads/banners/'.$post->page_banner) : asset('themes-assets/img/mountain/mountain-3.jpeg')}}" alt="{{ $post->post_title }}" class="about-img" loading="lazy">
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-2-3@m">
                        <div>
                            <div class="uk-flex uk-flex-left">
                                <h1 class="text-primary fw-600 hb-bottom">{{ $post->post_title }}</h1>
                            </div>
                            <p class=" uk-text-justify">
                                {!! $post->post_content !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="uk-section">
            <div class="uk-container-large uk-container">
                <div class="uk-flex uk-flex-middle" uk-grid>
                    <div class="uk-width-2-3@m uk-flex-last uk-flex-first@m" >
                        <div>
                            <div class="uk-flex uk-flex-left">
                                <h1 class="text-primary fw-600 hb-bottom">{{ $post->post_title }}</h1>
                            </div>

                            <p class=" uk-text-justify">
                                {!! $post->post_content !!}
                            </p>
                        </div>
                    </div>
                    <div class="uk-width-1-3@m uk-flex-first uk-flex-last@m">
                        <div class="uk-media-400">
                            <img src="{{$post->page_banner ? asset('uploads/banners/'.$post->page_banner) : asset('themes-assets/img/mountain/mountain-3.jpeg')}}" alt="{{ $post->post_title }}" class="about-img-reverse" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endforeach
<!-- why us section end -->
@stop