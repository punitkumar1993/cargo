<aside id="sponsored">
    @if ( Ads::checkActive('sidebar-right-second-middle') == 'y' )
        <h1 class="aside-title">{{ Ads::adLabel('sidebar-right-second-middle') }}</h1>
        <div class="aside-body">
            <figure class="ads">
                @if ( Ads::checkAdImage('sidebar-right-second-middle') != 'noimage.png' )
                    <a href="{{ Ads::adUrl('sidebar-right-second-middle') }}">
                        <img src="{{ Ads::adImage('sidebar-right-second-middle') }}"
                             alt="{{ Ads::AdLabel('sidebar-right-second-middle') }}">
                    </a>
                @else
                    <a href="#">
                        <img src="{{ asset('themes/magz/images/ad.png') }}">
                    </a>
                @endif
            </figure>
            @if ( Ads::checkScript('sidebar-right-second-middle') != NULL )
                {!! Ads::checkScript('sidebar-right-second-middle') !!}
            @endif
        </div>
    @endif
</aside>