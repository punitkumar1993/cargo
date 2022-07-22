<aside id="sponsored">
    @if ( Ads::checkActive('sidebar-right-bottom') == 'y' )
        <h1 class="aside-title">{{ Ads::adLabel('sidebar-right-bottom') }}</h1>
        <div class="aside-body">
            @if ( Ads::checkScript('sidebar-right-bottom') == NULL )
            <figure class="ads">
                @if ( Ads::checkAdImage('sidebar-right-bottom') != 'noimage.png' )
                <a href="{{ Ads::adUrl('sidebar-right-bottom') }}">
                    <img src="{{ Ads::adImage('sidebar-right-bottom') }}" alt="{{ Ads::AdLabel('sidebar-right-bottom') }}">
                </a>
                @else
                <a href="#">
                    <img src="{{ asset('themes/magz/images/ad.png') }}">
                </a>
                @endif
            </figure>
            @else
            {!! Ads::checkScript('sidebar-right-bottom') !!}
            @endif
        </div>
    @endif
</aside>