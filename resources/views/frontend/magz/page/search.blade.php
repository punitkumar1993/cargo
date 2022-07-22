@extends('frontend.magz.index')

@section('content')
<section class="search">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-md-4 sidebar" id="sidebar">
                @include('frontend.magz.inc._hot-news')
            </div>
            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="search-result">
                    {{ __('Search results for keyword') }} "{{ $keyword }}" {{ __('found in') }} {{ $countResults }} {{ __('posts') }}.
                </div>
                <div class="row">
                    @foreach( $results as $post )
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
                                    <time> {{ $post->created_at->format('F d, Y') }}</time>
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
                        {{ $results->appends(['q' => $keyword])->links('frontend.magz.inc._pagination') }}
                    </div>
                </div>
            </div>
        </div>
</section>
@stop
