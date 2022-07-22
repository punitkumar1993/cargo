@extends('adminlte::page')

@section('title', 'File Manager')

@section('content_header')
@head(['linkIndex'=>'File Manager'])
@slot('title')
{{ __('File Manager') }}
@endslot
@endhead
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div style="height: 600px;">
            <div id="fm"></div>
        </div>
    </div>
</div>
@stop

@section('adminlte_css')
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/pace-progress/themes/blue/pace-theme-minimal.css') }}">
@stop

@section('adminlte_js')
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
@stop

@section('footer')
@include('layouts.partials._footer')
@stop