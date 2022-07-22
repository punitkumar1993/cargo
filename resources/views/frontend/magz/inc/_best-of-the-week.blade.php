@if(count(Posts::lastWeekPosts()->get()))
<section class="best-of-the-week">
    <div class="container">
        <h1>
            <div class="text">{{ __('Best Of The Week') }}</div>
            <div class="carousel-nav" id="best-of-the-week-nav">
                <div class="prev">
                    <i class="ion-ios-arrow-left"></i>
                </div>
                <div class="next">
                    <i class="ion-ios-arrow-right"></i>
                </div>
            </div>
        </h1>
        <div class="owl-carousel owl-theme carousel-1">
            @foreach ( Posts::lastWeekPosts()->limit(6)->get() as $post )
            <article class="article">
                <div class="inner">
                    <figure>
                        <a href="{{ Settings::getRoutePost($post) }}">
                            <img src="{{ Posts::getImage($post->post_content, $post->post_image) }}" alt="{{ $post->post_image }}" alt="{{ $post->post_image }}">
                        </a>
                    </figure>
                    <div class="padding">
                        <div class="detail">
                            <div class="time">{{ $post->created_at->format('F d, Y') }}</div>
                            <div class="category"><a href="{{ route('category.show', Posts::getLinkCategory($post)) }}">{{ Posts::getCategory($post) }}</a>
                            </div>
                        </div>
                        <h2><a href="{{ Settings::getRoutePost($post) }}">{{ \Str::limit($post->post_title, 50) }}</a>
                        </h2>
                        {!! \Str::limit(strip_tags($post->post_content), 100) !!}
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif
