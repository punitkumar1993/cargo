@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
@head(['linkIndex'=>'Roles','currentLinkAdd'=>'Edit','url'=> route('roles.index')])
@slot('title')
{{ __('Roles') }}
@endslot
@endhead
@stop

@section('content')
<form action="{{route('roles.update', [$role->id])}}" method="POST" role="form">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Update Role') }}</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" name="name"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name"
                            placeholder="Enter name.." value="{{ $role->name }}" required autofocus>
                        @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Permissions') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row" id="checkAllBox">
                        <div class="col-md-12 text-center mb-3">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input checkbox" type="checkbox" id="checkAll"
                                    @if($ifCheckAll) checked @endif>
                                <label for="checkAll"
                                    class="custom-control-label font-weight-normal">{{ __('Check All') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-3 mb-3">
                            @php $no = 1; @endphp
                            @foreach ($permissions as $key => $row)
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input checkbox" type="checkbox" id="checkbox-{{ $key }}"
                                    name="permissions[]" value="{{ $key }}"
                                    {{ in_array($key, $rolePermissions) ? "checked" : "" }}>
                                <label for="checkbox-{{ $key }}"
                                    class="custom-control-label font-weight-normal">{{ $row }}</label>
                            </div>
                            @if ($no++%4 == 0)
                        </div>
                        <div class="col-sm-3 mb-3">
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">{{ __('Update Role') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>
@stop

@section('plugins.Toastr', true)

@section('adminlte_css')
<link rel="stylesheet" href="{{ asset('vendor/pace-progress/themes/blue/pace-theme-minimal.css') }}">
@stop

@section('adminlte_js')
<script type="text/javascript">
    $("#checkAll").on("click", function() {
        $('#checkAllBox input:checkbox').not(this).prop('checked', this.checked);
    });
</script>
@stop

@section('footer')
@include('layouts.partials._footer')
@stop
