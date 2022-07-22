<style>
    .menu a.dropdown-item {
        display: block;
        width: 100%;
        padding: .25rem 1.5rem;
        clear: both;
        font-weight: 500;
        color: #212529;
        text-align: inherit;
        white-space: nowrap;
        background-color: transparent;
        border: 0;
    }

</style>
<div class="dropdown-menu" style="display: block;">
    @foreach($childs as $menu)
        @if($menu['label'] == 'Media Kit' || $menu['label'] == 'Latest Edition')
            <a class="dropdown-item" href="{{ url($menu['link']) }}" title="">{{ $menu['label'] }} </a>
        @elseif($menu['link'] == 'all')
            <a class="dropdown-item" href="{{ route('news.show') }}" title="">{{ $menu['label'] }} </a>
        @else
            <a class="dropdown-item" href="{{ url('category/'.$menu['link']) }}" title="">{{ $menu['label'] }} </a>
        @endif

        @endforeach
</div>
