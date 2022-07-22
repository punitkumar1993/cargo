<aside id="sponsored">
    @if ( Ads::checkActive('sidebar-right-middle') == 'y' )
        <h1 class="aside-title">{{ Ads::adLabel('sidebar-right-middle') }}</h1>
        <div class="aside-body">
            <figure class="ads">
                @if ( Ads::checkAdImage('sidebar-right-middle') != 'noimage.png' )
                    <a href="{{ Ads::adUrl('sidebar-right-middle') }}">
                        <img src="{{ Ads::adImage('sidebar-right-middle') }}"
                             alt="{{ Ads::AdLabel('sidebar-right-middle') }}">
                    </a>
                @else
                    <a href="#">
                        <img src="{{ asset('themes/magz/images/ad.png') }}">
                    </a>
                @endif
            </figure>
            @if ( Ads::checkScript('sidebar-right-middle') != NULL )
                {!! Ads::checkScript('sidebar-right-middle') !!}
            @endif
        </div>
    @endif
</aside>