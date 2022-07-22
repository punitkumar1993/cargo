<div class="tab-pane fade" id="web-contact" role="tabpanel" aria-labelledby="web-contact-tab">
    <form id="form-web-contact" action="" method="POST" role="form">
        @method('PATCH')
        @csrf
        <input type="hidden" name="web_contact">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="street">{{ __('Street') }}</label>
                    <input id="street" type="text" name="street" class="form-control" placeholder="{{ __('Street') }}" value="{{ $settings->street}}">
                    <div class="msg-street"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="city">{{ __('City') }}</label>
                    <input id="city" type="text" name="city" class="form-control" placeholder="{{ __('City') }}" value="{{ $settings->city}}">
                    <div class="msg-city"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="postal_code">{{ __('Postal Code') }}</label>
                    <input id="postal_code" type="text" name="postal_code" class="form-control" placeholder="{{ __('Postal Code') }}" value="{{ $settings->postal_code}}">
                    <div class="msg-postal_code"></div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="state">{{ __('State') }}</label>
                    <input id="state" type="text" name="state" class="form-control" placeholder="{{ __('State') }}" value="{{ $settings->state}}">
                    <div class="msg-state"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="country">{{ __('Country') }}</label>
                    <input id="country" type="text" name="country" class="form-control" placeholder="{{ __('Country') }}" value="{{ $settings->country}}">
                    <div class="msg-country"></div>
                </div>
            </div>
            {{--<div class="col-lg-6">
                <div class="form-group">
                    <label for="contactdescription">{{ __('Full Address (Optional)') }}</label>
                    <textarea id="fulladdress" name="fulladdress" class="form-control" rows="3" placeholder="{{ __('Full Address') }}">{!! nl2br($settings->fulladdress)!!}</textarea>
                    <div class="msg-fulladdress"></div>
                </div>
            </div>--}}
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="sitephone">{{ __('Phone Number') }}</label>
                    <input id="sitephone" type="text" name="sitephone" class="form-control" placeholder="{{ __('Phone Number') }}" value="{{ $settings->sitephone}}">
                    <div class="msg-sitephone"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="contactdescription">{{ __('Form Contact Description') }}</label>
                    <textarea id="contactdescription" name="contactdescription"
                              class="form-control" rows="3" placeholder="{{ __('Contact description') }}">{!! nl2br($settings->contactdescription)!!}</textarea>
                    <div class="msg-contactdescription"></div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="siteemail">{{ __('E-Mail') }}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input id="siteemail" type="email" name="siteemail"
                               class="form-control" placeholder="name@domain.com"
                               value="{{ $settings->siteemail }}">
                        <div class="msg-siteemail"></div>
                    </div>
                </div>
            </div>
            {{--<div class="col-lg-6">
                <div class="form-group">
                    <label for="facebook">{{ __('Facebook') }}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fab fa-facebook"></i></span>
                        </div>
                        <input id="facebook" type="text" name="facebook" class="form-control" placeholder="@username" value="{{ $settings->facebook }}">
                        <div class="msg-facebook"></div>
                    </div>
                </div>
            </div>--}}
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="twitter">{{ __('Twitter') }}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                        </div>
                        <input id="twitter" type="text" name="twitter" class="form-control" placeholder="@username" value="{{ $settings->twitter }}">
                        <div class="msg-twitter"></div>
                    </div>
                </div>
            </div>
            {{--<div class="col-lg-6">
                <div class="form-group">
                    <label for="youtube">{{ __('Youtube') }}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fab fa-youtube"></i></span>
                        </div>
                        <input id="youtube" type="text" name="youtube" class="form-control" placeholder="@channel" value="{{ $settings->youtube }}">
                        <div class="msg-youtube"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="instagram">{{ __('Instagram') }}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                        </div>
                        <input id="instagram" type="text" name="instagram" class="form-control" placeholder="@username" value="{{ $settings->instagram }}">
                        <div class="msg-instagram"></div>
                    </div>
                </div>
            </div>--}}
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="instagram">{{ __('LinkedIn') }}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fab fa-linkedin"></i></span>
                        </div>
                        <input id="linkedin" type="text" name="linkedin" class="form-control" placeholder="@username" value="{{ $settings->linkedin }}">
                        <div class="msg-linkedin"></div>
                    </div>
                </div>
            </div>
            {{--<div class="col-lg-6">
                <div class="form-group">
                    <label for="instagram">{{ __('Telegram') }}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fab fa-telegram"></i></span>
                        </div>
                        <input id="telegram" type="text" name="telegram" class="form-control" placeholder="Mobile Number/@username" value="{{ $settings->telegram }}">
                        <div class="msg-telegram"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="instagram">{{ __('WhatsApp') }}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                        </div>
                        <input id="whatsapp" type="text" name="whatsapp" class="form-control" placeholder="Mobile Number" value="{{ $settings->whatsapp }}">
                        <div class="msg-whatsapp"></div>
                    </div>
                </div>
            </div>--}}
        </div>
        <div class="mt-3">
            <button id="submit-web-contact" type="submit" class="btn btn-info float-right">{{ __('Save') }}</button>
        </div>
    </form>
</div>
