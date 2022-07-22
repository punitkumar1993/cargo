<div class="tab-pane fade" id="newsletters" role="tabpanel" aria-labelledby="newsletters-tab">
    <form id="form-newsletters" action="{{ route('settings.update') }}" method="POST" role="form">
        @method('PATCH')
        @csrf
        <input type="hidden" name="newsletters">
        <input type="hidden" name="newsletter_status" value="false">
        <div class="form-group">
            <div class="icheck-primary d-inline">
                <input type="checkbox" id="check_newsletter" name="newsletter_status" value="true" {{ $settings->newsletter_status == "true" ? 'checked' : '' }}>
                <label for="check_newsletter">
                    Click to send newsletter
                </label>
            </div>
        </div>
        <div class="mt-3">
            <button id="submit-newsletters" type="submit" class="btn btn-info float-right">{{ __('Save') }}</button>
        </div>
    </form>
</div>
