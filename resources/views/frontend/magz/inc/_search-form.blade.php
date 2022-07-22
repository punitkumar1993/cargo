<form action="{{ route('search') }}" method="GET" class="search" autocomplete="off" style="display: flex;align-items: baseline;justify-content: space-between;">
    <div class="form-group search_form">
        <div class="input-group">
            <input type="text" name="q" class="form-control search_input" placeholder="Search" style="">
            <div class="input-group-btn">
                <button type="submit" class="btn btn-primary"><i class="ion-search"></i></button>
            </div>
        </div>
    </div>
    <ul class="social trp" style="margin-left: 5px;    margin-top: 5px;">
        <li>
            <a href="https://www.twitter.com/{{ Settings::get('twitter') }}" class="twitter" style="padding: 5px;    margin-bottom: 0px;">
                <svg>
                    <rect width="0" height="0"></rect></svg>
                <i class="ion-social-twitter-outline"></i>
            </a>
        </li>
        <li>
            <a href="https://www.linkedin.com/{{ Settings::get('linkedin') }}" class="linkedin" style="margin-right: 0px; padding: 5px;    margin-bottom: 0px;">
                <svg>
                    <rect width="0" height="0"></rect></svg>
                <i class="ion-social-linkedin-outline"></i>
            </a>
        </li>
    </ul>
</form>
