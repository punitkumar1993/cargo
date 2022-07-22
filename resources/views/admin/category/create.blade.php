<div class="card card-default">
    <form id="insert" role="form">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter new category name.." required autofocus><br>
                <div class="invalid-feedback msg-error-name"></div>
				<input type="text" name="meta_title" class="form-control" id="meta_title" placeholder="Meta Title"><br>
				<textarea id="meta_description" name="meta_description" rows="4" cols="50" class="form-control" placeholder="Meta Description"> </textarea>
            </div>
        </div>
        <div class="card-footer">
            <button id="btn-reset" type="button" class="btn btn-warning" hidden>{{ __('Cancel') }}</button>
            <button id="btn-submit" type="submit" class="btn btn-info float-right">{{ __('Add New Category') }}</button>
        </div>
    </form>
</div>
