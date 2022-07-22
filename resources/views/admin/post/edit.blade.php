{{-- resources/views/admin/post/edit.blade.php --}}

@extends('adminlte::page')

@section('title', 'Edit Post')

@section('content_header')
@head(['linkIndex'=>'Posts','currentLinkAdd'=>'Add New','url'=> route('posts.index')])
@slot('title')
{{ __('Edit Post') }}
@endslot
@endhead
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <form action="{{ route('posts.update', [$post->id]) }}" method="POST" role="form" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card card-default">
                <div class="card-body">
                    <div class="form-group">
                        <label for="titlePost">{{ __('Post Type') }}</label>

                        <select name="post_type" id="post_type" class="form-control @error('post_type') is-invalid @enderror">
                            <option value="post" {{$post->post_type=='post' ? 'selected' : ''}}>News</option>
                            <option value="event" {{$post->post_type=='event' ? 'selected' : ''}}>Event</option>
                        </select>
                        @error('post_type')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                     </div>
                    @if($post->post_type=='event')
                         <div class="form-group event_location" >
                            <label for="titlePost">{{ __('Event Location') }}</label>
                            <input type="text" value="{{$post->event_location}}" name="event_location" class="form-control"
                                id="titlePost" placeholder="Enter Event Location" >
                        </div>
                        <div class="form-group event_date_time">
                            <label for="titlePost">{{ __('Event Date & Time')}}</label>
                            <input type="text" value="{{$post->event_date_time}}" name="even_date_time" class="form-control"
                                id="reservationtime" placeholder="Enter Title">       
                        </div>
                    @else
                        <div class="form-group event_location" style="display: none;">
                            <label for="titlePost">{{ __('Event Location') }}</label>
                            <input type="text" value="{{$post->event_location}}" name="event_location" class="form-control"
                                id="titlePost" placeholder="Enter Event Location" >
                        </div>
                        <div class="form-group event_date_time" style="display: none;">
                            <label for="titlePost">{{ __('Event Date & Time')}}</label>
                            <input type="text" value="{{$post->event_date_time}}" name="even_date_time" class="form-control"
                                id="reservationtime" placeholder="Enter Title">       
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" name="title"
                            class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="titlePost"
                            placeholder="Enter Title" value="{{ $post->post_title }}" required autofocus>
                        @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                        @endif
                    </div>
                    <!-- <div class="form-group">
                        <label for="">Summary</label>
                        <textarea name="summary" class="form-control" rows="3" placeholder="Enter summary">{{ $post->post_summary }}</textarea>
                    </div> -->
                    <div class="form-group">
                        <label for="">Content</label>
                        <textarea name="content" placeholder="Place some text here" style="width: 100%; height: 200px; font-weight:normal">{{ $post->post_content }}</textarea>
                    </div>
                </div>
            </div>
    </div>
    <div class="col-md-4">
        <div class="card card-default">
            <div class="card-body">
                <div class="form-group">
                    <label for="">{{ __('Select Categories') }}</label>
                    <select id="categories" name="categories[]" class="select2" multiple="multiple"
                        data-placeholder="Choose.." style="width: 100%;">
                        @foreach( $categories as $category )
                        <option value="{{$category->id}}" selected="selected">{{$category->name}}</option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">
                        Click or press enter to select
                    </small>
                </div>
                <div class="form-group">
                    <label for="">{{ __('Select Tags') }}</label>
                    <select id="tagsinput" name="tags[]" class="select2" multiple="multiple" data-placeholder="Choose.."
                        style="width: 100%;">
                        @foreach( $tags as $tag )
                        <option value="{{$tag->id}}" selected="selected">{{$tag->name}}</option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">
                        Click or press enter to select
                    </small>
                </div>
                <div class="form-group">
                    <label for="">{{ __('Featured Image') }}</label>
                    <div class="upload-photo @if(!empty($post->post_image))ready @endif">
                        <input id="upload" type="file" name="image" value="Choose a file" accept="image/*" data-role="none" hidden>
                        <input type="hidden" name="isimage">
                        <div class="col-md-12">
                            <div class="upload-msg">Click to upload image</div>
                            <div id="display">
                                <img id="image_preview_container" src="{{ $image }}" name="image" alt="preview image"
                                    style="width: 100%;">
                            </div>
                            <div class="buttons text-center mt-3">
                                <button id="reset" type="button" class="reset btn btn-danger">Remove Image</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="meta_description">{{ __('Meta Description') }}</label>
                    <textarea id="meta_description" name="meta_description" class="form-control" rows="3"
                        placeholder="">{{ $post->meta_description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="meta_keyword">{{ __('Meta Keyword') }}</label>
                    <textarea id="meta_keyword" name="meta_keyword" class="form-control" rows="3"
                        placeholder="">{{ $post->meta_keyword}}</textarea>
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
        </form>
    </div>
</div>
@stop

@section('adminlte_css')
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/pace-progress/themes/blue/pace-theme-minimal.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/summernote/summernote-bs4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/summernote-add-text-tags/summernote-add-text-tags.css') }}">
@include('admin.post.style')

@section('adminlte_js')
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('vendor/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('vendor/summernote-image-attributes-editor/summernote-image-attributes.js') }}"></script>
<script src="{{ asset('vendor/summernote-image-attributes-editor/lang/en-us.js') }}"></script>
<script src="{{ asset('vendor/summernote-add-text-tags/summernote-add-text-tags.js') }}"></script>
<script src="{{ asset('vendor/summernote-ext-highlight/summernote-ext-highlight.js') }}"></script>
@include('layouts.partials._script')
@include('admin.post.script')
<script>
    "use strict";

    // UPLOAD IMAGE
    const element = document.querySelector(".upload-photo");
    $('input[name=isimage]').val(element.classList.contains("ready"));

    $('.upload-msg').on("click", function() {
        $("#upload").trigger("click");
    });

    $('#reset').on("click", function() {
        $('#display').removeAttr('hidden');
        $('#reset').attr('hidden');
        $('.upload-photo').removeClass('ready result');
        $('#image_preview_container').attr('src', '{{asset('images/noimage.png')}}');
        $('input[name=isimage]').val("false");
    });

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
    });
    $("#post_type").change(function(){
        if($(this).val()=='event'){
            $(".event_location").show();
            $(".event_date_time").show();
        }
        else{
            $(".event_location").hide();
            $(".event_date_time").hide();
        }
    })
</script>
@stop

@section('footer')
@include('layouts.partials._footer')
@stop
