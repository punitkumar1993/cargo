 @foreach ($moreNews2 as $key => $post)
        @if(($key%2) == 0)
            <div class="row">
        @endif
    <div class="col-md-6 col-sm-6 col-xs-12 equalHeight">
        <article class="article col-md-12">
            <div class="inner">
                <figure>
                    <a href="{{ Settings::getRoutePost($post) }}">
                        <img src="{{ Posts::getImage($post->post_content, $post->post_image) }}"
                            alt="{{ $post->post_image }}" alt="{{ $post->post_image }}">
                    </a>
                </figure>
                <div class="padding">
                    <div class="detail">
                        <div class="time">{{ $post->created_at->format('F d, Y') }}</div>
                        <div class="category">
                            <a href="{{ route('category.show', Posts::getLinkCategory($post)) }}">
                                {{ Posts::getCategory($post) }}
                            </a>
                        </div>
                        {{--<li>{{ $post->post_hits }} {{ __('Views') }}</li>--}}
                    </div>
                    <h2><a href="{{ Settings::getRoutePost($post) }}">{{ strip_tags($post->post_title) }}</a>
                    </h2>
                    {!! \Str::limit(strip_tags($post->post_content), 200) !!}
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
    </div>
                @if(($key%2) == 1)
                    </div>
                        @endif
    @endforeach
