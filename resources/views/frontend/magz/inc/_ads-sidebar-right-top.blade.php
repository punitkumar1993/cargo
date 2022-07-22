<figure class="ads">
    @if ( Ads::checkAdImage('sidebar-right-top') != 'noimage.png' )
        <a href="{{ Ads::adUrl('sidebar-right-top') }}">
            <img src="{{ Ads::adImage('sidebar-right-top') }}" alt="{{ Ads::AdLabel('sidebar-right-top') }}">
        </a>
    @else
        <a href="#">
            <img src="{{ asset('themes/magz/images/ad.png') }}">
        </a>
    @endif
    <figcaption>{{ Ads::AdLabel('sidebar-right-top') }}</figcaption>
</figure>
@if ( Ads::checkScript('sidebar-right-top') != NULL )
    {!! Ads::checkScript('sidebar-right-top') !!}
@endif