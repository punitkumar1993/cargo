@extends('adminlte::page')

@section('title', 'Change Password')

@section('content_header')
    @head(['linkIndex'=>'Users','currentLinkAdd'=>'Add New','url'=> url('magazines.index')])
    @slot('title')
        {{ __('Add Magazine') }}
    @endslot
    @endhead
    <style>
        .upload-pdf #display, .upload-pdf .buttons #reset{
            display: none;
        }
    </style>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <form id="form" action="{{route('magazines.store')}}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{ __('Magazine Name') }}</label>
                            <div class="input-group">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" >
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">{{ __('Magazine PDF File') }}</label>
                            <div class="input-group">
                                <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file" accept="application/pdf">
                                @error('file')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">{{ __('Magazine Image') }}</label>
                            <div class="input-group">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/png, image/jpg, image/jpeg">
                                @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Add Magazine') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/pace-progress/themes/blue/pace-theme-minimal.css') }}">
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/bootstrap-show-password/dist/bootstrap-show-password.js') }}"></script>
    @include('layouts.partials._script')
@stop

@section('footer')
    @include('layouts.partials._footer')
@stop