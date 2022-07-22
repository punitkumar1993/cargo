@if ( Ads::checkActive('after-main-slider') == 'y' )
    <div class="banner">
        @if ( Ads::checkAdImage('before-latest-news') != 'noimage.png' )
            <a href="{{ Ads::AdUrl('after-main-slider') }}">
                <img src="{{ Ads::adImage('after-main-slider') }}" alt="{{ Ads::AdLabel('after-main-slider') }}">
            </a>
        @else
            <a href="#">
                <img src="{{ asset('themes/magz/images/ads.png') }}">
            </a>
        @endif
        @if ( Ads::checkScript('after-main-slider') != NULL )
            {!! Ads::checkScript('after-main-slider') !!}
        @endif
    </div>
@endif