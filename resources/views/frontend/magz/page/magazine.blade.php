@extends('frontend.magz.index')

@section('content')
    <section class="page">
        <input type="hidden" id="magazin_ajax_url" value="{{ route('sendmagazine') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="/">{{ __('Home') }}</a></li>
                        <li class="active">{{ __('Magazine') }}</li>
                    </ol>
                    <h3>{{ __('Please subscribe in order to view the e-Magazine') }}</h3>

                    <div class="row">
                        <div class="col-md-4 col-sm-4"></div>
                        <div class="col-md-4 col-sm-4">

                            <form class="text-left contact" id="magazine-form" method="POST" role="form" data-recaptcha="true">
                                <div class="form-group">
                                    <label for="userName">{{ __('Name') }} <span class="required"></span></label>
                                    <input type="text" class="form-control" name="name" id="userName" placeholder="Enter Name">
                                </div>

                                <div class="form-group">
                                    <label for="userEmail">{{ __('Email Id') }} <span class="required"></span></label>
                                    <input type="email" class="form-control" name="email" id="userEmail" placeholder="Enter Email">
                                </div>

                                <div class="form-group">
                                    <label for="userOrganization">{{ __('Organization') }} <span class="required"></span></label>
                                    <input type="text" class="form-control" name="organization" id="userOrganization" placeholder="Enter Organization">
                                </div>

                                <div class="form-group">
                                        @empty(env('NOCAPTCHA_SITEKEY'))
                                            <p class="text-danger"><i>{{ __('Your captcha is not yet configured*') }}</i></p>
                                        @else
                                            {!! NoCaptcha::display() !!}
                                        @endempty
                                </div>
                                <div id="validation-errors"></div>

                                <button type="submit" class="btn btn-primary">{{ __('Subscribe') }}</button>
                                <p>Or if have already subscribed, please <a href="{{ route('magazine.login') }}">login</a> to continue</p>
                            </form>
                        </div>
                    </div>
                    <div class="line thin"></div>
                </div>
            </div>
        </div>
    </section>

@stop
