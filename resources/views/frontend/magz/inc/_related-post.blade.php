@if($countRelatedPost > 1)
<div class="line">
    <div>{{ __('You May Also Like') }}</div>
</div>
@endif
<div class="row">
    @empty($term_taxonomy)
    @else
    @foreach ( $term_taxonomy->skip(0)->take(2) as $relpost)
    @if ($post->post_title !== $relpost->post_title)
    <article class="article related col-md-6 col-sm-6 col-xs-12">
        <div class="inner">
            <figure>
                <a href="{{ Settings::getRoutePost($post) }}">
                    <img src="{{ Posts::getImage($relpost->post_content, $relpost->post_image) }}" alt="{{ $relpost->post_image }}" alt="{{ $relpost->post_image }}">
                </a>
            </figure>
            <div class="padding">
                <h2><a href="{{ Settings::getRoutePost($relpost) }}">{{ $relpost->post_title }}</a></h2>
                <div class="detail">
                    <div class="category">
                        <a href="{{ route('category.show', Posts::getLinkCategory($relpost)) }}">
                            {{ Posts::getCategory($relpost) }}
                        </a>
                    </div>
                    <div class="time">{{ $relpost->created_at->format('F d, Y') }}</div>
                </div>
            </div>
        </div>
    </article>
    @endif
    @endforeach
    @endempty
</div>
