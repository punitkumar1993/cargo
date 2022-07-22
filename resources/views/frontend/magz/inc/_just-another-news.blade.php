<div class="line top">
    <div>{{ __('Just Another News') }}</div>
</div>
<div class="row">
    @foreach (Posts::recentPosts()->limit(4)->get() as $post)
    <article class="col-md-12 article-list">
        <div class="inner">
            <figure>
                <a href="{{ Settings::getRoutePost($post) }}">
                    <img src="{{ Posts::getImage($post->post_content, $post->post_image) }}"
                        alt="{{ $post->post_image }}" alt="{{ $post->post_image }}">
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
                <p>
                    {!! \Str::limit(strip_tags($post->post_content), 100) !!}
                </p>
                <footer>
                    <a href="javascript:void(0);" class="love" data-id="{{ $hashids->encode($post->id) }}"><i
                            class="ion-android-favorite-outline"></i>
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
</div>
