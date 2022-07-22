@inject('menuItemHelper', \JeroenNoten\LaravelAdminLte\Helpers\MenuItemHelper)

@if ($menuItemHelper->isHeader($item))

    {{-- Header --}}
    @if(\Illuminate\Support\Facades\Auth::user()->username !== 'magazine-user')
    <li @if(isset($item['id'])) id="{{ $item['id'] }}" @endif class="nav-header">
        {{ is_string($item) ? $item : $item['header'] }}
    </li>
    @endif

@elseif ($menuItemHelper->isLegacySearch($item))

    {{-- Search form --}}
    @include('adminlte::partials.sidebar.menu-item-search-form')

@elseif ($menuItemHelper->isSubmenu($item))

    {{-- Treeview menu --}}
    @include('adminlte::partials.sidebar.menu-item-treeview-menu')

@elseif ($menuItemHelper->isLink($item))
    @if(\Illuminate\Support\Facades\Auth::user()->username !== 'magazine-user' || $item['text'] == 'Magazines')
    {{-- Link --}}
    @include('adminlte::partials.sidebar.menu-item-link')
    @endif

@endif
