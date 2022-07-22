<h1 class="block-title">{{ __('Follow Us') }}</h1>
<div class="block-body">
    <p>{{ __('Follow us and stay in touch to get the latest news') }}</p>
    <ul class="social trp">
        {{--<li>
            <a href="https://www.facebook.com/{{ Settings::get('facebook') }}" class="facebook">
                <svg>
                    <rect width="0" height="0" /></svg>
                <i class="ion-social-facebook"></i>
            </a>
        </li>--}}
        <li>
            <a href="https://www.twitter.com/{{ Settings::get('twitter') }}" class="twitter">
                <svg>
                    <rect width="0" height="0" /></svg>
                <i class="ion-social-twitter-outline"></i>
            </a>
        </li>
        <li>
            <a href="https://www.linkedin.com/{{ Settings::get('linkedin') }}" class="linkedin">
                <svg>
                    <rect width="0" height="0" /></svg>
                <i class="ion-social-linkedin-outline"></i>
            </a>
        </li>
        
        <li>
            <a href="mailto:info@cargotrends.in" class="linkedin">
                <svg>
                    <rect width="0" height="0" /></svg>
                <i class="ion-email"></i>
            </a>
        </li>

        <!-- <li>
            <a href="https://www.instagram.com/{{ Settings::get('instagram') }}" class="instagram">
                <svg>
                    <rect width="0" height="0" /></svg>
                <i class="ion-social-instagram-outline"></i>
            </a>
        </li> -->
    </ul>
</div>