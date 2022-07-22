@if ( Ads::checkActive('before-trending-section') == 'y' )
    <div class="banner">
        @if ( Ads::checkAdImage('before-trending-section') != 'noimage.png' )
            <a href="{{ Ads::AdUrl('before-trending-section') }}">
                <img src="{{ Ads::adImage('before-trending-section') }}" alt="{{ Ads::AdLabel('before-trending-section') }}">
            </a>
        @else
            <a href="#">
                <img src="{{ asset('themes/magz/images/ads.png') }}">
            </a>
        @endif
        @if ( Ads::checkScript('before-trending-section') != NULL )
            {!! Ads::checkScript('before-trending-section') !!}
        @endif
    </div>
@endif