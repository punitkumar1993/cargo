<div class="sidebar-title for-tablet">{{ __('Sidebar') }}</div>
@include('frontend.magz.inc._sponsored-top') 
@include('frontend.magz.inc._popular-sidebar') 
@if(Route::current()->getName() == "event.show" || Route::current()->getName() == "events.show")
@include('frontend.magz.inc._event-calender')
@endif
@include('frontend.magz.inc._latest_edition')
@include('frontend.magz.inc._sponsored-video')
@include('frontend.magz.inc._sponsored-second-top')
@include('frontend.magz.inc._sponsored-middle')

<aside>
    <div class="aside-body">
        @include('frontend.magz.inc._newsletter')
    </div>
</aside>
@include('frontend.magz.inc._sponsored-second-middle')
@include('frontend.magz.inc._sponsored-bottom')
@include('frontend.magz.inc._sponsored-second-bottom')
@include('frontend.magz.inc._recomended')
@if(Route::current()->getName() != "event.show" && Route::current()->getName() != "events.show")
@include('frontend.magz.inc._event-calender')
@endif
