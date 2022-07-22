@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
    @head(['linkIndex'=>'Users','currentLinkAdd'=>'Edit','url'=> route('users.index')])
    @slot('title')
        {{ __('Edit User') }}
    @endslot
    @endhead
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Edit User') }}</h3>
                </div>
                <form action="{{route('users.update',[$user->id])}}" method="POST" role="form"
                      enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="userName">{{ __('Name') }}</label>
                            <input id="userName" type="text" name="name"
                                   class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                   value="{{ $user->name }}" required autofocus>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="username">{{ __('Username') }}</label>
                            <input id="username" type="text" name="username"
                                   class="form-control @error('username') is-invalid @enderror" placeholder="Enter Username.." value="{{ $user->username }}" required>
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('Change Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" data-toggle="password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-passwor" data-toggle="password">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="occupation">{{ __('Occupation') }}</label>
                            <input type="text" id="occupation" name="occupation"
                                   class="form-control {{ $errors->has('occupation') ? 'is-invalid' : '' }}"
                                   placeholder="{{ __('Enter Occupation') }}.." value="{{ $user->occupation }}">
                        </div>
                        <div class="form-group">
                            <label for="occupation">{{ __('About') }}</label>
                            <textarea name="about" id="about" class="form-control" rows="3"
                                      placeholder="{{ __('Write about you') }}..">{{ $user->about }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="socialmedia">{{ __('Social Media') }}</label>
                            <select id="socialmedia" name="socialmedia" class="select2"
                                    data-placeholder="{{ __('Select Social Media') }}.." style="width: 100%;"></select>
                        </div>
                        <div class="row socmed">
                            @if($checkRelSocmed)
                                @foreach($userRel as $getSocMed)
                                    <div class="col-lg-6" id="socmed{{ $getSocMed->id }}">
                                        <div class="form-group"><label> {{ __('URL') }} {{ $getSocMed->name }} </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend"><span class="input-group-text"> <i class="{{ $getSocMed->icon }}"></i></span></div>
                                                <input type="text" name="{{ $getSocMed->slug }}" class="form-control" placeholder="{{ $getSocMed->url }}" value="{{ $getSocMed->pivot->url }}">
                                                <div class="input-group-append" onclick="removeInput({{ $getSocMed->id }})"><span class="input-group-text"><i class="fas fa-times"></i></span></div>
                                            </div>
                                        </div><input type="hidden" name="socmed[]" value="{{ $getSocMed->id }}">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="photo">{{ __('Photo') }}</label>
                            <div class="upload-photo @if($user->photo!='noavatar.png')ready result @endif">
                                <input type="file" id="upload" name="image" value="Choose a file" accept="image/*" data-role="none" hidden>
                                <div class="col-md-12">
                                    <div class="upload-msg">{{ __('Click to upload your photo') }}</div>
                                    @if ( $user->photo == "noavatar.png" )
                                        <div id="display"></div>
                                        <div id="display-i" class="mx-auto">
                                            <img src="#" alt="" style="width:200px">
                                        </div>
                                    @else
                                        <div id="display" hidden></div>
                                        <div id="display-i" class="mx-auto">
                                            <img src="{{ $image }}" alt="" style="width:200px">
                                        </div>
                                    @endif
                                    <div class="buttons text-center">
                                        <button id="btn-upload-result" type="button" class="upload-result btn btn-info"
                                                hidden>{{ __('Use This Image') }}</button>
                                        <button id="btn-upload-reset" type="button" class="reset btn btn-warning"
                                                hidden>{{ __('Reset') }}</button>
                                        <button id="btn-remove" type="button" class="reset btn btn-danger"
                                                @if($user->photo=="noavatar.png") hidden @endif>{{ __('Remove Image') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="userName">{{ __('Role') }}</label>
                            <select id="role" name="roles[]" class="select2" multiple="multiple"
                                    data-placeholder="Select Role" style="width: 100%;" required>
                                @foreach( $roles as $role )
                                    <option value="{{ $role->id }}" selected="selected">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">{{ __('Update User') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/croppie/croppie.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/pace-progress/themes/blue/pace-theme-minimal.css') }}">
    @include('admin.user.style')
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/croppie/croppie.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-show-password/bootstrap-show-password.js') }}"></script>
    @include('layouts.partials._script')
    @include('admin.user.script')
    <script>
        "use strict";

        $('.upload-msg').on("click", function() {
            console.log('hello');
            $('#btn-remove').attr('hidden', 'hidden');
            $('#btn-upload-result').removeAttr('hidden');
            $('#btn-upload-reset').removeAttr('hidden');
            $('#upload').click();
        });

        $('#btn-remove').on("click", function() {
            $.ajax({
                url: "{{ route('user.removePhoto') }}",
                type: 'DELETE',
                dataType: 'json',
                data: {
                    'id': '{{$user->id}}'
                },
                success: document.getElementById('btn-upload-reset').click()
            })
        });

        $('#btn-upload-reset').on("click", function() {
            $('#btn-remove').attr('hidden', 'hidden');
            $('#display').removeAttr('hidden');
            $('#btn-upload-result').removeAttr('hidden');
            $('#btn-upload-reset').removeAttr('hidden');
            $('.upload-photo').removeClass('ready result');
            $("#display-i").html('');
            $('#upload').val('');
        });

        let $uploadCrop;

        function readFile(input) {
            if (input.files && input.files[0]) {
                if (/^image/.test(input.files[0].type)) {
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

        function popupResult(result) {
            let html = '<img src="' + result.src + '" />';
            $("#display-i").html(html);
        }

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
                    type: 'PATCH',
                    dataType: 'json',
                    data: {
                        'image': resp,
                        'name': fileName,
                        'id': '{{$user->id}}',
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

        $('select#role').select2({
            theme: 'bootstrap4',
            allowClear: true,
            placeholder: "Select Role..",
            selectOnClose: true,
            ajax: {
                url: "{{ route('roles.search') }}",
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.name
                            }
                        })
                    }
                }
            },
            createSearchChoice: function(item, data) {
                if ($(data).filter(function() {
                    return this.text.localeCompare(item) === 0;
                }).length === 0) {
                    return {
                        id: item,
                        text: item
                    }
                }
            }
        })
    </script>
@stop

@section('footer')
    @include('layouts.partials._footer')
@stop
