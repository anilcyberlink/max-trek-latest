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
<section class="uk-section" id="info">
    <div class="uk-container">
        <div class="uk-flex uk-flex-column uk-flex-enter ">
            <div class="uk-text-center">
                <span class="section-tag ">Information <i class="fa-solid fa-plane uk-margin-small-left"></i></span>
                <h2 class="text-primary fw-600  uk-margin-small-top">{!! $data->content !!}</h2>
            </div>
        </div>
        <div class="uk-padding bg-light-blue border-rounded">
            <ul uk-accordion class="uk-best-ul">
                @foreach($posts as $post)
                    <li class="uk-faq-li">
                        <a class="uk-accordion-title fw-600  f-20 uk-faq-title" href>{{ $post->post_title }}</a>
                        <div class="uk-accordion-content uk-faq-content">
                            <p>
                                {!! $post->post_content !!}
                            </p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
<!-- information section end -->

@stop