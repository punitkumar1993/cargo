
@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])
@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <script src="https://www.google.com/recaptcha/api.js?" async defer></script>
@stop

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif

@section('auth_box_msg', __('adminlte::adminlte.login_message'))

@section('auth_body')
    <form action="{{ $login_url }}" method="post">
        {{ csrf_field() }}

        {{-- Email/Username field --}}
        <div class="input-group mb-3">
            <input type="text" name="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                   value="{{ old('username') }}" placeholder="{{ __('adminlte::adminlte.username') }}" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('username'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('username') }}</strong>
                </div>
            @endif
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                   placeholder="{{ __('adminlte::adminlte.password') }}" data-toggle="password">
            @if($errors->has('password'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
            @endif
        </div>

        <div class="input-group mb-3">
            @empty(env('NOCAPTCHA_SITEKEY'))
                <p class="text-danger"><i>{{ __('Your captcha is not yet configured*') }}</i></p>
            @else
                {!! \Anhskohbo\NoCaptcha\Facades\NoCaptcha::display() !!}
            @endempty
            @if($errors->has('g-recaptcha-response'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                </div>
            @endif
        </div>

        {{-- Error--}}
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                    <div class="alert alert-warning">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        {{-- Login field --}}
        <!--<div class="row">-->
        <!--    <div class="col-7">-->
        <!--        <div class="icheck-primary">-->
        <!--            <input type="checkbox" name="remember" id="remember">-->
        <!--            <label for="remember">{{ __('adminlte::adminlte.remember_me') }}</label>-->
        <!--        </div>-->
        <!--    </div>-->
            <div class="col-5">
                <button type=submit class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                    {{ __('adminlte::adminlte.sign_in') }}
                </button>
            </div>
        </div>
    </form>
@stop

@section('auth_link_footer')
    {{-- Password reset link --}}
    <!--@if($password_reset_url)-->
    <!--<p class="mb-1 mt-3">-->
    <!--    <a href="{{ $password_reset_url }}">-->
    <!--        {{ __('adminlte::adminlte.i_forgot_my_password') }}-->
    <!--    </a>-->
    <!--</p>-->
    <!--@endif-->

    {{-- Register link --}}
    <!--@if($register_url)-->
    <!--<p class="mb-0">-->
    <!--    <a href="{{ $register_url }}" class="text-center">-->
    <!--        {{ __('adminlte::adminlte.register_a_new_membership') }}-->
    <!--    </a>-->
    <!--</p>-->
    <!--@endif-->
@endsection

@section('adminlte_js')
<script src="{{ asset('vendor/bootstrap-show-password/bootstrap-show-password.js') }}"></script>
@stop
