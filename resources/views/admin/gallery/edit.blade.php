@extends('adminlte::page')

@section('title', 'Edit Gallery')

@section('content_header')
@head(['linkIndex'=>'Galleries','currentLinkAdd'=>'Edit','url'=> route('galleries.index')])
@slot('title')
{{ __('Edit Gallery') }}
@endslot
@endhead
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">{{ __('Edit Gallery') }}</h3>
            </div>
            <form action="{{route('galleries.update', [$gallery->id])}}" method="POST" role="form">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">{{ __('Title') }}</label>
                        <input type="text" name="title"
                            class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title"
                            placeholder="Enter new title.." required autofocus value="{{ $gallery->post_title }}">
                        @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <img src="{{ asset($gallery->post_guid) }}" alt="" class="w-100">
                    </div>

                    <div class="form-group">
                        <label for="alt_text">{{ __('Alternative Text') }}</label>
                        <input type="text" name="alt_text"
                            class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="alt_text"
                            placeholder="Enter alternative text" value="{{ $meta->attr_image_alt }}">
                        @if ($errors->has('alt_text'))
                        <div class="invalid-feedback">
                            {{ $errors->first('alt_text') }}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="caption">{{ __('Caption') }}</label>
                        <input type="text" name="caption"
                            class="form-control {{ $errors->has('caption') ? 'is-invalid' : '' }}" id="caption"
                            placeholder="Enter caption" value="{{ strip_tags($gallery->post_summary) }}">
                        @if ($errors->has('caption'))
                        <div class="invalid-feedback">
                            {{ $errors->first('caption') }}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                            id="description" rows="3" name="description"
                            placeholder="Enter description">{{ strip_tags($gallery->post_content) }}</textarea>
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">{{ __('File Information') }}</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    {{ __('Uploaded On') }}: <strong>{{ $gallery->created_at }}</strong>
                </div>
                <div class="form-group">
                    <label>{{ __('File URL') }}</label>
                    <input type="text" class="form-control" value="{{ $gallery->post_guid }}" readonly>
                </div>
                <div class="form-group">
                    {{ __('File name') }}: <strong>{{ $meta->file }}</strong>
                </div>
                <div class="form-group">
                    {{ __('File type') }}: <strong>{{ $meta->type }}</strong>
                </div>
                <div class="form-group">
                    {{ __('File size') }}: <strong>{{ $meta->size }}</strong>
                </div>
                <div class="form-group">
                    {{ __('Dimension') }}: <strong>{{ $meta->dimension }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('adminlte_css')
<link rel="stylesheet" href="{{ asset('vendor/pace-progress/themes/blue/pace-theme-minimal.css') }}">
@stop

@section('adminlte_js')
<script src="{{ asset('vendor/pace-progress/pace.min.js') }}"></script>
@stop

@section('footer')
@include('layouts.partials._footer')
@stop
