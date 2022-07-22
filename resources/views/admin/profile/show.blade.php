@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    @if(\Illuminate\Support\Facades\Auth::user()->username !== 'magazine-user')
        @head(['linkIndex'=>'Profile'])
        @slot('title')
        {{ __('Profile') }}
        @endslot
        @endhead
    @else
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ __('Profile') }}</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    @endif
    <style>
        .hide{
            display: none !important;
        }
    </style>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            @if(Auth::user()->photo)
                            @if(Auth::user()->photo != 'noavatar.png')
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ route('profile.photo', Auth::user()->photo) }}" alt="User profile picture">
                            @else
                            <img class="profile-user-img img-fluid img-circle" src="{{ asset('img/noavatar.png') }}"
                                alt="User profile picture">
                            @endif
                            @else
                            <img class="profile-user-img img-fluid img-circle" src="{{ asset('img/noavatar.png') }}"
                                alt="User profile picture">
                            @endif
                        </div>

                        <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                        <p class="text-muted text-center">{{ $role }}</p>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-user-md mr-1"></i> Occupation</strong>
                        <p class="text-muted">
                            {{ $user->occupation }}
                        </p>
                        <hr>
                        <strong><i class="far fa-file-alt mr-1"></i> About</strong>
                        <p class="text-muted">{{  $user->about }}</p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <form class="form-horizontal" action="{{route('profile.update',[$user->id])}}" method="POST" role="form"
                    enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="card">

                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings"
                                        data-toggle="tab">Settings</a>
                                </li>
                                <li class="nav-item {{ (\Illuminate\Support\Facades\Auth::user()->username == 'magazine-user') ? 'hide' : ''  }}"><a class="nav-link" href="#photo" data-toggle="tab">Photo</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="settings">

                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" class="form-control" id="inputName"
                                                placeholder="Name" value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row {{ (\Illuminate\Support\Facades\Auth::user()->username == 'magazine-user') ? 'hide' : ''  }}">
                                        <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="username" class="form-control" id="inputUsername"
                                                placeholder="Username" value="{{ $user->username }}" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" name="email" class="form-control" id="inputEmail"
                                                placeholder="Email" value="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputOrganization" class="col-sm-2 col-form-label">Organization</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="organization" class="form-control"
                                                id="inputOrganization" placeholder="Organization"
                                                value="{{ $user->organization }}">
                                        </div>
                                    </div>
                                    <div class="form-group row {{ (\Illuminate\Support\Facades\Auth::user()->username == 'magazine-user') ? 'hide' : ''  }}">
                                        <label for="inputOccupation" class="col-sm-2 col-form-label">Occupation</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="occupation" class="form-control"
                                                id="inputOccupation" placeholder="Occupation"
                                                value="{{ $user->occupation }}">
                                        </div>
                                    </div>
                                    <div class="form-group row {{ (\Illuminate\Support\Facades\Auth::user()->username == 'magazine-user') ? 'hide' : ''  }}">
                                        <label for="inputAbout" class="col-sm-2 col-form-label">About</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="about" id="inputAbout"
                                                placeholder="About">{{ $user->about }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row {{ (\Illuminate\Support\Facades\Auth::user()->username == 'magazine-user') ? 'hide' : ''  }}">
                                        <label for="socialmedia"
                                            class="col-sm-2 col-form-label">{{ __('Social Media') }}</label>
                                        <div class="col-sm-10">
                                            <select id="socialmedia" name="socialmedia" class="select2 form-control"
                                                data-placeholder="Select Social Media" style="width: 100%;"></select>
                                        </div>
                                    </div>
                                    <div class="socmed">
                                        @if($checkRelSocmed)
                                        @foreach($userRel as $getSocMed)
                                        <div class="form-group row" id="socmed{{ $getSocMed->id }}">
                                            <label for="" class="col-sm-2 col-form-label">{{ $getSocMed->name }}</label>
                                            <div class="col-sm-10">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text"> <i
                                                                class="{{ $getSocMed->icon }}"></i></span></div>
                                                    <input type="text" name="{{ $getSocMed->slug }}"
                                                        class="form-control" placeholder="{{ $getSocMed->url }}"
                                                        value="{{ $getSocMed->pivot->url }}">
                                                    <div class="input-group-append"
                                                        onclick="removeInput({{ $getSocMed->id }})"><span
                                                            class="input-group-text"><i class="fas fa-times"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><input type="hidden" name="socmed[]" value="{{ $getSocMed->id }}">
                                        @endforeach
                                        @endif
                                    </div>

                                    <div class="form-group row {{ (\Illuminate\Support\Facades\Auth::user()->username == 'magazine-user') ? 'hide' : '' }}">
                                        <label for="inputRole" class="col-sm-2 col-form-label">Role</label>
                                        <div class="col-sm-10">
                                            <select id="role" name="roles[]" class="select2" multiple="multiple"
                                                data-placeholder="Select Role" style="width: 100%;">
                                                @foreach( $roles as $role )
                                                <option value="{{ $role->id }}" selected="selected">{{ $role->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="photo">
                                    <div class="form-group">
                                        <div class="upload-photo @if($user->photo!='noavatar.png')ready result @endif">
                                            <input type="file" id="upload" name="image" value="Choose a file"
                                                accept="image/*" data-role="none" hidden>

                                            <div class="col-md-12">
                                                <div class="upload-msg">Click to upload your photo</div>

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
                                                    <button id="btn-upload-result" type="button"
                                                        class="upload-result btn btn-info" hidden>Use This
                                                        Image</button>
                                                    <button id="btn-upload-reset" type="button"
                                                        class="reset btn btn-warning" hidden>Reset</button>
                                                    <button id="btn-remove" type="button" class="reset btn btn-danger"
                                                        @if($user->photo=="noavatar.png")
                                                        hidden @endif>Remove Image</button>

                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit"
                                class="btn btn-primary float-right">{{ __('Update Profile') }}</button>
                        </div>
                    </div>
                </form>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@stop

@section('adminlte_css')
<link rel="stylesheet" href="{{ asset('vendor/pace-progress/themes/blue/pace-theme-minimal.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/croppie/croppie.css') }}">
@include('admin.profile.style')
@stop

@section('adminlte_js')
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('vendor/croppie/croppie.min.js') }}"></script>
@include('layouts.partials._script')
@include('admin.profile.script')
@stop

@section('footer')
@include('layouts.partials._footer')
@stop
