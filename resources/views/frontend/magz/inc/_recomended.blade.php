<aside>
    <ul class="nav nav-tabs nav-justified" role="tablist">
        <li class="active">
            <a href="#recomended" aria-controls="recomended" role="tab" data-toggle="tab">
                <i class="ion-android-star-outline"></i> {{ __('Recommended') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="recomended">
            @foreach (Posts::popularPosts()->limit(4)->get() as $post)
                @if( $post->post_title == Posts::popularPosts()->first()->post_title )
                <article class="article-fw">
                    <div class="inner">
                        <figure>
                            <a href="{{ Settings::getRoutePost($post) }}">
                                <img src="{{ Posts::getImage($post->post_content, $post->post_image) }}" alt="{{ $post->post_image }}" alt="{{ $post->post_image }}">
                            </a>
                        </figure>
                        <div class="details">
                            <div class="detail">
                                <div class="time">{{ $post->created_at->format('F d, Y') }}</div>
                                <div class="category">
                                    <a href="{{ route('category.show', Posts::getLinkCategory($post)) }}">
                                        {{ Posts::getCategory($post) }}
                                    </a>
                                </div>
                            </div>
                            <h1><a href="{{ Settings::getRoutePost($post) }}">{{ $post->post_title }}</a>
                            </h1>
                            {{ \Str::limit(strip_tags($post->post_content), 100) }}
                        </div>
                    </div>
                </article>
                <div class="line"></div>
                @else
                <article class="article-mini">
                    <div class="inner">
                        <figure>
                            <a href="{{ Settings::getRoutePost($post) }}">
                                <img src="{{ Posts::getImage($post->post_content, $post->post_image) }}" alt="{{ $post->post_image }}" alt="{{ $post->post_image }}">
                            </a>
                        </figure>
                        <div class="padding">
                            <h1><a href="{{ Settings::getRoutePost($post) }}">{{ $post->post_title }}</a>
                            </h1>
                            <div class="detail">
                                <div class="category">
                                    <a href="{{ route('category.show', Posts::getLinkCategory($post)) }}">
                                        {{ Posts::getCategory($post) }}
                                    </a>
                                </div>
                                <div class="time">{{ $post->created_at->format('F d, Y') }}</div>
                            </div>
                        </div>
                    </div>
                </article>
                @endif
            @endforeach
        </div>
    </div>
</aside>