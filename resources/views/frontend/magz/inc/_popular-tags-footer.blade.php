<h1 class="block-title">{{ __('Popular Tags') }} {{--<div class="right"><a href="#">{{ __('See All') }} <i class="ion-ios-arrow-thin-right"></i></a></div>--}}
</h1>
<div class="block-body">
    <ul class="tags">
        @foreach (Posts::tagCount()->skip(0)->take(10) as $count)
        <li><a href="{{ route('tag.show', $count->term->slug) }}">{{ $count->term->name }}</a></li>
        @endforeach
    </ul>
</div>