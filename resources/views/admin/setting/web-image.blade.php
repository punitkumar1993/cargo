<div class="tab-pane fade" id="web-image" role="tabpanel" aria-labelledby="web-image-tab">
    <form action="{{ route('settings.update') }}" method="POST" role="form"
          enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <input type="hidden" name="site_logo">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">{{ __('Logo Website (Header)') }}</label><br>
                    @empty($settings->logowebsite)
                        <img src="{{ asset('themes/magz/images/logo.png') }}" alt="" class="border mb-3 w-100">
                    @else
                        <img src="{{  route('logo.display', $settings->logowebsite) }}" alt="" class="border mb-3 w-100">
                    @endempty
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="logowebsite" class="custom-file-input" value="{{ $settings->logowebsite }}">
                            <label class="custom-file-label">{{ __('Choose file') }}</label>
                        </div>
                    </div>
                    <p>
                        <small>
                            {{ __('Browse file File format must be in the format jpg, jpeg, png,
                            and the size 762x242') }}<br>
                        </small>
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">{{ __('Logo Website (Footer)') }}</label><br>
                    @empty($settings->logowebsite_footer)
                        <img src="{{ asset('themes/magz/images/logo-light.png') }}" alt="" class="border mb-3 w-100">
                    @else
                        <img src="{{  route('logo.display', $settings->logowebsite_footer) }}" alt="" class="border mb-3 w-100">
                    @endempty
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="logowebsite_footer" class="custom-file-input" value="{{ $settings->logowebsite_footer }}">
                            <label class="custom-file-label">{{ __('Choose file') }}</label>
                        </div>
                    </div>
                    <p>
                        <small>
                            {{ __('Browse file File format must be in the format jpg, jpeg, png,
                            and the size 762x242') }}<br>
                        </small>
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">{{ __('Favicon') }}</label><br>
                    @empty($settings->favicon)
                        <img src="{{ asset('favicons/favicon-96x96.png') }}" alt="" class="border mb-3">
                    @else
                        <img src="{{  route('icon.display', $settings->favicon) }}" alt="{{ $settings->favicon }}" class="border mb-3">
                    @endempty
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="favicon" class="custom-file-input" value="{{ $settings->favicon }}" accept="image/x-png,image/jpeg, image/x-icon">
                            <label class="custom-file-label">{{ __('Choose file') }}</label>
                        </div>
                    </div>
                    <p>
                        <small>
                            {{ __('Browse file
                            File format must be in the format jpg, jpeg, ico ,png and the
                            max size 256x256px.') }}
                        </small>
                    </p>
                </div>
            </div>
            {{--<div class="col-lg-6">
                <div class="form-group">
                    <label for="">{{ __('Open Graph Image') }}</label><br>
                    @empty($settings->ogimage)
                        <img src="{{ asset('img/cover.png') }}" alt=""
                             class="border mb-3 w-100">
                    @else
                        <img src="{{  route('ogi.display', $settings->ogimage) }}" alt="" class="border mb-3 w-100">
                    @endempty
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="ogimage" class="custom-file-input" value="{{ $settings->ogimage }}">
                            <label class="custom-file-label">{{ __('Choose file') }}</label>
                        </div>
                    </div>
                    <p>
                        <small>
                            {{ __('Browse file File format must be in the format jpg, jpeg, png,
                            and the max size 1484x1200px') }}<br>
                        </small>
                    </p>
                </div>
            </div>--}}
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-info float-right">{{ __('Save') }}</button>
        </div>
    </form>
</div>
