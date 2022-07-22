
@extends('adminlte::page')

@section('title', 'Edit Latest Edition')

@section('content_header')
@head(['linkIndex'=>'LatestEdition','currentLinkAdd'=>'Edit','url'=> route('latest-edition.index')])
@slot('title')
{{ __('Edit Latest Edition') }}
@endslot
@endhead
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <form action="{{route('latest-edition.update', [$latestEdition->id])}}" method="POST" role="form" enctype="multipart/form-data">
            @method('PUT')
            @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="label">{{ __('Label') }}</label>
                        <input id="label" type="text" name="label"
                            class="form-control {{ $errors->has('label') ? 'is-invalid' : '' }}" placeholder="Enter label" required value="{{ $latestEdition->label }}">
                        @if ($errors->has('label'))
                        <div class="invalid-feedback">
                            {{ $errors->first('namlabele') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="upload">{{ __('Upload Image') }}</label>
                        <div class="upload-banner row justify-content-md-center @if($latestEdition->image != 'noimage.png')ready @endif">
                            <input id="upload" type="file" name="image" value="Choose a file" accept="image/*" data-role="none" hidden>
                            <input type="hidden" name="isimage">
                            <div class="col-md-8 text-center">
                                <div class="upload-msg">{{ __('Click to upload banner') }}</div>
                                <div id="display">
                                    <img id="image_preview_container" src="{{ $image }}" name="image" alt="preview image" style="max-width: 100%;">
                                </div>
                                <div class="buttons text-center mt-3">
                                    <button id="reset" type="button" class="reset btn btn-danger">Remove Image</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="url">{{ __('Ad URL') }}</label>
                        <input id="url" class="form-control" name="url" type="text" placeholder="Ad URL" value="{{ $latestEdition->url }}">
                    </div>
                    <hr class="my-4">
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
@include('admin.advertisement.style')
@stop

@section('adminlte_js')
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
@include('admin.edition.script')
@stop

@section('footer')
@include('layouts.partials._footer')
@stop
