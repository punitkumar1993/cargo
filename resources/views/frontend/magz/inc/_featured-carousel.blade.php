<div class="owl-carousel owl-theme slide" id="featured">
    @foreach (Posts::recentPosts()->limit(4)->get() as $post)
    <div class="item">
        <article class="featured">
            <div class="overlay"></div>
            <figure>
                <img src="{{ Posts::getImage($post->post_content, $post->post_image) }}" alt="{{ $post->post_image }}">
            </figure>
            <div class="details">
                <div class="category">
                    <a href="{{ route('category.show', Posts::getLinkCategory($post))}}">
                        {{ Posts::getCategory($post) }}
                    </a>
                </div>
                <h1><a href="{{ Settings::getRoutePost($post) }}">{{ $post->post_title }}</a></h1>
                <div class="time">{{ $post->created_at->format('F d, Y') }}</div>
            </div>
        </article>
    </div>
    @endforeach
</div>