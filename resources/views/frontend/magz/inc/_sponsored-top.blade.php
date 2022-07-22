<aside id="sponsored">
    @if ( Ads::checkActive('sidebar-right-top') == 'y' )
        <h1 class="aside-title">{{ Ads::adLabel('sidebar-right-top') }}</h1>
        <div class="aside-body">
            <figure class="ads">
                @if ( Ads::checkAdImage('sidebar-right-top') != 'noimage.png' )
                    <a href="{{ Ads::adUrl('sidebar-right-top') }}">
                        <img src="{{ Ads::adImage('sidebar-right-top') }}"
                             alt="{{ Ads::AdLabel('sidebar-right-top') }}">
                    </a>
                @else
                    <a href="#">
                        <img src="{{ asset('themes/magz/images/ad.png') }}">
                    </a>
                @endif
            </figure>
            @if ( Ads::checkScript('sidebar-right-top') != NULL )
                {!! Ads::checkScript('sidebar-right-top') !!}
            @endif
        </div>
    @endif
</aside>