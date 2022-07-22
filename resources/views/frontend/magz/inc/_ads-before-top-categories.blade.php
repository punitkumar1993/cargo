@if ( Ads::checkActive('before-top-categories') == 'y' )
    <div class="banner">
        @if ( Ads::checkAdImage('before-top-categories') != 'noimage.png' )
            <a href="{{ Ads::AdUrl('before-top-categories') }}">
                <img src="{{ Ads::adImage('before-top-categories') }}" alt="{{ Ads::AdLabel('before-top-categories') }}">
            </a>
        @else
            <a href="#">
                <img src="{{ asset('themes/magz/images/ads.png') }}">
            </a>
        @endif
        @if ( Ads::checkScript('before-top-categories') != NULL )
            {!! Ads::checkScript('before-top-categories') !!}
        @endif
    </div>
@endif