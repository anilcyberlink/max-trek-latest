@extends('themes.default.common.master')
@section('content')
    <section class="uk-section-padding pattern-mountain">
        <div class="uk-container-small">
            <!--  -->
            <div class="uk-child-width-1-1@s uk-child-width-1-1@m uk-text-left" uk-grid>
                <!-- Personal Information -->
                <div>
                    <div class="uk-card uk-card-default uk-card-body">
                        <div class="uk-margin-bottom">
                            <h2>Your online booking is successful</h2>
                        </div>

                        <p>Thank you for booking your trip with us!!!</p>

                        <p>
                            We will contact you within 24 hours in regards to your booking.
                            @if($setting->phone || $setting->email_primary)
                                If you do have any questions in the meantime please do not hesitate to contact us directly on cell phone 24/7:
                                @if($setting->phone)
                                    {{ $setting->phone }}
                                @endif
                                @if($setting->email_primary)
                                    or e-mail at {{ $setting->email_primary }}
                                @endif
                            @endif
                        </p>

                        <p>We look forward to seeing you personally.</p>

                        <p>
                            <b>Best Regards</b>
                            @if($setting->site_name)
                                <br>{{ $setting->site_name }} Pvt. Ltd.
                            @endif
                        </p>
                    </div>

                    <br>

                    <a class="uk-button uk-button-secondary" href="{{ url('/') }}">
                        <span class="uk-icon"></span> Home
                    </a>
                </div>
                <!-- Personal Information -->
            </div>
        </div>
    </section>
@stop
