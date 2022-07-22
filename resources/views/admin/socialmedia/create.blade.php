<div class="card card-default">
    <form id="insert" action="" method="" role="form">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Facebook" required autofocus>
                <div class="invalid-feedback msg-error-name"></div>
            </div>
            <div class="form-group">
                <label for="url">{{ __('URL') }}</label>
                <input type="text" name="url" class="form-control" id="url" placeholder="https://www.facebook.com">
                <div class="invalid-feedback msg-error-url"></div>
            </div>
            <div class="form-group">
                <label for="icon">{{ __('Icon') }}</label>
                <input type="text" name="icon" class="form-control" id="icon" placeholder="fab fa-facebook">
                <div class="invalid-feedback msg-error-icon"></div>
            </div>
        </div>
        <div class="card-footer">
            <button id="btn-reset" type="button" class="btn btn-warning" hidden>{{ __('Cancel') }}</button>
            <button id="btn-submit" type="submit"
                class="btn btn-info float-right">{{ __('Add New Social Media') }}</button>
        </div>
    </form>
</div>