<div class="tab-pane text-left fade show active" id="web-information" role="tabpanel" aria-labelledby="web-information-tab">
    <form id="form-web-information" action="" method="POST" role="form">
        @method('PATCH')
        @csrf
        <input type="hidden" name="web_information">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="company_name">{{ __('Company Name') }}</label>
                    <input id="company_name" type="text" name="company_name" class="form-control" placeholder="{{ __('Company Name') }}" value="{{ $settings->company_name }}">
                    <div class="msg-company_name"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="sitename">{{ __('Website name') }}</label>
                    <input id="sitename" type="text" name="sitename" class="form-control" placeholder="{{ __('Website Name') }}" value="{{ $settings->sitename }}">
                    <div class="msg-sitename"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="siteurl">{{ __('Website URl') }}</label>
                    <input id="siteurl" type="text" name="siteurl" class="form-control" placeholder="{{ __('Website URL') }}" value="{{ $settings->siteurl }}">
                    <div class="msg-siteurl"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="sitedescription">{{ __('Site description') }}</label>
                    <textarea id="sitedescription" name="sitedescription" class="form-control" rows="3" placeholder="{{ __('Site description') }}..">{{ $settings->sitedescription}}</textarea>
                    <div class="msg-sitedescription"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="metakeyword">{{ __('Meta keyword') }}</label>
                    <textarea id="metakeyword" name="metakeyword" class="form-control" rows="3" placeholder="{{ __('Site meta keyword') }}">{{ $settings->metakeyword}}</textarea>
                    <div class="msg-metakeyword"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="creadit_footer">{{ __('Credit Footer') }}</label>
                    <textarea class="form-control" name="credit_footer" id="credit_footer" rows="3">{{ $credit_footer }}</textarea>
                    <div class="msg-company_name"></div>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <button id="submit-web-properties" type="submit" class="btn btn-info float-right">{{ __('Save') }}</button>
        </div>
    </form>
</div>
