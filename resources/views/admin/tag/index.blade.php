@extends('adminlte::page')

@section('title', 'Tags')

@section('content_header')
@head(['linkIndex'=>'Tags'])
@slot('title')
{{ __('Tags') }}
@endslot
@endhead
@stop

@section('content')
<div class="row">
    <div class="col-md-4">
        @include('admin.tag.create')
    </div>
    <div class="col-md-8">
        @include('layouts.partials._table')
    </div>
</div>
@stop

@section('adminlte_css')
<link rel="stylesheet" href="{{ asset('vendor/pace-progress/themes/blue/pace-theme-minimal.css') }}">
@stop

@section('adminlte_js')
@include('layouts.partials._script')
@include('admin.tag.script')
@stop

@section('footer')
@include('layouts.partials._footer')
@stop