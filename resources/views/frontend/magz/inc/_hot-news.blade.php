<h1 class="title-col">
    {{ __('Trending News') }}
    <div class="carousel-nav" id="hot-news-nav">
        <div class="prev">
            <i class="ion-ios-arrow-left"></i>
        </div>
        <div class="next">
            <i class="ion-ios-arrow-right"></i>
        </div>
    </div>
</h1>
<div class="body-col vertical-slider" data-max="4" data-nav="#hot-news-nav" data-item="article">
    @foreach( Posts::popularPosts()->limit(4)->get() as $post )
    <article class="article-mini">
        <div class="inner">
            <figure>
                <a href="{{ Settings::getRoutePost($post) }}">
                    <img src="{{ Posts::getImage($post->post_content, $post->post_image) }}"
                        alt="{{ $post->post_image }}" alt="{{ $post->post_image }}">
                </a>
            </figure>
            <div class="padding">
                <h1><a href="{{ Settings::getRoutePost($post) }}">{{ $post->post_title }}</a></h1>
                <div class="detail">
                    <div class="category">
                        <a href="{{ route('category.show', Posts::getLinkCategory($post)) }}">
                            {{ Posts::getCategory($post) }}
                        </a>
                    </div>
                    <div class="time">{{ $post->created_at->format('F d, Y')}}</div>
                </div>
            </div>
        </div>
    </article>
    @endforeach
</div>