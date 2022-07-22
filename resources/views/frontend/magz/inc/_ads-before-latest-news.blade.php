@if ( Ads::checkActive('before-latest-news') == 'y' )
    <div class="banner">
        @if ( Ads::checkAdImage('before-latest-news') != 'noimage.png' )
            <a href="{{ Ads::AdUrl('before-latest-news') }}">
                <img src="{{ Ads::adImage('before-latest-news') }}" alt="{{ Ads::AdLabel('before-latest-news') }}">
            </a>
        @else
            <a href="#">
                <img src="{{ asset('themes/magz/images/ads.png') }}">
            </a>
        @endif
        @if ( Ads::checkScript('before-latest-news') != NULL )
            {!! Ads::checkScript('before-latest-news') !!}
        @endif
    </div>
@endif