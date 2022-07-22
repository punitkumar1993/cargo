@extends('frontend.magz.index')

@section('content')
    <style>
        .view-all-badge a:hover{
            color: #fff !important;
        }
        .view-all-badge{
            margin-top: -10px;padding: 11px 28px;font-size: 15px;background: #fb6e4c;
            border-radius: 0;
        }
        .skin-orange a.border-square {
            border: 1px solid #FC624D;
            padding: 7px 11px;
            display: block;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
<section class="home">
    <div class="container">

    @if ( Ads::checkActive('home-popup') == 'y' )
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <aside id="sponsored">

                                <div class="aside-body">
                                    <figure class="ads">
                                        @if ( Ads::checkAdImage('home-popup') != 'noimage.png' )
                                            <a href="{{ Ads::adUrl('home-popup') }}">
                                                <img src="{{ Ads::adImage('home-popup') }}"
                                                     alt="{{ Ads::AdLabel('home-popup') }}">
                                            </a>
                                        @else
                                            <a href="#">
                                                <img src="{{ asset('themes/magz/images/ad.png') }}">
                                            </a>
                                        @endif
                                    </figure>
                                    @if ( Ads::checkScript('home-popup') != NULL )
                                        {!! Ads::checkScript('home-popup') !!}
                                    @endif
                                </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12">
                @include('frontend.magz.inc._headline')
                @include('frontend.magz.inc._featured-carousel')
				@include('frontend.magz.inc._ads-after-main-slider')
                @include('frontend.magz.inc._ads-before-latest-news')
                <?php
                $latestNews = Posts::recentPosts()->limit(4)->get();
                $firstFourNews = $latestNews->pluck('id')->toArray();
                ?>
                <div class="line">
                    <div>{{ __('Latest News') }}</div>
                </div>
                @include('frontend.magz.inc._latest-news-home', ['latestNews' =>$latestNews])
                @include('frontend.magz.inc._ads-home-center')
                <?php
                $latestNews2 = Posts::recentPosts()->whereNotIn('id', $firstFourNews)->limit(4)->get();
                $secondFourNews = $latestNews2->pluck('id')->toArray();
                ?>
                @include('frontend.magz.inc._latest-news-home', ['latestNews' =>$latestNews2])
                
                @include('frontend.magz.inc._ads-before-more-news')

                <div class="line">
                    <div>{{ __('More News') }}</div>
                </div>
                <?php
                    $moreNews2 = Posts::recentPosts()->whereNotIn('id', $firstFourNews)->whereNotIn('id', $secondFourNews)->limit(4)->get();
                ?>
                @include('frontend.magz.inc._more_news_section', ['moreNews2' =>$moreNews2])
                
                @include('frontend.magz.inc._ads-before-top-categories')


                <div class="line">
                    <div>{{ __('Top Categories ') }}</div>
                </div>

                <div class="row">
                @foreach(App\Models\Term::getCategoried()->pluck('name','slug') as $i => $val)
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <a href="{!! route('category.show',$i) !!}" class="border-square">{!! $val !!}</a>
                    </div>
                @endforeach
                </div>

                <div class="row">
                    <div class="col-md-12">
                    <div class="col-md-12" style="text-align: center">
                        <div class="badge view-all-badge" ><a style="color: #fff;" href="{{ route('news.show') }}">View All</a></div>
                    </div>
                    </div>
                </div>

                @include('frontend.magz.inc._ads-home-bottom')
                @include('frontend.magz.inc._ads-before-trending-section')

                <div class="line transparent little"></div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 trending-tags">
                        @include('frontend.magz.inc._trending-tags')
                    </div>
                    <div class="col-md-6 col-sm-6">
                       @include('frontend.magz.inc._hot-news')
                    </div>
                </div>
               <!--  @include('frontend.magz.inc._just-another-news') -->
            </div>

            <div class="col-xs-6 col-md-4 sidebar" id="sidebar">
                @include('frontend.magz.template-parts.sidebar-right')
            </div>
        </div>
    </div>
</section>

@include('frontend.magz.inc._best-of-the-week')

@endsection
