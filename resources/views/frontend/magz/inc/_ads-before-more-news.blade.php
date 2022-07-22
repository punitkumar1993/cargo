@if ( Ads::checkActive('before-more-news') == 'y' )
    <div class="banner">
        @if ( Ads::checkAdImage('before-more-news') != 'noimage.png' )
            <a href="{{ Ads::AdUrl('before-more-news') }}">
                <img src="{{ Ads::adImage('before-more-news') }}" alt="{{ Ads::AdLabel('before-more-news') }}">
            </a>
        @else
            <a href="#">
                <img src="{{ asset('themes/magz/images/ads.png') }}">
            </a>
        @endif
        @if ( Ads::checkScript('before-more-news') != NULL )
            {!! Ads::checkScript('before-more-news') !!}
        @endif
    </div>
@endif