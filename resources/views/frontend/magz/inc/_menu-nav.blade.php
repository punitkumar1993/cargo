<style>
    a.twitter {
        background-color: #007bb6;
    }
</style>
<nav class="menu">
    <div class="container">
        <div class="brand">
            <a href="/">
                @empty(Settings::get('logowebsite'))
                    <img src="{{ asset('themes/magz/images/logo.png') }}" alt="Web Logo">
                @else
                    <img src="{{ route('logo.display', Settings::get('logowebsite')) }}" alt=" Web Logo">
                @endempty
            </a>
        </div>
        <div class="mobile-toggle">
            <a href="#" data-toggle="menu" data-target="#menu-list"><i class="ion-navicon-round"></i></a>
        </div>
        <div class="mobile-toggle">
            <a href="#" data-toggle="sidebar" data-target="#sidebar"><i class="ion-ios-arrow-left"></i></a>
        </div>
        
        <div id="menu-list" style=" display: flex;justify-content: space-between;align-items: baseline;">
            @if(Appearance::getMenuHeader())
                <ul class="nav-list" style=" margin: 0 1px;">
                    @foreach(Appearance::getMenuHeader() as $menu)
                        <li class="@if($menu['child'])dropdown magz-dropdown @endif">
                            <a class="@if($menu['child'])dropdown-toggle @endif" href="{{ url($menu['link']) }}" title="">{{ $menu['label'] }} @if($menu['child'])<i class="fas fa-caret-down"></i>@endif</a>
                            @if( $menu['child'] )
                                @include('frontend.magz.inc._menu-nav-child',['childs'=>$menu['child']])
                            @endif
                        </li>
                    @endforeach
                </ul>
            <div style="align-self: flex-start;">
                @include('frontend.magz.inc._search-form')

            </div>

            @endif
        </div>
    </div>
</nav>
