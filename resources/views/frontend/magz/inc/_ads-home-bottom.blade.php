@if ( Ads::checkActive('home-bottom') == 'y' )
    <div class="banner">

        @if ( Ads::checkAdImage('home-bottom') != 'noimage.png' )
            <a href="{{ Ads::AdUrl('home-bottom') }}">
                <img src="{{ Ads::adImage('home-bottom') }}" alt="{{ Ads::AdLabel('home-bottom') }}">
            </a>
        @else
            <a href="#">
                <img src="{{ asset('themes/magz/images/ads.png') }}">
            </a>
        @endif

        @if ( Ads::checkScript('home-bottom') != NULL )
            {!! Ads::checkScript('home-bottom') !!}
        @endif
    </div>
@endif