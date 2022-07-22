<div class="block">
    <h1 class="block-title">{{ __('Latest News') }}</h1>
    <div class="block-body">
        @foreach (Posts::recentPosts()->limit(4)->get() as $post)
        <article class="article-mini">
            <div class="inner">
                <figure>
                    <a href="{{ Settings::getRoutePost($post) }}">
                        <img src="{{ Posts::getImage($post->post_content, $post->post_image) }}" alt="{{ $post->post_image }}" alt="{{ $post->post_image }}">
                    </a>
                </figure>
                <div class="padding">
                    <h1><a href="{{ Settings::getRoutePost($post) }}">{{ $post->post_title }}</a></h1>
                </div>
            </div>
        </article>
        @endforeach
        <a href="{{ route('articles.latest') }}" class="btn btn-magz white btn-block">{{ __('See All') }} <i class="ion-ios-arrow-thin-right"></i></a>
    </div>
</div>
