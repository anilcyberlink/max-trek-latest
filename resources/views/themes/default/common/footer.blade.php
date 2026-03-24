<section class="uk-black-shape-bottom uk-section uk-padding-remove-bottom bg-dark" style="position:relative;">
    <div class="uk-container uk-container-large">
        <div class="uk-grid-collapse" uk-grid>
            <div class="uk-width-1-2@s uk-text-left@m uk-text-center">
                <h3 class="text-white uk-text-uppercase uk-margin-small-top fw-600">Our Partners</h3>
            </div>
            <div class="uk-width-1-2@s">
                <div class="uk-footer-icon uk-text-right@m uk-text-center uk-margin-small-top  uk-margin-bottom">
                    <a href="{{$setting->instagram_link}}" target="_blank" class="uk-icon-button uk-margin-small-right" uk-icon="instagram"></a>
                    <a href="{{$setting->facebook_link}}" target="_blank" class="uk-icon-button  uk-margin-small-right" uk-icon="facebook"></a>
                    <a href="{{$setting->twitter_link}}" target="_blank" class="uk-icon-button  uk-margin-small-right" uk-icon="x"></a>
                    <a href="{{$setting->youtube_link}}" target="_blank" class="uk-icon-button" uk-icon="youtube"></a>
                </div>
            </div>
        </div>
        <div uk-slider="sets: true; autoplay: true; finite: true;">
            <div class="uk-position-relative uk-visible-toggle uk-margin-small-bottom" tabindex="-1">
                <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@m uk-child-width-1-5@l  uk-grid-small" uk-grid>
                    <!--  -->
                    @foreach($partners as $partner)
                        <li>
                            <div class="partners-logo-list bg-white uk-border-rounded uk-img-effect">
                                <a><img src="{{ $partner->picture ? '/uploads/banners/'.$partner->picture : ' ' }}" class="uk-effect-1" alt="{{ $partner->title }}"></a>
                            </div>
                        </li>
                    @endforeach
                    <!--  -->
                </ul>
                <a class="uk-position-center-left uk-position-small uk-hidden" uk-slidenav-previous uk-slider-item="previous"></a>
                <a class="uk-position-center-right uk-position-small uk-hidden  " uk-slidenav-next uk-slider-item="next"></a>
            </div>
            <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>
        </div>
        <div class="uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l uk-margin-top" uk-grid>
            <div>
                <h4 class="text-white uk-text-uppercase fw-600 uk-margin-small-bottom">Company</h4>
                <ul class="uk-footer-list uk-margin-remove-top">
                    @foreach ($footer as $row)
                        <li><a href="{{ route('page.posttype_detail',$row->uri) }}">{{ $row->post_type }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h4 class="text-white uk-text-uppercase fw-600 uk-margin-small-bottom">Expeditions </h4>
                <ul class="uk-footer-list uk-margin-remove-top">
                    @foreach($expeditions as $row)
                        @if(trip_byDestinations($row->id)->count()>0)
                            <li><a href="{{ route('page.destinationlist', $row->uri) }}">{{ $row->title }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div>
                <h4 class="text-white uk-text-uppercase fw-600 uk-margin-small-bottom">Trekking</h4>
                <ul class="uk-footer-list uk-margin-remove-top">
                    @foreach($regions as $row)
                        @if (tripbyregions($row->id)->count() > 0)
                            <li><a href="{{ route('page.regionlist', $row->uri) }}">{{ $row->title }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div>
                <h4 class="text-white uk-text-uppercase fw-600 uk-margin-small-bottom">Contact Us</h4>
                <ul class="uk-footer-list uk-margin-remove-top">
                    <li class="text-white"><span uk-icon="icon: location" class="uk-margin-small-right"></span>{{ $setting->address }}</li>
                    <li class="text-white"><span uk-icon="icon: mail" class="uk-margin-small-right"></span>{{ $setting->email_primary }}</li>
                    <li class="text-white"> <span uk-icon="icon: phone" class="uk-margin-small-right"></span>{{ $setting->phone }}<br></li>
                </ul>
            </div>
        </div>
    </div>

</section>
<section class="uk-position-relative bg-black-extra-light   footer-border uk-bottom-footer">
    <div class="uk-container uk-container-large uk-position-relative uk-position-z-index uk-text-center ">
        <hr style="border-top: 2px dotted #e5e5e5;">
        <img src="assets/img/card.png" alt="" class="uk-margin-bottom">
        <p class="uk-margin-remove text-white ">{!! $setting->copyright_text  !!}</p>
        <p class="uk-margin-remove text-white">Design & Developed By<a target="_blank" class="text-secondary"> Yantra Network Solution Pvt. Ltd.</a> </p>
    </div>
    <div class="uk-footer-background-overlay"></div>
</section>
</body>
<script src="{{ asset('themes-assets/js/main.js') }}"></script>

</html>