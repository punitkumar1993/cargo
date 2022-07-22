@extends('adminlte::page')

@section('title', 'Edit Page')

@section('content_header')
@head(['linkIndex'=>'Pages','currentLinkAdd'=>'Edit','url'=> route('pages.index')])
@slot('title')
{{ __('Edit Page') }}
@endslot
@endhead
@stop

@section('content')
<form action="{{route('pages.update', [$page->id])}}" method="POST" role="form" enctype="multipart/form-data">
@method('PUT')
@csrf
    <div class="row">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">{{ __('Title') }}</label>
                        <input id="title" type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                            placeholder="Enter Title" value="{{ $page->post_title }}" required autofocus
                            onkeyup="typeUrl()">
                        @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="url">{{ __('URL') }}</label>
                        <a id="url" class="d-block" href="{{ Settings::get('siteurl')}}/page/{{ $page->post_name}}"
                            target="_blank">{{ Settings::get('siteurl')}}/page/{{ $page->post_name}}</a>
                    </div>
                    {{--<div class="form-group">
                        <label for="">{{ __('Summary') }}</label>
                        <textarea name="summary" class="form-control" rows="3"
                            placeholder="Enter summary">{{ $page->post_summary }}</textarea>
                    </div>--}}
                    <div class="form-group">
                        <label for="">{{ __('Content') }}</label>
                        <textarea name="content" placeholder="{{ __('Place some text here') }}"
                            style="width: 100%; height: 200px; font-weight:normal">{{ $page->post_content }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-default">
                <div class="card-body">
                    <div class="form-group">
                        <label for="upload">{{ __('Featured Image') }}</label>
                        <div class="upload-photo @if(!empty($page->post_image))ready @endif">
                            <input id="upload" type="file" name="image" value="Choose a file" accept="image/*" data-role="none" hidden>
                            <div class="col-md-12">
                                <div class="upload-msg">{{ __('Click to upload image') }}</div>
                                <div id="display">
                                    <img id="image_preview_container" src="{{ $image }}" name="image" alt="preview image"  style="width: 100%;">
                                    <input type="hidden" name="isimage">
                                </div>
                                <div class="buttons text-center mt-3">
                                    <button id="reset" type="button" class="reset btn btn-danger">{{ __('Remove Image') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="meta_description">{{ __('Meta Description') }}</label>
                        <textarea id="meta_description" name="meta_description" class="form-control" rows="3" placeholder="">{{ $page->meta_description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="meta_keyword">{{ __('Meta Keyword') }}</label>
                        <textarea id="meta_keyword" name="meta_keyword" class="form-control" rows="3" placeholder="">{{ $page->meta_keyword}}</textarea>
                    </div>
                </div>
            </div>
            <div class="card card-default">
                <div class="card-header">{{ __('Publish') }}</div>
                <div class="card-body">
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="publish" value="{{ __('Publish') }}">
                        <input class="btn btn-secondary" type="submit" name="draft" value="{{ __('Save as Draft') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@stop

@section('adminlte_css')
<link rel="stylesheet" href="{{ asset('vendor/summernote/summernote-bs4.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/pace-progress/themes/blue/pace-theme-minimal.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/summernote-add-text-tags/summernote-add-text-tags.css') }}">
@include('admin.page.style')
@stop

@section('adminlte_js')
<script src="{{ asset('vendor/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('vendor/summernote-image-attributes-editor/summernote-image-attributes.js') }}"></script>
<script src="{{ asset('vendor/summernote-image-attributes-editor/lang/en-us.js') }}"></script>
<script src="{{ asset('vendor/summernote-add-text-tags/summernote-add-text-tags.js') }}"></script>
<script src="{{ asset('vendor/summernote-ext-highlight/summernote-ext-highlight.js') }}"></script>
@include('layouts.partials._script')
@include('admin.page.script')
<script>
    "use strict";

    $('.upload-msg').on("click", function() {
        $("#upload").trigger("click");
    })

    const element = document.querySelector(".upload-photo");
    $('input[name=isimage]').val(element.classList.contains("ready"));

    $('#reset').on("click", function() {
        $('#display').removeAttr('hidden');
        $('#reset').attr('hidden');
        $('.upload-photo').removeClass('ready result');
        $('#image_preview_container').attr('src', '{{asset('images/noimage.png')}}');
        $('input[name=isimage]').val("false");
    })

    function readFile(input) {
        let reader = new FileReader();
        reader.onload = (e) => {
            $('.upload-photo').addClass('ready');
            $('#image_preview_container').attr('src', e.target.result);
            $('input[name=isimage]').val("true");
        }
        reader.readAsDataURL(input.files[0]);
    }

    $('#upload').on('change', function() {
        readFile(this);
    })

    function slugify(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-') // Replace spaces with -
            .replace(/[^\w\-]+/g, '') // Remove all non-word chars
            .replace(/\-\-+/g, '-') // Replace multiple - with single -
            .replace(/^-+/, '') // Trim - from start of text
            .replace(/-+$/, ''); // Trim - from end of text
    }

    function typeUrl() {
        if (document.getElementById("title").value === "") {
            $("label[for=url]").attr("hidden", true);
            document.getElementById("url").innerHTML = "";
        } else {
            document.getElementsByTagName("label")[1].removeAttribute("hidden");
            let x = document.getElementById("title").value;
            let slug = slugify(x);
            document.getElementById("url").innerHTML = "{{Settings::get('siteurl')}}" + "/page/" + slug;
        }
    }
</script>
@stop

@section('footer')
@include('layouts.partials._footer')
@stop
