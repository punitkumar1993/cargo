<h1 class="title-col">{{ __('Trending Tags') }}</h1>
<div class="body-col">
    @if(Posts::tagCount() == '')
    <p>{{ __('No Tag') }}</p>
    @else
    <ol class="tags-list">
        @foreach (Posts::tagCount()->skip(0)->take(10) as $count)
        <li><a href="{{ route('tag.show', $count->term->slug) }}">{{ $count->term->name }}</a></li>
        @endforeach
    </ol>
    @endif
</div>