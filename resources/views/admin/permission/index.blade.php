@extends('adminlte::page')

@section('title', 'Permissions')

@section('content_header')
@head(['linkIndex'=>'Permissions'])
@slot('title')
{{ __('Permissions') }}
@endslot
@endhead
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        @include('layouts.partials._table')
    </div>
</div>
@stop

@section('adminlte_css')
<link rel="stylesheet" href="{{ asset('vendor/pace-progress/themes/blue/pace-theme-minimal.css') }}">
@stop

@section('adminlte_js')
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
@include('layouts.partials._script')
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
@if(session('status'))
<script>
    var sessionId = "{{ uniqid() }}";
    if (sessionStorage) {
        if (!sessionStorage.getItem('shown-' + sessionId)) {
            toastr.success("{{ session('status')}}")
        }
        sessionStorage.setItem('shown-' + sessionId, '1');
    }
</script>
@endif
@stop

@section('footer')
@include('layouts.partials._footer')
@stop