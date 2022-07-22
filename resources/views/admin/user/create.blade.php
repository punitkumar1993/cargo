@extends('adminlte::page')

@section('title', 'Add New User')

@section('content_header')
    @head(['linkIndex'=>'Users','currentLinkAdd'=>'Add New','url'=> route('users.index')])
    @slot('title')
        {{ __('Add New User') }}
    @endslot
    @endhead
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Add New User') }}</h3>
                </div>
                <form id="user" action="{{ route('users.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('Enter Name') }}.." required autofocus>
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username">{{ __('Username') }}</label>
                            <input id="username" type="text" name="username"
                                   class="form-control @error('username') is-invalid @enderror" placeholder="{{ __('Enter Username') }}.." required>
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" placeholder="{{ __('Enter E-Mail Address') }}.." required autocomplete="email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password"
                                   placeholder="{{ __('Enter Password') }}.." required autocomplete="new-password" data-toggle="password">
                            <small id="passwordlHelp" class="form-text text-muted">Min. 6 characters</small>
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                   placeholder="{{ __('Enter Passwowrd Confirm') }}.." required autocomplete="new-password" data-toggle="password">
                        </div>
                        <div class="form-group">
                            <label for="occupation">{{ __('Occupation') }}</label>
                            <input id="occupation" type="text" name="occupation" class="form-control @error('occupation') is-invalid @enderror" placeholder="{{ __('Enter Occupation') }}..">
                        </div>
                        @error('occupation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="form-group">
                            <label for="about">{{ __('About') }}</label>
                            <textarea id="about" name="about" class="form-control @error('occupation') is-invalid @enderror"
                                      rows="3" placeholder="{{ __('Write about yout') }}.."></textarea>
                        </div>
                        @error('about')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="form-group">
                            <label for="socialmedia">{{ __('Social Media') }}</label>
                            <select id="socialmedia" name="socialmedia" class="select2"
                                    data-placeholder="{{ __('Select Social Media') }}.." style="width: 100%;"></select>
                        </div>
                        <div class="row socmed"></div>
                        <div class="form-group">
                            <label for="upload">{{ __('Photo') }}</label>
                            <div class="upload-photo">
                                <input id="upload" type="file" name="image" value="Choose a file" accept="image/*" data-role="none" hidden>
                                <div class="col-md-12">
                                    <div class="upload-msg">{{ __('Click to upload your photo') }}</div>
                                    <div id="display"></div>
                                    <div id="display-i" class="mx-auto"></div>
                                    <div class="buttons text-center">
                                        <button id="btn-upload-result" type="button" class="upload-result btn btn-info">{{ __('Use This Image') }}</button>
                                        <button id="btn-upload-reset" type="button" class="reset btn btn-danger">{{ __('Remove Image') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role">{{ __('Role') }}</label>
                            <select id="role" name="roles[]" class="select2 @error('occupation')is-invalid @enderror" multiple="multiple" data-placeholder="{{ __('Select Role') }}" style="width: 100%;" required></select>
                            @error('roles')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">{{ __('Add New User') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/pace-progress/themes/blue/pace-theme-minimal.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/croppie/croppie.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
    @include('admin.user.style')
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/croppie/croppie.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-show-password/bootstrap-show-password.js') }}"></script>
    @include('layouts.partials._script')
    @include('admin.user.script')
    <script>
        "use strict";

        $(".upload-msg").on("click", function() {
            $("#upload").trigger("click");
        })

        $("#btn-upload-reset").on("click", function() {
            $('#display').removeAttr('hidden');
            $('#btn-upload-result').attr('hidden');
            $('.upload-photo').removeClass('ready result');
            $("#display-i").html("");
            $('#upload').val("");
            $uploadCrop.croppie("bind", {
                url: ""
            }).then(function() {});
        });

        function popupResult(result) {
            let html = '<img src="' + result.src + '" />';
            $("#display-i").html(html);
        }

        let $uploadCrop;

        function readFile(input) {
            if (input.files && input.files[0]) {
                if (/^image/.test(input.files[0].type)) { // only image file
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        $('.upload-photo').addClass('ready');
                        $uploadCrop.croppie('bind', {
                            url: e.target.result
                        }).then(function() {
                            console.log('jQuery bind complete');
                        });
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    alert("You may only select image files");
                }
            } else {
                alert("Sorry - you're browser doesn't support the FileReader API");
            }
        }

        $uploadCrop = $('#display').croppie({
            viewport: {
                width: 200,
                height: 200,
                type: 'square'
            },
            boundary: {
                width: 300,
                height: 300
            },
        });

        $('#upload').on('change', function() {
            readFile(this);
        });

        $('#btn-upload-result').on('click', function(ev) {
            let fileInput = document.getElementById('upload');
            let fileName = fileInput.files[0].name;
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(resp) {
                $.ajax({
                    url: '/image-crop',
                    type: 'POST',
                    data: {
                        'image': resp,
                        'name': fileName
                    },
                    success: function(data) {
                        $('#btn-upload-result').attr('hidden', 'hidden');
                        $('#display').attr('hidden', 'hidden');
                        $('.upload-photo').addClass('result');
                        popupResult({
                            src: resp
                        });
                    }
                });
            });
        });
    </script>
@stop

@section('footer')
    @include('layouts.partials._footer')
@stop
