@if ( Ads::checkActive('home-horizontal') == 'y' )
    <div class="banner">
        @if ( Ads::checkAdImage('home-horizontal') != 'noimage.png' )
            <a href="{{ Ads::AdUrl('home-horizontal') }}">
                <img src="{{ Ads::adImage('home-horizontal') }}" alt="{{ Ads::AdLabel('home-horizontal') }}">
            </a>
        @else
            <a href="#">
                <img src="{{ asset('themes/magz/images/ads.png') }}">
            </a>
        @endif
        @if ( Ads::checkScript('home-horizontal') != NULL )
            {!! Ads::checkScript('home-horizontal') !!}
        @endif
    </div>
@endif