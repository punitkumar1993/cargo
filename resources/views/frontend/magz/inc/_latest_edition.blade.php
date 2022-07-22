<aside>
    @if ( \App\Helpers\LatestEdition::checkActive() == 'y' )
        <h1 class="aside-title" style="font-size: 14px;font-weight: normal;text-transform: inherit;">{{ \App\Helpers\LatestEdition::editionLabel() }}</h1>
        <div class="aside-body">
            <figure class="ads">
                @if ( \App\Helpers\LatestEdition::checkEditionImage() != 'noimage.png' )
                    <a href="{{ \App\Helpers\LatestEdition::editionUrl() }}">
                        <img src="{{ \App\Helpers\LatestEdition::editionImage() }}"
                             alt="{{ \App\Helpers\LatestEdition::editionLabel() }}">
                    </a>
                @else
                    <a href="#">
                        <img src="{{ asset('themes/magz/images/ad.png') }}">
                    </a>
                @endif
            </figure>
        </div>
    @endif
</aside>