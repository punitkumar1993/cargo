<div class="card card-default">
    <form id="insert" role="form">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter new tag name.." required autofocus>
                <div class="invalid-feedback msg-error-name"></div>
            </div>
        </div>
        <div class="card-footer">
            <button id="btn-reset" type="button" class="btn btn-warning" hidden>{{ __('Cancel') }}</button>
            <button id="btn-submit" type="submit" class="btn btn-info float-right">{{ __('Add New Tag') }}</button>
        </div>
    </form>
</div>