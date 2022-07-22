@if ( Ads::checkActive('home-center') == 'y' )
    <div class="banner">

        @if ( Ads::checkAdImage('home-center') != 'noimage.png' )
            <a href="{{ Ads::AdUrl('home-center') }}">
                <img src="{{ Ads::adImage('home-center') }}" alt="{{ Ads::AdLabel('home-center') }}">
            </a>
        @else
            <a href="#">
                <img src="{{ asset('themes/magz/images/ads.png') }}">
            </a>
        @endif

        @if ( Ads::checkScript('home-center') != NULL )
            {!! Ads::checkScript('home-center') !!}
        @endif
    </div>
@endif