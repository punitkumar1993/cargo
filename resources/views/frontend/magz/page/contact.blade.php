@extends('frontend.magz.index')

@section('content')
<section class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="/">{{ __('Home') }}</a></li>
                    <li class="active">{{ __('Contact Us') }}</li>
                </ol>
                <h1 class="page-title">{{ __('Contact Us') }}</h1>
                <p class="page-subtitle">{{ __('We hear you') }}</p>
                <div class="line thin"></div>
                <div class="page-description">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <h3>{{ __('CARGO TRENDS') }}</h3>
                            <p>
                                {{ Settings::get('contactdescription') }}
                            </p>
                            <p>
                                {{ __('Phone') }}: <span class="bold">{{ Settings::get('sitephone')  }}</span> <br>
                                {{ __('Email') }}: <span class="bold">{{ Settings::get('siteemail') }}</span>
                                <br>
                                <br>
                                <p>
                                    {{ Settings::get('street') }} <br>
                                    {{ Settings::get('city') .' '. Settings::get('postal_code') }} <br>
                                    {{ Settings::get('state') .' - '. Settings::get('country') }}
                                </p>

                            </p>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <form class="row contact" id="contact-form" method="POST" role="form" data-recaptcha="true">
                                <div class="col-md-6">
                                    <div class="form-group form-group-name">
                                        <label>{{ __('Name') }} <span class="required"></span></label>
                                        <input type="text" class="form-control" name="name" required>
                                        <span id="msg-error-name" class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-email">
                                        <label>{{ __('Email') }} <span class="required"></span></label>
                                        <input type="text" class="form-control" name="email" required>
                                        <span id="msg-error-email" class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group form-group-subject">
                                        <label>{{ __('Subject') }}</label>
                                        <input type="text" class="form-control" name="subject">
                                        <span id="msg-error-subject" class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group form-group-message">
                                        <label>{{ __('Your message') }} <span class="required"></span></label>
                                        <textarea class="form-control" name="message" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    @empty(env('NOCAPTCHA_SITEKEY'))
                                    <p class="text-danger"><i>{{ __('Your captcha is not yet configured*') }}</i></p>
                                    @else
                                    {!! NoCaptcha::display() !!}
                                    @endempty
                                </div>
                                <div class="col-md-12" style="margin-top:10px">
                                    @empty(env('NOCAPTCHA_SITEKEY'))
                                    <button type="button" class="btn btn-primary" disabled>{{ __('Send Message') }}</button>
                                    @else
                                    <button type="submit" class="btn btn-primary">{{ __('Send Message') }}</button>
                                    @endempty
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="maps">
    <iframe src="{{ Settings::get('googlemapcode') }}" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
</section>
@stop
