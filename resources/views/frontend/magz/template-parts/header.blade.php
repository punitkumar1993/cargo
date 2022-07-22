<style>
header.primary {
    position: relative;
}
.firstbar .brand h2{
    border:3.5px solid #fc624d;
    color: #fc624d;
    padding: 10px;
    font-size: 23px;
}
.firstbar .addBanner{
    margin-top: 11px;
}
.single.first{
    padding-top: 13px!important;
}
</style>
<div class="firstbar">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="brand">
                    <a href="/">
                        <!-- <h2 class="text-uppercase">Cargotrends</h2> -->
                        @empty(Settings::get('logowebsite'))
                            <img src="{{ asset('themes/magz/images/logo.png') }}" alt="Web Logo">
                        @else
                            <img src="{{ route('logo.display', Settings::get('logowebsite')) }}" alt=" Web Logo">
                        @endempty
                    </a>
                </div>
            </div>
			<div class="col-md-8 col-sm-12 text-right mt-12">
				@if ( Ads::checkActive('home-horizontal') == 'y' )
					@if ( Ads::checkAdImage('home-horizontal') != 'noimage.png' )
						<!-- Ads | Cargo Trends Asynchronous JS Tag - Generated with Revive Adserver v5.3.1 -->
						<ins data-revive-zoneid="2" data-revive-id="cfb48990f17675aafc705b338c0eca32"></ins>
						<script async src="//ads.cargotrends.in/www/delivery/asyncjs.php"></script>
					@else
						<a href="#">
							<img class="addBanner"
								 src="https://1.bp.blogspot.com/-QdJyXgC2pls/WP0LCv_IlYI/AAAAAAAAEHk/NpuyIFZOYzgG1_H90fWEuIZpOWG7KGxKACLcB/s1600/header-ad.jpg"
								 class="img-responsive">
						</a>
					@endif
					@if ( Ads::checkScript('home-horizontal') != NULL )
						{!! Ads::checkScript('home-horizontal') !!}
					@endif
				@endif
			</div>
        </div>
    </div>
</div>

<!-- Start nav -->
@include('frontend.magz.inc._menu-nav')
<!-- End nav -->
