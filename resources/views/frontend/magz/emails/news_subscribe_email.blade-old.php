<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
	html, body, div {
		font-family: 'Lora', serif !important;
	}
	
    #lab_social_icon_footer {
        padding: 40px 0;
        background-color: #dedede;
    }

    #lab_social_icon_footer a {
        color: #333;
    }

    #lab_social_icon_footer .social:hover {
        -webkit-transform: scale(1.1);
        -moz-transform: scale(1.1);
        -o-transform: scale(1.1);
    }

    #lab_social_icon_footer .social {
        -webkit-transform: scale(0.8);
        /* Browser Variations: */

        -moz-transform: scale(0.8);
        -o-transform: scale(0.8);
        -webkit-transition-duration: 0.5s;
        -moz-transition-duration: 0.5s;
        -o-transition-duration: 0.5s;
    }
    /*
        Multicoloured Hover Variations
    */

    #lab_social_icon_footer #social-fb:hover {
        color: #3B5998;
    }

    #lab_social_icon_footer #social-tw:hover {
        color: #4099FF;
    }

    #lab_social_icon_footer #social-gp:hover {
        color: #d34836;
    }

    #lab_social_icon_footer #social-em:hover {
        color: #f39c12;
    }
	
	body {
		background: #e4f0ff !important;
	}
</style>

<div style="width:650px;margin: 0px auto;border: 2px solid #0053B6;padding: 10px;background: white;-webkit-box-shadow: 0px 0px 107px -33px rgba(0,5,59,1);-moz-box-shadow: 0px 0px 107px -33px rgba(0,5,59,1);box-shadow: 0px 0px 107px -33px rgba(0,5,59,1);border-bottom-right-radius: 40px;border-bottom-left-radius: 40px;">
    <div style="background-color: #0053B6; padding: 10px 10px 10px 10px; text-align:center;">
		<div style="margin-bottom:20px; color:white; text-align:right; font-size: 13px;">
			<span><a style="color:white" target="_blank" href="https://www.cargotrends.in">www.cargotrends.in</a></span>
		</div>
        @empty(Settings::get('logowebsite'))
            <img src="{{ asset('themes/magz/images/logo.png') }}" style="width: 250px;" alt="Web Logo">
        @else
            <img src="{{ route('logo.display', Settings::get('logowebsite')) }}" style="width: 250px;" alt="Web Logo">
        @endempty
		
		<div style="margin-top:20px; color:white; text-align:center; font-size: 13px;">
			<span>Thrice a week Newsletter (Monday, Wednesday &amp; Friday)</span>
		</div>
    </div>
    <div style="margin-bottom: 20px; text-align: center;">
        <hr>
       @if ( Ads::checkActive('newsletter-top') == 'y' )
            @if ( Ads::checkAdImage('newsletter-top') != 'noimage.png' )
                <a href="{{ Ads::adUrl('home-horizontal') }}">
                    <img style="width: 100%;" class="addBanner" src="{{ Ads::adImage('home-horizontal') }}" alt="{{ Ads::AdLabel('home-horizontal') }}">
                </a>
            @else
                <a href="#">
                    <img class="addBanner" src="" class="img-responsive">
                </a>
             @endif
       @endif
        <hr>
    </div>

      @foreach($posts1 as $value)
      <div style="margin-bottom: 20px;">
        <div style="float: left;width: 200px;">
           <img src="{{ Posts::getImage($value['post_content'], $value['post_image']) }}" alt="{{ $value['post_image'] }}" alt="{{ $value['post_image'] }}" class="img-fluid" style="width:200px;max-height: 220px;object-fit: cover;border-left: 7px #d3040c solid;">
        </div>
        <div style="float: left;width: 430px;margin-left: 20px;">
          <a href="#" style="text-decoration: none;"><h3 style="color: #000;font-size: 16px;margin-top: 0;margin-bottom: 0;">{{$value['post_title']}}</h3></a>
          <p style="margin: 0 0 10px 0;font-size: 14px;"> {!! \Str::limit(strip_tags($value['post_content']), 100) !!}</p>
          <a href="{{ url('news/'.$value['post_name']) }}" class="btn-btn-primary" style="color: white;border:1px solid #0053B6;padding: 4px 8px;text-decoration: none;background: #0053B6;font-size: 14px;">More...</a>
        </div>
      </div>
      <div style="clear: both;"></div>
      <br />
    @endforeach
    <div style="margin-bottom: 20px;text-align: center;">
        <hr>
       @if ( Ads::checkActive('newsletter-middle') == 'y' )
            @if ( Ads::checkAdImage('newsletter-middle') != 'noimage.png' )
                <a href="{{ Ads::adUrl('newsletter-middle') }}">
                    <img style="width: 100%;" class="addBanner" src="{{ Ads::adImage('newsletter-middle') }}" alt="{{ Ads::AdLabel('newsletter-middle') }}">
                </a>
            @else
                <a href="#">
                    <img class="addBanner" src="https://1.bp.blogspot.com/-QdJyXgC2pls/WP0LCv_IlYI/AAAAAAAAEHk/NpuyIFZOYzgG1_H90fWEuIZpOWG7KGxKACLcB/s1600/header-ad.jpg" class="img-responsive">
                </a>
             @endif
       @endif
        <hr>
    </div>
    @foreach($posts2 as $value)
        <div style="margin-bottom: 20px;">
            <div style="float: left;width: 200px;">
                <img src="{{ Posts::getImage($value['post_content'], $value['post_image']) }}" alt="{{ $value['post_image'] }}" alt="{{ $value['post_image'] }}" class="img-fluid" style="width:200px;max-height: 220px;object-fit: cover;border-left: 7px #d3040c solid;">
            </div>
            <div style="float: left;width: 430px;margin-left: 20px;">
                <a href="#" style="text-decoration: none;"><h3 style="color: #000;font-size: 16px;margin-top: 0;margin-bottom: 0;">{{$value['post_title']}}</h3></a>
                <p style="margin: 0 0 10px 0;font-size: 14px;"> {!! \Str::limit(strip_tags($value['post_content']), 100) !!}</p>
                <a href="{{ url('news/'.$value['post_name']) }}" class="btn-btn-primary" style="color: white;border:1px solid #0053B6;padding: 4px 8px;text-decoration: none;background: #0053B6;font-size: 14px;">More...</a>
            </div>
        </div>
        <div style="clear: both;"></div>
        <br />
    @endforeach
    <div style="margin-bottom: 20px;text-align: center;">
        <hr>
        @if ( Ads::checkActive('newsletter-bottom') == 'y' )
            @if ( Ads::checkAdImage('newsletter-bottom') != 'noimage.png' )
                <a href="{{ Ads::adUrl('newsletter-bottom') }}">
                    <img style="width: 100%;" class="addBanner" src="{{ Ads::adImage('newsletter-bottom') }}" alt="{{ Ads::AdLabel('newsletter-bottom') }}">
                </a>
            @else
                <a href="#">
                    <img class="addBanner" src="https://1.bp.blogspot.com/-QdJyXgC2pls/WP0LCv_IlYI/AAAAAAAAEHk/NpuyIFZOYzgG1_H90fWEuIZpOWG7KGxKACLcB/s1600/header-ad.jpg" class="img-responsive">
                </a>
            @endif
        @endif
        <hr>
    </div>
    <section id="lab_social_icon_footer" style="text-align: center;border-bottom-right-radius: 40px;border-bottom-left-radius: 40px; background-color: #dedede; background: #dedede;">
        <!-- Include Font Awesome Stylesheet in Header -->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
		<div style="margin-bottom: 20px;"><span style="margin-right: 20px;"><a target="_blank" href="https://cargotrends.in/events">Events</a></span><span style="margin-right: 20px;"><a target="_blank" href="https://cargotrends.in/magazine/">Magazine</a></span><span><a target="_blank" href="https://cargotrends.in/contact">Contact</a></span></div>
        <div class="container">
            <span>Follow Us:</span>
            <div class="text-center center-block" style="margin-top: 5px;margin-bottom: 10px;">
               {{-- <a href="https://www.facebook.com/">
                    <img src="{{ asset('img/facebook.svg') }}" style="width: 30px;">
                </a>--}}
                <a href="https://www.linkedin.com/{{ Settings::get('linkedin') }}">
                    <img src="{{ asset('img/linkedin.png') }}" style="width: 30px;">
                </a>
                <a href="https://www.twitter.com/{{ Settings::get('twitter') }}">
                    <img src="{{ asset('img/twitter.png') }}" style="width: 30px;">
                </a>
            </div>
        </div>
        <div style="margin-top: 20px;font-size: 15px;">
            Email us to  <a href="mailto:info@cargotrends.in">info@cargotrends.in</a>.
        </div>
        <div style="margin-top: 20px;font-size: 15px;">
            Please <a href="{{ route('unsubscribe.email', $emailId) }}">click here</a> to unsubscribe from the newsletter.
        </div>
		<div style="margin-top: 20px;font-size: 15px;">
            &copy; Copyright 2021. All Rights Reserved.
        </div>
    </section>

  </div>


<!--   <div style="width:845px;margin: 0px auto 0;">
    <div style="margin-bottom: 20px;">
      <img src="http://webappsdemo.tk/cargotrends/image/download-SZeWBc4AVg.jpg" style="width:100%;max-height: 220px;object-fit: cover;">
    </div>
    <div style="margin-bottom: 20px;">
      <div style="float: left;width: 220px;">
        <img src="http://webappsdemo.tk/cargotrends/get/post/image/download-SZeWBc4AVg.jpg" class="img-fluid" style="width:220px;max-height: 220px;object-fit: cover;">
      </div>
      <div style="float: left;width: 600px;margin-left: 20px;">
        <a href="#" style="text-decoration: none;"><h3 style="color: #000;font-size: 20px;margin-top: 0;">Wfs Supports Airbus Foundation Humanitarian Flight To Help Victims Of Beirut Explosion</h3></a>
        <p>The incident on 4 August, in which ammonium nitrate stored at the port of Beirut exploded, caused ov...</p>
        <a href="#" class="btn-btn-primary" style="color: #0053B6;border:1px solid #0053B6;padding: 6px 10px;text-decoration: none;">More...</a>
      </div>
    </div>
    <div style="clear: both;"></div>
    <div style="margin-top: 20px;margin-bottom: 20px;">
      <div style="float: left;width: 220px;">
        <img src="http://webappsdemo.tk/cargotrends/get/post/image/download-SZeWBc4AVg.jpg" class="img-fluid" style="width:220px;max-height: 220px;object-fit: cover;">
      </div>
      <div style="float: left;width: 600px;margin-left: 20px;">
        <a href="#" style="text-decoration: none;"><h3 style="color: #000;font-size: 20px;margin-top: 0;">Wfs Supports Airbus Foundation Humanitarian Flight To Help Victims Of Beirut Explosion</h3></a>
        <p>The incident on 4 August, in which ammonium nitrate stored at the port of Beirut exploded, caused ov...</p>
        <a href="#" class="btn-btn-primary" style="color: #0053B6;border:1px solid #0053B6;padding: 6px 10px;text-decoration: none;">More...</a>
      </div>
    </div>
    <div style="clear: both;"></div>
    <div style="margin-top: 20px;margin-bottom: 20px;">
      <div style="float: left;width: 220px;">
        <img src="http://webappsdemo.tk/cargotrends/get/post/image/download-SZeWBc4AVg.jpg" class="img-fluid" style="width:220px;max-height: 220px;object-fit: cover;">
      </div>
      <div style="float: left;width: 600px;margin-left: 20px;margin-bottom: 40px">
        <a href="#" style="text-decoration: none;"><h3 style="color: #000;font-size: 20px;margin-top: 0;">Wfs Supports Airbus Foundation Humanitarian Flight To Help Victims Of Beirut Explosion</h3></a>
        <p>The incident on 4 August, in which ammonium nitrate stored at the port of Beirut exploded, caused ov...</p>
        <a href="#" class="btn-btn-primary" style="color: #0053B6;border:1px solid #0053B6;padding: 6px 10px;text-decoration: none;">More...</a>
      </div>
    </div>
  </div>


  <div style="width:845px;margin: 0px auto 0;">
    <div style="margin-bottom: 20px;">
      <img src="http://webappsdemo.tk/cargotrends/image/download-SZeWBc4AVg.jpg" style="width:100%;max-height: 220px;object-fit: cover;">
    </div>
    <div style="margin-bottom: 20px;">
      <div style="float: left;width: 220px;">
        <img src="http://webappsdemo.tk/cargotrends/get/post/image/download-SZeWBc4AVg.jpg" class="img-fluid" style="width:220px;max-height: 220px;object-fit: cover;">
      </div>
      <div style="float: left;width: 600px;margin-left: 20px;">
        <a href="#" style="text-decoration: none;"><h3 style="color: #000;font-size: 20px;margin-top: 0;">Wfs Supports Airbus Foundation Humanitarian Flight To Help Victims Of Beirut Explosion</h3></a>
        <p>The incident on 4 August, in which ammonium nitrate stored at the port of Beirut exploded, caused ov...</p>
        <a href="#" class="btn-btn-primary" style="color: #0053B6;border:1px solid #0053B6;padding: 6px 10px;text-decoration: none;">More...</a>
      </div>
    </div>
    <div style="clear: both;"></div>
    <div style="margin-top: 20px;margin-bottom: 20px;">
      <div style="float: left;width: 220px;">
        <img src="http://webappsdemo.tk/cargotrends/get/post/image/download-SZeWBc4AVg.jpg" class="img-fluid" style="width:220px;max-height: 220px;object-fit: cover;">
      </div>
      <div style="float: left;width: 600px;margin-left: 20px;">
        <a href="#" style="text-decoration: none;"><h3 style="color: #000;font-size: 20px;margin-top: 0;">Wfs Supports Airbus Foundation Humanitarian Flight To Help Victims Of Beirut Explosion</h3></a>
        <p>The incident on 4 August, in which ammonium nitrate stored at the port of Beirut exploded, caused ov...</p>
        <a href="#" class="btn-btn-primary" style="color: #0053B6;border:1px solid #0053B6;padding: 6px 10px;text-decoration: none;">More...</a>
      </div>
    </div>
    <div style="clear: both;"></div>
    <div style="margin-top: 20px;margin-bottom: 20px;">
      <div style="float: left;width: 220px;">
        <img src="http://webappsdemo.tk/cargotrends/get/post/image/download-SZeWBc4AVg.jpg" class="img-fluid" style="width:220px;max-height: 220px;object-fit: cover;">
      </div>
      <div style="float: left;width: 600px;margin-left: 20px;margin-bottom: 40px">
        <a href="#" style="text-decoration: none;"><h3 style="color: #000;font-size: 20px;margin-top: 0;">Wfs Supports Airbus Foundation Humanitarian Flight To Help Victims Of Beirut Explosion</h3></a>
        <p>The incident on 4 August, in which ammonium nitrate stored at the port of Beirut exploded, caused ov...</p>
        <a href="#" class="btn-btn-primary" style="color: #0053B6;border:1px solid #0053B6;padding: 6px 10px;text-decoration: none;">More...</a>
      </div>
    </div>
  </div> -->