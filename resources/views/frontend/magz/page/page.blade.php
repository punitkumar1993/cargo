@extends('frontend.magz.index')

@section('content')
<section class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <ol class="breadcrumb">
                    <li><a href="index.html">{{ __('Home') }}</a></li>
                    <li class="active">{{ $page->post_title }}</li>
                </ol>
                <h1 class="page-title">{{ $page->post_title }}</h1>
                <p class="page-subtitle">{!! strip_tags($page->post_summary) !!}</p>
                <div class="line thin"></div>
                <figure>
                    @if(!empty($page->post_image))
                    <img src="{{ route('image.displayImage', $page->post_image) }}" alt="">
                    @endif
                </figure>
                <div class="page-description">
                    {!! html_entity_decode($page->post_content) !!}
                </div>
            </div>
        </div>
    </div>
</section>
@stop
