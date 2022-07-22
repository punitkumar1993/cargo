<div class="card card-default">
    <form action="{{ route('galleries.store') }}" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputFile">{{ __('File input') }}</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="file"
                            class="custom-file-input{{ $errors->has('file') ? ' is-invalid' : '' }}" id="inputFile">
                        <label class="custom-file-label" for="exampleInputFile">{{ __('Choose file') }}</label>
                    </div>
                    <div class="input-group-append">
                        <button type="submit" class="input-group-text">{{ __('Upload') }}</button>
                    </div>
                    @if($errors->has('file'))
                    <div class="msg-error-file invalid-feedback">
                        {{ $errors->first('file') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>