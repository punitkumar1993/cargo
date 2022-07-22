@extends('adminlte::page')

@section('title', 'Setting')

@section('content_header')
@head(['linkIndex'=>'Settings'])
@slot('title')
{{ __('Settings') }}
@endslot
@endhead
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-5 col-sm-3">
                        <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="web-information-tab" data-toggle="pill" href="#web-information" role="tab" aria-controls="web-information" aria-selected="true">{{ __('Web Information') }}</a>
                            <a class="nav-link" id="web-contact-tab" data-toggle="pill" href="#web-contact" role="tab" aria-controls="web-contact" aria-selected="false">{{ __('Web Contact') }}</a>
                            <a class="nav-link" id="web-image-tab" data-toggle="pill" href="#web-image" role="tab" aria-controls="image" aria-selected="false">{{ __('Web Properties') }}</a>
                            <a class="nav-link" id="web-config-tab" data-toggle="pill" href="#web-config" role="tab" aria-controls="web-config" aria-selected="false">{{ __('Web Config') }}</a>
                            <a class="nav-link" id="web-permalinks-tab" data-toggle="pill" href="#web-permalinks" role="tab" aria-controls="web-permalinks" aria-selected="false">{{ __('Web Permalinks') }}</a>
                            <a class="nav-link" id="newsletters-tab" data-toggle="pill" href="#newsletters" role="tab" aria-controls="newsletteres" aria-selected="false">{{ __('Newsletter') }}</a>
                        </div><!-- /.nav -->
                    </div><!-- /.col-5 -->
                    <div class="col-7 col-sm-9">
                        <div class="tab-content" id="vert-tabs-tabContent">
                            @include('admin.setting.web-information')
                            @include('admin.setting.web-contact')
                            @include('admin.setting.web-image')
                            @include('admin.setting.web-config')
                            @include('admin.setting.web-permalinks')
                            @include('admin.setting.newsletters')
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@stop

@section('adminlte_css')
<link rel="stylesheet" href="{{ asset('vendor/pace-progress/themes/blue/pace-theme-minimal.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/codemirror/lib/codemirror.css') }}">
@stop

@section('adminlte_js')
<script src="{{ asset('vendor/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('vendor/codemirror/lib/codemirror.js') }}"></script>
<script src="{{ asset('vendor/codemirror/addon/selection/active-line.js') }}"></script>
@include('layouts.partials._script')
@include('admin.setting.script')
@stop

@section('footer')
@include('layouts.partials._footer')
@stop
