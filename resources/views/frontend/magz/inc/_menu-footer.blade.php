<div class="block-body no-margin">
    @if(Appearance::getMenuFooter())
        <ul class="footer-nav-horizontal">
            @foreach(Appearance::getMenuFooter() as $menu)
                <li><a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a></li>
            @endforeach
        </ul>
    @endif
</div>
