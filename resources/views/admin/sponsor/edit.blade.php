
@extends('adminlte::page')

@section('title', 'Edit Sponsored Video')

@section('content_header')
@head(['linkIndex'=>'SponsoredVideo','currentLinkAdd'=>'Edit','url'=> route('sponsor-video.index')])
@slot('title')
{{ __('Edit Sponsored Video') }}
@endslot
@endhead
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <form action="{{route('sponsor-video.update', [$sponsorVideo->id])}}" method="POST" role="form" >
            @method('PUT')
            @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="label">{{ __('Label') }}</label>
                        <input id="label" type="text" name="label"
                            class="form-control {{ $errors->has('label') ? 'is-invalid' : '' }}" placeholder="Enter label" required value="{{ $sponsorVideo->label }}">
                        @if ($errors->has('label'))
                        <div class="invalid-feedback">
                            {{ $errors->first('namlabele') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="url">{{ __('Youtube ID') }}</label>
                        <input id="url" class="form-control" name="youtube_id" type="text" placeholder="Youtube ID" value="{{ $sponsorVideo->youtube_id }}">
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
@include('admin.advertisement.style')
@stop

@section('adminlte_js')
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
@stop

@section('footer')
@include('layouts.partials._footer')
@stop
