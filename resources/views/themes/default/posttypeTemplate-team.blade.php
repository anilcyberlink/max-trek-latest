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

<!-- why us section start -->
<section class="uk-section bg-light-blue uk-position-relative">
    <img src="{{asset('themes-assets/img/tree.png')}}" class="tree-image-up uk-visible@s">
    <div class=" uk-container-small uk-container pt-40">
        <div class="uk-flex uk-flex-center">
            <div>
                <div class="uk-flex uk-flex-center uk-text-center">
                    <h1 class="text-primary fw-600 hb-bottom">{!! $data->brief !!} <br>
                        <span class="text-secondary"></span>
                    </h1>
                </div>
                <p class=" uk-text-center">
                    {!! $data->content !!}
                </p>
            </div>
        </div>
    </div>
    <img src="{{asset('themes-assets/img/tree.png')}}" class="tree-image">
</section>
<!-- introduction section end -->

<!-- team section start -->
<section class="uk-section">
    <div class="uk-container ">
        <!-- leadership member -->
        @if($posts->count() > 0)
            <div>
                <div class="uk-flex uk-flex-center uk-text-center uk-margin-bottom">
                    <h1 class="text-primary fw-600 hb-bottom">{{ $posts[0]->post_title }}<span class="text-secondary"></span></h1>
                </div>
                <div class="uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l uk-flex uk-flex-center" uk-grid>
                    <!--  -->
                    @foreach($posts[0]->associated_posts as $row)
                        <div class="uk-team-card">
                            <a href="#team-container" uk-toggle class="uk-media-300 uk-inline-clip uk-transition-toggle" data-title="{{ $row->title }}" data-subtitle="{{ $row->sub_title }}" data-image="{{ $row->thumbnail ? asset('uploads/associated/'.$row->thumbnail) : asset('themes-assets/img/04.png')}}" data-description="{{ strip_tags($row->brief) }}" >
                                <img src="{{ $row->thumbnail ? asset('uploads/associated/'.$row->thumbnail) : asset('themes-assets/img/04.png')}}" class=" uk-transition-scale-up uk-transition-opaque" loading="lazy" height="500" width="500" alt="{{ $row->title }}">
                            </a>
                            <div>
                                <a href="#team-container" uk-toggle class="uk-team-name" data-title="{{ $row->title }}"
                                    data-subtitle="{{ $row->sub_title }}"
                                    data-image="{{ $row->thumbnail ? asset('uploads/associated/'.$row->thumbnail) : asset('themes-assets/img/04.png')}}"
                                    data-description="{{ strip_tags($row->brief) }}"
                                >
                                    <h3 class="uk-margin-remove text-primary fw-600">{{ $row->title }}</h3>
                                </a>
                                <p class="uk-margin-remove text-secondary f-18">{{ $row->sub_title }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Trek Guide member -->
        @if($posts->count() > 1)
            <div class="uk-margin-large-top">
                <div class="uk-flex uk-flex-center uk-text-center uk-margin-bottom">
                    <h1 class="text-primary fw-600 hb-bottom">{{ $posts[1]->post_title }}<span class="text-secondary"></span></h1>
                </div>
                <div class="uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l uk-flex uk-flex-center" uk-grid>
                    <!--  -->
                    @foreach($posts[1]->associated_posts as $row)
                        <div class="uk-team-card">
                            <a href="#team-container" uk-toggle class="uk-media-300 uk-inline-clip uk-transition-toggle" data-title="{{ $row->title }}"
                                data-subtitle="{{ $row->sub_title }}"
                                data-image="{{ $row->thumbnail ? asset('uploads/associated/'.$row->thumbnail) : asset('themes-assets/img/04.png')}}"
                                data-description="{{ strip_tags($row->brief) }}"
                            >
                                <img src="{{ $row->thumbnail ? asset('uploads/associated/'.$row->thumbnail) : asset('themes-assets/img/01.png')}}" class=" uk-transition-scale-up uk-transition-opaque" loading="lazy" height="500" width="500" alt="{{ $row->title }}">
                            </a>
                            <div>
                                <a href="#team-container" uk-toggle class="uk-team-name" vdata-title="{{ $row->title }}"
                                    data-subtitle="{{ $row->sub_title }}"
                                    data-image="{{ $row->thumbnail ? asset('uploads/associated/'.$row->thumbnail) : asset('themes-assets/img/04.png')}}"
                                    data-description="{{ strip_tags($row->brief) }}"
                                >
                                    <h3 class="uk-margin-remove text-primary fw-600">{{ $row->title }}</h3>
                                </a>
                                <p class="uk-margin-remove text-secondary f-18">{{ $row->sub_title }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
<!-- team section end -->

<!-- team single modal -->
<div id="team-container" class="uk-modal-container " uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-padding uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-grid-large" uk-grid>
            <div class="uk-width-1-3@s">
                <div class="uk-media-300 uk-inline-clip uk-transition-toggle">
                    <img id="modal-image" src="" class=" uk-transition-scale-up uk-transition-opaque" loading="lazy"
                        height="500" width="500" alt="">
                    <div class="uk-overlay uk-light uk-position-bottom uk-padding-remove">
                        <div class="uk-team-icon  uk-text-center uk-margin-small-top  uk-margin-bottom">
                            <a href="#" target="_blank" class="uk-icon-button uk-margin-small-right"
                                uk-icon="instagram"></a>
                            <a href="#" target="_blank" class="uk-icon-button  uk-margin-small-right"
                                uk-icon="facebook"></a>
                            <a href="#" target="_blank" class="uk-icon-button  uk-margin-small-right" uk-icon="x"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-width-2-3@s">
                <h3 id="modal-title" class="uk-margin-remove text-primary fw-600"></h3>
                <p id="modal-subtitle" class="uk-margin-remove text-secondary f-18"></p>
                <hr style="border-top: 3px dotted grey;">
                <p id="modal-description"></p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("click", function (e) {
        let trigger = e.target.closest("[data-title]");
        if (!trigger) return;

        document.getElementById("modal-title").innerText = trigger.dataset.title;
        document.getElementById("modal-subtitle").innerText = trigger.dataset.subtitle;
        document.getElementById("modal-description").innerText = trigger.dataset.description;
        document.getElementById("modal-image").src = trigger.dataset.image;
    });
</script>

<!-- why us section end -->
@stop