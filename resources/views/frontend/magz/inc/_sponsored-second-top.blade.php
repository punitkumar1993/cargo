<aside id="sponsored">
    @if ( Ads::checkActive('sidebar-right-second-top') == 'y' )
        <h1 class="aside-title">{{ Ads::adLabel('sidebar-right-second-top') }}</h1>
        <div class="aside-body">
            <figure class="ads">
                @if ( Ads::checkAdImage('sidebar-right-second-top') != 'noimage.png' )
                    <a href="{{ Ads::adUrl('sidebar-right-second-top') }}">
                        <img src="{{ Ads::adImage('sidebar-right-second-top') }}"
                             alt="{{ Ads::AdLabel('sidebar-right-second-top') }}">
                    </a>
                @else
                    <a href="#">
                        <img src="{{ asset('themes/magz/images/ad.png') }}">
                    </a>
                @endif
            </figure>
            @if ( Ads::checkScript('sidebar-right-second-top') != NULL )
                {!! Ads::checkScript('sidebar-right-second-top') !!}
            @endif
        </div>
    @endif
</aside>