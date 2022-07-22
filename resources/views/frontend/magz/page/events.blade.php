@extends('frontend.magz.index')

@section('content')
    <section class="category">
        <div class="container">
            <div class="row">
                <div class="col-md-8 text-left">
                    <div class="row">
                        <div class="col-md-12">
                            <ol class="breadcrumb">
                                <li><a href="#">{{ __('Home') }}</a></li>
                                <li class="active">{{ ($term->name) ?? 'Events' }}</li>
                            </ol>
                            @if(isset($term->name) && $term->name!=null)
                                <h1 class="page-title">{{ $term->name }}</h1>
                                <p class="page-subtitle">{{ __('Showing all posts with category') }}  <i>{{ $term->name }}</i></p>
                            @else
                                <h1 class="page-title">{{ __('Events') }}</h1>
                                <p class="page-subtitle">{{ __('Showing all events') }} </p>
                            @endif
                        </div>
                    </div>
                    <div class="line"></div>
                    <div class="row">
                        @foreach ( $paginate_posts as $post)
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
                                                @if($post->termtaxonomy->where('taxonomy','category')->first())
                                                    <a href="{{ route('category.show', $post->termtaxonomy->where('taxonomy','category')->first()->term->slug)}}">{{ $post->termtaxonomy->where('taxonomy','category')->first()->term->name }}</a>
                                                @endif
                                            </div>
                                            <div class="time">{{ $post->created_at->format('F d, Y') }}</div>
                                        </div>
                                        <h1><a href="{{ Settings::getRouteEvent($post) }}">{{ $post->post_title }}</a></h1>
                                        {!! \Str::limit(strip_tags($post->post_content), 100) !!}
                                        <footer>
                                            <a href="javascript:void(0);" class="love" data-id="{{ $hashids->encode($post->id) }}"><i class="ion-android-favorite-outline"></i>
                                                <div>{{ $post->like }}</div>
                                            </a>
                                            <a class="btn btn-primary more" href="{{ Settings::getRoutePost($post) }}">
                                                <div>More</div>
                                                <div><i class="ion-ios-arrow-thin-right"></i></div>
                                            </a>
                                        </footer>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                        <div class="col-md-12 text-center">
                            {{ $paginate_posts->links('frontend.magz.inc._pagination') }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 sidebar">
                    @include('frontend.magz.template-parts.sidebar-right')
                </div>
            </div>
        </div>
    </section>
@stop
