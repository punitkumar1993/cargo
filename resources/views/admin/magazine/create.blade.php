@extends('adminlte::page')

@section('title', 'Add New Magazine')

@section('content_header')
    @head(['linkIndex'=>'Users','currentLinkAdd'=>'Add New','url'=> url('magazines.index')])
    @slot('title')
        {{ __('Add Magazine') }}
    @endslot
    @endhead
    <style>
        .upload-pdf #display, .upload-pdf .buttons #reset{
            display: none;
        }
    </style>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <form id="form" action="{{route('magazines.store')}}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{ __('Magazine Name') }}</label>
                            <div class="input-group">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" >
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">{{ __('Magazine PDF File') }}</label>
                            <div class="input-group">
                                <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file" accept="application/pdf">
                                @error('file')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">{{ __('Magazine Image') }}</label>
                            <div class="input-group">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/png, image/jpg, image/jpeg">
                                @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                               <label for="hightlight_one">{{ __('Highlight One') }}</label>
                                <div class="input-group">
                                    <input id="hightlight_one" type="text" class="form-control @error('hightlight_one') is-invalid @enderror" maxlength="30" name="hightlight_one" >
                                    @error('hightlight_one')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                             </div>
                         </div>
                         <div class="col-md-6">
                            <div class="form-group">
                               <label for="hightlight_two">{{ __('Highlight Two') }}</label>
                                <div class="input-group">
                                    <input id="hightlight_two" type="text" class="form-control @error('hightlight_two') is-invalid @enderror"  maxlength="30" name="hightlight_two" >
                                    @error('hightlight_two')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                         </div>
                    </div>
                            <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hightlight_three">{{ __('Highlight Three') }}</label>
                                    <div class="input-group">
                                        <input id="hightlight_three" type="text" class="form-control @error('hightlight_three') is-invalid @enderror" maxlength="30" name="hightlight_three" >
                                        @error('hightlight_three')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hightlight_four">{{ __('Highlight Four') }}</label>
                                    <div class="input-group">
                                        <input id="hightlight_four" type="text" class="form-control @error('hightlight_four') is-invalid @enderror" maxlength="30" name="hightlight_four" >
                                        @error('hightlight_four')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="hightlight_five">{{ __('Highlight Five') }}</label>
                                <div class="input-group">
                                    <input id="hightlight_five" type="text" class="form-control @error('hightlight_five') is-invalid @enderror" maxlength="30" name="hightlight_five" >
                                    @error('hightlight_five')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="hightlight_six">{{ __('Highlight Six') }}</label>
                                <div class="input-group">
                                    <input id="hightlight_six" type="text" class="form-control @error('hightlight_six') is-invalid @enderror" maxlength="30" name="hightlight_six" >
                                    @error('hightlight_six')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                     {{-- <div class="form-group">
                            <label for="name">{{ __('Description') }}</label>
                            <div class="input-group">
                                <textarea name="description" class="summernote" placeholder="{{ __('Place some text here') }}" style="width: 100%; height: 400px; font-weight:normal"></textarea>
                                @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div> --}}
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Add Magazine') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/pace-progress/themes/blue/pace-theme-minimal.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/summernote-add-text-tags/summernote-add-text-tags.css') }}">
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/bootstrap-show-password/dist/bootstrap-show-password.js') }}"></script>
    <script src="{{ asset('vendor/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('vendor/summernote-image-attributes-editor/summernote-image-attributes.js') }}"></script>
    <script src="{{ asset('vendor/summernote-image-attributes-editor/lang/en-us.js') }}"></script>
    <script src="{{ asset('vendor/summernote-add-text-tags/summernote-add-text-tags.js') }}"></script>
    <script src="{{ asset('vendor/summernote-ext-highlight/summernote-ext-highlight.js') }}"></script>
    @include('layouts.partials._script')
    <script>
        $(document).ready(function() {
           $('.summernote').summernote({
               placeholder: 'Description..',
               height: 300,
           });
         });
    </script>
@stop

@section('footer')
    @include('layouts.partials._footer')
@stop