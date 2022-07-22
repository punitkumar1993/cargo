{{-- resources/views/admin/banner/edit.blade.php --}}

@extends('adminlte::page')

@section('title', 'Add Subscriber')

@section('content_header')
@head(['linkIndex'=>'Subscriber','currentLinkAdd'=>'Add','url'=> route('subscriber.index')])
@slot('title')
{{ __('Add Subscriber') }}
@endslot
@endhead
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <form action="{{route('subscriber.store')}}" method="POST" role="form" enctype="multipart/form-data">
            @method('PUT')
            @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="label">{{ __('Email') }}</label>
                        <input id="label" type="text" name="email"
                            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Enter email" required>
                        @if ($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                        @endif
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
<link rel="stylesheet" href="{{ asset('vendor/pace-progress/themes/blue/pace-theme-minimal.css') }}">
@include('admin.subscribers.style')
@stop

@section('footer')
@include('layouts.partials._footer')
@stop
