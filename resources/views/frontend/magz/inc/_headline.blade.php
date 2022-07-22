<div class="headline">
    <div class="nav" id="headline-nav">
        <a class="left carousel-control" role="button" data-slide="prev">
            <span class="ion-ios-arrow-left" aria-hidden="true"></span>
            <span class="sr-only">{{ __('Previous') }}</span>
        </a>
        <a class="right carousel-control" role="button" data-slide="next">
            <span class="ion-ios-arrow-right" aria-hidden="true"></span>
            <span class="sr-only">{{ __('Next') }}</span>
        </a>
    </div>
    <div class="owl-carousel owl-theme" id="headline">
        @foreach (Posts::recentPosts()->limit(4)->get() as $post)
        <div class="item">
            <a href="{{ Settings::getRoutePost($post) }}">
                <div class="badge">
                    {{ Posts::getCategory($post) }}
                </div>
                {{ $post->post_title }}
            </a>
        </div>
        @endforeach
    </div>
</div>