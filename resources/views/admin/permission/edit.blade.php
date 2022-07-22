@extends('adminlte::page')

@section('title', 'Permissions')

@section('content_header')
@head(['linkIndex'=>'Permissions','currentLinkAdd'=>'Edit','url'=> route('permissions.index')])
@slot('title')
{{ __('Permissions') }}
@endslot
@endhead
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">{{ __('Update Permission') }}</h3>
            </div>
            <form action="{{route('permissions.update', [$permission->id])}}" method="POST" role="form">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="alias">{{ __('Permission') }}</label>
                        <input type="text" name="alias"
                            class="form-control {{ $errors->has('alias') ? 'is-invalid' : '' }}" id="alias"
                            placeholder="Enter permission.." value="{{ $permission->alias }}" required autofocus>
                        @error('alias')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">{{ __('Update Permission') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('adminlte_css')
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/pace-progress/themes/blue/pace-theme-minimal.css') }}">
@stop

@section('adminlte_js')
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
@if(session('info'))
<script>
    var sessionId = "{{ uniqid() }}";
    if (sessionStorage) {
        if (!sessionStorage.getItem('shown-' + sessionId)) {
            toastr.info("{{session('info')}}")
        }
        sessionStorage.setItem('shown-' + sessionId, '1');
    }
</script>
@endif
@stop

@section('footer')
@include('layouts.partials._footer')
@stop