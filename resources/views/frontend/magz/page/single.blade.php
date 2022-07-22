@extends('frontend.magz.index')

@section('content')
<section class="single">
    <div class="container">
        <div class="row">
             <div class="col-md-8">
                <ol class="breadcrumb">
                    <li><a href="/">{{ __('Home') }}</a></li>
                    <li class="active">{{ Posts::getCategory($post) }}</li>
                </ol>
                <article class="article main-article">
                    <header>
                        <h1>{{ $post->post_title }}</h1>
                        <ul class="details">
                            <li>{{ __('Posted on') }} {{ $post->created_at->format('F d, Y') }}</li>

                            <li><a href="{{ route('category.show', Posts::getLinkCategory($post)) }}">{{ Posts::getCategory($post) }}</a></li>
                            {{--<li>{{ __('By') }} <span>{{ $post->user->name }}</span></li>
                            <li>{{ $post->post_hits }} Views</li>--}}
                        </ul>
                    </header>
                    @if($post->post_type == 'event')
                        <header>
                            <!-- <h1>{{ $post->post_title }}</h1> -->
                            <ul class="details">
                                <li>{{ __('Event Date : ') }} {{ $post->event_date_time }}</li>
                                <li>{{ __('Event Location : ') }} {{ $post->event_location }}</li>
                            </ul>
                        </header>
                    @endif
                    <div class="main">
                        {!! $post->post_summary !!}
                        <figure>
                            @if(!empty($post->post_image))
                            <img src="{{ route('image.displayImage', $post->post_image) }}" alt="">
                            @endif
                        </figure>
                        {!! $post->post_content !!}
                    </div>
                    <footer>
                        <div class="col">
                            <ul class="tags">
                                @foreach( $tags as $tag )
                                <li><a href="{{ route('tag.show', $tag->term->slug) }}">{{ $tag->term->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col">
                            <a href="javascript:void(0);" class="love" data-id="{{ $hashids->encode($post->id) }}"><i class="ion-android-favorite-outline"></i>
                                <div>{{ $post->like }}</div>
                            </a>
                        </div>
                    </footer>
                </article>
                <div class="sharing">
                    <div class="title"><i class="ion-android-share-alt"></i> {{ __('Sharing is caring') }}</div>
                    {!! Share::page('laramagz', null, [], '<ul class="social">','</ul>')
                    ->facebook()
                    ->twitter()
                    ->linkedin()
                    ->whatsapp()
                     ->telegram()!!}
                </div>
                {{--<div class="line">
                    <div>{{ __('Author') }}</div>
                </div>
                <div class="author">
                    <figure>
                        @if($post->user->photo)
                        @if($post->user->photo != 'noavatar.png')
                        <img src="{{ route('author.photo', $post->user->photo) }}">
                        @else
                        <img src="{{ asset('img/noavatar.png') }}" alt="No Image">
                        @endif
                        @else
                        <img src="{{ asset('img/noavatar.png') }}" alt="No Image">
                        @endif
                    </figure>
                    <div class="details">
                        <div class="job">{{ $post->user->occupation }}</div>
                        <h3 class="name">{{ $post->user->name }}</h3>
                        <p>@if($post->user->about) {{ $post->user->about }} @else <i>{{ __('No description') }}...</i>@endif</p>

                        @if ( $post->user->socialmedia()->exists() )
                        <ul class="social trp sm">
                            @foreach ( $post->user->socialmedia()->get() as $socmed )
                            <li>
                                <a href="{{ $socmed->pivot->url }}" class="{{ $socmed->slug }}" target="_blank">
                                    <svg>
                                        <rect /></svg>
                                    <i class="ion-social-{{ $socmed->slug }}"></i>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>--}}
                @include('frontend.magz.inc._related-post')
                <div class="line thin"></div>
                @include('frontend.magz.inc._comment-disqus')
            </div>
            <div class="col-md-4 sidebar" id="sidebar">
{{--                @include('frontend.magz.template-parts.sidebar-left')--}}
                @include('frontend.magz.template-parts.sidebar-right')
            </div>
           
        </div>
    </div>
</section>
@endsection
