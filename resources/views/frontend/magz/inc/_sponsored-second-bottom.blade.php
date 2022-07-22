<aside id="sponsored">
    @if ( Ads::checkActive('sidebar-right-second-bottom') == 'y' )
        <h1 class="aside-title">{{ Ads::adLabel('sidebar-right-second-bottom') }}</h1>
        <div class="aside-body">
            <figure class="ads">
                @if ( Ads::checkAdImage('sidebar-right-second-bottom') != 'noimage.png' )
                    <a href="{{ Ads::adUrl('sidebar-right-second-bottom') }}">
                        <img src="{{ Ads::adImage('sidebar-right-second-bottom') }}"
                             alt="{{ Ads::AdLabel('sidebar-right-second-bottom') }}">
                    </a>
                @else
                    <a href="#">
                        <img src="{{ asset('themes/magz/images/ad.png') }}">
                    </a>
                @endif
            </figure>
            @if ( Ads::checkScript('sidebar-right-second-bottom') != NULL )
                {!! Ads::checkScript('sidebar-right-second-bottom') !!}
            @endif
        </div>
    @endif
</aside>