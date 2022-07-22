@extends('adminlte::page')

@section('title', 'Edit Magazine')

@section('content_header')
@head(['linkIndex'=>'Magazine','currentLinkAdd'=>'Edit','url'=> route('magazines.index')])
@slot('title')
{{ __('Edit Magazine') }}
@endslot
@endhead
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <form action="{{route('magazines.update', [$magazine->id])}}" method="POST" role="form" enctype="multipart/form-data">
            @method('PUT')
            @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">{{ __('Magazine Name') }}</label>
                        <div class="input-group">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $magazine->name }}">
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
                        <div class="upload-banner row justify-content-md-center @if($magazine->image != 'noimage.png')ready @endif">
                            <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/png, image/jpg, image/jpeg">
                            <div class="col-md-8 text-center">
                                <div class="upload-msg">{{ __('Click to upload banner') }}</div>
                                <div id="display">
                                    <img id="image_preview_container" src="{{ $image }}" name="image" alt="preview image" width= 100 height= 100style="max-width: 100%;">
                                </div>
                                <div class="buttons text-center mt-3">
                                    <button id="reset" type="button" class="reset btn btn-danger">Remove Image</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('adminlte_css')
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/pace-progress/themes/blue/pace-theme-minimal.css') }}">
@include('admin.magazine.style')
@stop

@section('adminlte_js')
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
@include('admin.magazine.script')
@stop

@section('footer')
@include('layouts.partials._footer')
@stop
