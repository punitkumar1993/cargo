@extends('adminlte::page')

@section('title', 'Contacts')

@section('content_header')
@head(['linkIndex'=>'Contacts','currentLinkAdd'=>'Detail Message','url'=> route('contacts.index')])
@slot('title')
{{ __('Contacts') }}
@endslot
@endhead
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Message</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{ $contact->name }}</td>
                        </tr>
                        <th>E-Mail</th>
                        <td>{{ $contact->email }}</td>
                        <tr>
                            <th>Subject</th>
                            <td>{{ $contact->subject }}</td>
                        </tr>
                        <tr>
                            <th>Message</th>
                            <td>{{ $contact->message }}</td>
                        </tr>
                        <tr>
                            <th>Date & Time</th>
                            <td>{{ $contact->created_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
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