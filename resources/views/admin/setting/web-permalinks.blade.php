<div class="tab-pane fade" id="web-permalinks" role="tabpanel" aria-labelledby="web-permalinks-tab">
    <form id="form-web-permalinks" action="{{ route('settings.update') }}" method="POST" role="form">
        @method('PATCH')
        @csrf
        <input type="hidden" name="web_permalinks">
        <div class="form-group">
            <div class="icheck-primary d-inline">
                <input type="radio" id="postname" name="permalink" value="post_name" {{ $settings->permalink === 'post_name' ? 'checked' : '' }}>
                <label for="postname">
                    Post name
                </label>
                <code>{{ url('/') }}/sample-post</code>
            </div>
        </div>
        <div class="form-group">
            <div class="icheck-primary d-inline">
                <input type="radio" id="dayandname" name="permalink" value="%year%/%month%/%day" {{ $settings->permalink === '%year%/%month%/%day' ? 'checked' : '' }}>
                <label for="dayandname">
                    Day and name
                </label>
                <code>{{ url('/') }}/{{ now()->year }}/{{ now()->month }}/{{ now()->day }}/sample-post</code>
            </div>
        </div>
        <div class="form-group">
            <div class="icheck-primary d-inline">
                <input type="radio" id="monthandname" name="permalink" value="%year%/%month%" {{ $settings->permalink === '%year%/%month%' ? 'checked' : '' }}>
                <label for="monthandname">
                    Month and name
                </label>
                <code>{{ url('/') }}/{{ now()->year }}/{{ now()->month }}/sample-post</code>
            </div>
        </div>
        <div class="form-group">
            <div class="icheck-primary d-inline">
                <input type="radio" id="custom" name="permalink" value="custom" {{ $settings->permalink_type === 'custom' ? 'checked' : '' }}>
                <label for="custom">
                    Custom
                </label>
                <code>{{ url('/') }}/</code>
                @if($settings->permalink_type == 'custom')
                    <input type="text" value="{{ $settings->permalink }}" name="custom_input">
                @else
                    <input type="text" value="{{ Settings::get('permalink_old_custom') }}" name="custom_input">
                @endif

                <code>/sample-post</code>
            </div>
        </div>
        <div class="mt-3">
            <button id="submit-web-permalinks" type="submit" class="btn btn-info float-right">{{ __('Save') }}</button>
        </div>
    </form>
</div>
