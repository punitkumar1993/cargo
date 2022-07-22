<form class="newsletter">
    <div class="icon">
        <i class="ion-ios-email-outline"></i>
        <h1>{{ __('Newsletter') }}</h1>
    </div>
    <div class="input-group">
        <input type="email" name="email" class="form-control email" placeholder="{{ __('Your mail') }}">
        <div class="input-group-btn">
            <button class="btn btn-primary"><i class="ion-paper-airplane"></i></button>
        </div>
    </div>
    <p>{{ __('By subscribing you will receive new articles in your email.') }}</p>
</form>