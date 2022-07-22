<aside>
   <!--  @include('frontend.magz.inc._search-form') -->
   <!--  <h1 class="aside-title">{{ __('Popular') }} <a href="/popular/news" class="all">{{ __('See All') }} <i class="ion-ios-arrow-right"></i></a></h1>
    <div class="aside-body">
        
        
        @foreach( Posts::popularPosts()->limit(4)->get() as $post )
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
                </div>
            </div>
        </article>
        @endforeach
    </div> -->
</aside>