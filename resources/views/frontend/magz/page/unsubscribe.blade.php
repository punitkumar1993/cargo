@extends('frontend.magz.index')

@section('content')
    <section class="page">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <ol class="breadcrumb">
                        <li><a href="index.html">{{ __('Home') }}</a></li>
                        <li class="active">Unsubscribe</li>
                    </ol>
                    <div style="margin-bottom: 50px;padding-bottom: 50px;border: 1px solid #ddd;background: #f9f7f7;">
                        <h1 class="page-title">Unsubscribe Successful</h1>
                        <p class="" style="margin-top: 10px;">You have successfully unsubscribed from Cargo Trends's email list. <br>You will no longer receive updates and announcements.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
