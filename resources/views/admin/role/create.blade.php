@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
@head(['linkIndex'=>'Roles','currentLinkAdd'=>'Add New','url'=> route('roles.index')])
@slot('title')
{{ __('Roles') }}
@endslot
@endhead
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">{{ __('Add New Role') }}</h3>
            </div>
            <form action="{{ route('roles.store') }}" method="POST" role="form">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" name="name"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name"
                            placeholder="Enter name.." required autofocus>
                        @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">{{ __('Add New Role') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('adminlte_css')
<link rel="stylesheet" href="{{ asset('vendor/pace-progress/themes/blue/pace-theme-minimal.css') }}">
@stop

@section('footer')
@include('layouts.partials._footer')
@stop
