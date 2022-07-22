@extends('adminlte::page')

@section('title', 'Menu')

@section('content_header')
@head(['linkIndex'=>'Menu'])
@slot('title')
{{ __('Menu') }}
@endslot
@endhead
@stop

@section('content')
{!! Menu::render() !!}
@stop

@section('adminlte_css')
<link rel="stylesheet" href="{{ asset('vendor/pace-progress/themes/blue/pace-theme-minimal.css') }}">
<link rel="stylesheet" href="{{asset('vendor/fontawesome-free/css/all.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/harimayco-menu/style.css')}}">
@stop

@section('adminlte_js')
@include('layouts.partials._script')
{!! Menu::scripts() !!}
@stop

@section('footer')
@include('layouts.partials._footer')
@stop