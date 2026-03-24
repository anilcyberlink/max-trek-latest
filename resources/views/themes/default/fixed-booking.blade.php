@extends('themes.default.common.master')
@section('content')
<!-- banner section start -->
<section>
    <div class=" uk-innerpage-banner uk-flex uk-flex-center uk-flex-middle">
        <div class="uk-text-center uk-margin-top">
            <span class="section-tag uk-text-uppercase uk-margin-small-top"><a href="{{url('/')}}" class="text-white">Home</a> / Book Now</span>
            <h1 class="uk-text-uppercase text-white fw-600 uk-margin-small-top uk-margin-remove-bottom ls-4">Trip Booking</h1>
            <div class="divider">
                <span class="line"></span>
                <span class="icon"><i class="fa-solid fa-plane"></i></span>
                <span class="line"></span>
            </div>
        </div>
    </div>
</section>
<!-- banner section end -->
<section class="uk-section bg-light">
    <div class="uk-container uk-container-small">
        <!-- form section start -->
        <form>
            <div class="uk-child-width-1-1@s uk-child-width-1-1@m uk-text-left" uk-grid>
                <!-- Select trip -->
                <div>
                    <div class="uk-card uk-card-default uk-card-body uk-padding-remove">
                        <div class="bg-primary uk-padding-small uk-custom-padding">
                            <h4 class="text-white fw-600 uk-text-uppercase uk-margin-remove ">Trip detail</h4>
                        </div>
                        <div class="p-22">
                            <fieldset class="uk-fieldset">
                                <div class="uk-margin">
                                    <input class="uk-input bg-text border-rounded" value="Everest 12 Days Treking" name="trip_name" type="text" disabled>
                                </div>
                                <div class="uk-child-width-1-2@s uk-child-width-1-3@l uk-text-left" uk-grid>
                                    <div>
                                        <div class="uk-inline" style="width: 100%;">
                                            <label for="arrival_date" class="text-primary">Trip Arrival Date</label>
                                            <input type="date" class="uk-input bg-text border-rounded " name="arrival_date" type="text" placeholder="Trip Start Date" required>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="uk-inline" style="width: 100%;">
                                            <label for="departure_date" class="text-primary">Trip Departure Date</label>
                                            <input type="date" class="uk-input bg-text border-rounded " name="departure_date" type="text" placeholder="Trip End Date" required>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="num_people" class="text-primary">Number of people <span class="uk-text-danger">*</span></label>
                                        <input class="uk-input bg-text border-rounded" name="num_people" type="text" placeholder="Number of people *" required>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>

                <!-- Personal Requirement -->
                <div>
                    <!-- Personal Information -->
                    <div>
                        <div class="uk-card uk-card-default uk-card-body uk-padding-remove">
                            <div class="bg-primary uk-padding-small uk-custom-padding">
                                <h4 class="text-white fw-600 uk-text-uppercase uk-margin-remove ">Personal Information</h4>
                            </div>
                            <div class="p-22">
                                <fieldset class="uk-fieldset">
                                    <!--  -->
                                    <div class="uk-child-width-1-2@s uk-child-width-1-3@l uk-text-left" uk-grid>
                                        <div >
                                            <label for="first_name" class="text-primary">First Name <span class="uk-text-danger">*</span></label>
                                            <input class="uk-input bg-text border-rounded" type="text" name="first_name" placeholder="First Name *" required>
                                        </div>
                                        <div>
                                             <label for="last_name" class="text-primary">Last Name <span class="uk-text-danger">*</span></label>
                                            <input class="uk-input bg-text border-rounded" type="text" name="last_name" placeholder="Last Name *" required>
                                        </div>
                                        <div >
                                            <div class="uk-inline" style="width: 100%;">
                                                 <label for="dob" class="text-primary">Date of Birth<span class="uk-text-danger">*</span></label>
                                                <input class="uk-input  bg-text border-rounded " type="text" placeholder="Date of Birth" name="dob">
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <!--  -->
                                    <div class="uk-child-width-1-2@m uk-child-width-1-3@l uk-text-left uk-margin-small-top" uk-grid>

                                        <div>
                                             <label for="country" class="text-primary">Country Name <span class="uk-text-danger">*</span></label>
                                            <select class="uk-select bg-text border-rounded" name="country" required>
                                                <!--<option value="">Select Your Country *</option>-->
                                                <option value="">Select Country</option>
                                                <option value="Afghanistan">Afghanistan</option>
                                                <option value="Albania">Albania</option>
                                                <option value="Algeria">Algeria</option>
                                                <option value="American Samoa">American Samoa</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="email" class="text-primary">Email <span class="uk-text-danger">*</span></label>
                                            <input class="uk-input bg-text border-rounded" type="text" name="email" placeholder="Email *" required>
                                        </div>
                                        <div>
                                            <label for="phone" class="text-primary">Phone <span class="uk-text-danger">*</span></label>
                                            <input class="uk-input bg-text border-rounded" type="text" name="phone" placeholder="Phone(Landline)">
                                        </div>
                                    </div>
                                    <!--  -->
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <!-- Personal Information -->
                </div>

                <!-- Special Requirement -->
                <div>
                    <div class="uk-card uk-card-default uk-card-body uk-padding-remove">
                         <div class="bg-primary uk-padding-small uk-custom-padding">
                            <h4 class="text-white fw-600 uk-text-uppercase uk-margin-remove ">Special Requirement</h4>
                        </div>
                        <div class="p-22">
                            <fieldset class="uk-fieldset">
                              

                                <!--  -->
                                <div class="uk-child-width-1-1@s uk-child-width-1-1@m uk-text-left uk-margin-remove-top uk-margin-bottom" uk-grid>
                                    <div>
                                        <p class="text-primary">Please tell us more about yourself to help you better.</p>
                                        <textarea name="comments" class="uk-textarea bg-text border-rounded" rows="4" placeholder="Write your message here"></textarea>
                                    </div>
                                </div>
                                <div class="uk-child-width-1-1@s uk-child-width-1-1@m uk-text-left uk-margin-remove-top uk-margin-bottom" uk-grid>
                                    <div>

                                        <label><input class="uk-checkbox" type="checkbox" name="terms_conditions" required>  I accept <a>Terms and Conditions</a></label>

                                    </div>
                                </div>
                                <div class="uk-child-width-1-1@s uk-child-width-1-1@m uk-text-left uk-margin-remove-top  " uk-grid>
                                    <div>
                                       <button type="submit" class="uk-small-btn uk-small-btn-primary" style="border:none;">SUBMIT<span uk-icon="icon: arrow-right"></span></button>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--form section ene  -->
    </div>
</section>
@stop