@extends('frontend.magz.index')

@section('content')
<section class="post">
    <div class="container">
        <div class="row">
            <div class="col-md-8 text-left">
                <div class="row">
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li><a href="#">{{ __('Home') }}</a></li>
                            <li class="active">{{ __('All News') }}</li>
                        </ol>
                        <h1 class="page-title">{{ __('All News') }}</h1>
                    </div>
                </div>
                <div class="line"></div>
                <div class="row">
                    @foreach ( $posts as $post)
                    <article class="col-md-12 article-list">
                        <div class="inner">
                            <figure>
                                <a href="{{ Settings::getRoutePost($post) }}">
                                    <img src="{{ Posts::getImage($post->post_content, $post->post_image) }}" alt="{{ $post->post_image }}" alt="{{ $post->post_image }}">
                                </a>
                            </figure>
                            <div class="details">
                                <div class="detail">
                                    <div class="category">
                                        <a href="{{ route('category.show', Posts::getLinkCategory($post)) }}">
                                            {{ Posts::getCategory($post) }}
                                        </a>
                                    </div>
                                    <div class="time">{{ $post->created_at->format('F d, Y') }}</div>
                                </div>
                                <h1><a href="{{ Settings::getRoutePost($post) }}">{{ $post->post_title }}</a></h1>
                                {!! \Str::limit(strip_tags($post->post_content), 100) !!}
                                <footer>
                                    <a href="javascript:void(0);" class="love" data-id="{{ $hashids->encode($post->id) }}"><i class="ion-android-favorite-outline"></i>
                                        <div>{{ $post->like }}</div>
                                    </a>
                                    <a class="btn btn-primary more" href="{{ Settings::getRoutePost($post) }}">
                                        <div>{{ __('More') }}</div>
                                        <div><i class="ion-ios-arrow-thin-right"></i></div>
                                    </a>
                                </footer>
                            </div>
                        </div>
                    </article>
                    @endforeach
                    <div class="col-md-12 text-center">
                        {{ $posts->links('frontend.magz.inc._pagination') }}
                    </div>
                </div>
            </div>
            <div class="col-md-4 sidebar">
                @include('frontend.magz.template-parts.sidebar-posts')
            </div>
        </div>
    </div>
</section>
@stop
