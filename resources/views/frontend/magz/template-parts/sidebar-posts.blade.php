@if ( Ads::checkActive('sidebar-right-top') == 'y' )
<aside>
    <div class="aside-body">
        @include('frontend.magz.inc._ads-sidebar-right-top')
    </div>
</aside>
@endif
<aside>
    @include('frontend.magz.inc._recent-post-sidebar')
</aside>
<aside>
    <div class="aside-body">
        @include('frontend.magz.inc._newsletter')
    </div>
</aside>