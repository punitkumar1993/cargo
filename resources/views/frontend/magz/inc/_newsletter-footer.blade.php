<h1 class="block-title">{{ __('Newsletter') }}</h1>
<div class="block-body">
    <p>{{ __('By subscribing you will receive new articles in your email.') }}</p>
    <form class="newsletter">
        <div class="input-group">
            <div class="input-group-addon">
                <i class="ion-ios-email-outline"></i>
            </div>
            <input type="email" name="email" class="form-control email" placeholder="{{ __('Your mail') }}">
        </div>
        <button type="submit" class="btn btn-primary btn-block white">{{ __('Subscribe') }}</button>
    </form>
</div>