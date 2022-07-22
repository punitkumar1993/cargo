@extends('adminlte::page')

@section('title', 'Add New Post')

@section('content_header')
    @head(['linkIndex'=>'Posts','currentLinkAdd'=>'Add New','url'=> route('posts.index')])
        @slot('title')
        {{ __('Add New Post') }}
        @endslot
    @endhead
@stop

@section('content')
<form id="form" action="{{route('posts.store')}}" method="POST" role="form" enctype="multipart/form-data">
@csrf
<div class="row">
    <div class="col-md-8">
        <div class="card card-default">
            <div class="card-body">
                <div class="form-group">
                    <label for="titlePost">{{ __('Post Type') }}</label>

                    <select name="post_type" id="post_type" class="form-control @error('post_type') is-invalid @enderror">
                        <option value="post">News</option>
                        <option value="event">Event</option>
                    </select>
                    @error('post_type')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="titlePost">{{ __('Title') }}</label>
                    <input type="text" name="title" class="form-control @error('post_title') is-invalid @enderror"
                        id="titlePost" placeholder="Enter Title" required autofocus>
                    @error('post_title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group event_location" style="display: none;">
                    <label for="titlePost">{{ __('Event Location') }}</label>
                    <input type="text" name="event_location" class="form-control"
                        id="titlePost" placeholder="Enter Event Location" >
                </div>
                <div class="form-group event_date_time" style="display: none;">
                    <label for="titlePost">{{ __('Event Date & Time')}}</label>
                    <input type="text" name="even_date_time" class="form-control"
                        id="reservationtime" placeholder="Enter Title">       
                </div>
               <!--  <div class="form-group">
                    <label for="summary">{{ __('Summary') }}</label>
                    <textarea name="summary" class="form-control" rows="3" placeholder="{{ __('Enter summary') }}"
                        id="summary"></textarea>
                </div> -->
                <div class="form-group">
                    <label for="">{{ __('Content') }}</label>
                    <textarea name="content" placeholder="{{ __('Place some text here') }}" style="width: 100%; height: 200px; font-weight:normal"></textarea>
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
                        data-placeholder="{{ __('Choose..') }}" style="width: 100%;">
                    </select>
                    <small class="form-text text-muted">
                        {{ __('Click or press enter to select') }}
                    </small>
                </div>
                <div class="form-group">
                    <label for="">{{ __('Select Tags') }}</label>
                    <select id="tagsinput" name="tags[]" class="select2" multiple="multiple" data-placeholder="Choose.."
                        style="width: 100%;">
                    </select>
                    <small class="form-text text-muted">
                        {{ __('Click or press enter to select') }}
                    </small>
                </div>
                <div class="form-group">
                    <label for="">{{ __('Featured Image') }}</label>
                    <div class="upload-photo">
                        <input id="upload" type="file" name="image" value="Choose a file" accept="image/*"
                            data-role="none" hidden>
                        <div class="col-md-12">
                            <div class="upload-msg">{{ __('Click to upload image') }}</div>
                            <div id="display">
                                <img id="image_preview_container" src="#" name="image" alt="preview image"
                                    style="width: 100%;">
                            </div>
                            <div class="buttons text-center mt-3">
                                <button id="reset" type="button"
                                    class="reset btn btn-danger">{{ __('Remove Image') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="meta_description">{{ __('Meta Description') }}</label>
                    <textarea id="meta_description" name="meta_description" class="form-control" rows="3"
                        placeholder=""></textarea>
                </div>
                <div class="form-group">
                    <label for="meta_keyword">{{ __('Meta Keyword') }}</label>
                    <textarea id="meta_keyword" name="meta_keyword" class="form-control" rows="3"
                        placeholder=""></textarea>
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
<link rel="stylesheet" href="{{ asset('vendor/summernote/summernote-bs4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/pace-progress/themes/blue/pace-theme-minimal.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/summernote-add-text-tags/summernote-add-text-tags.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/daterangepicker/date_timepicker.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}">
@include('admin.post.style')
@stop

@section('adminlte_js')
<script src="{{ asset('vendor/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('vendor/summernote-image-attributes-editor/summernote-image-attributes.js') }}"></script>
<script src="{{ asset('vendor/summernote-image-attributes-editor/lang/en-us.js') }}"></script>
<script src="{{ asset('vendor/summernote-add-text-tags/summernote-add-text-tags.js') }}"></script>
<script src="{{ asset('vendor/summernote-ext-highlight/summernote-ext-highlight.js') }}"></script>
<script src="{{ asset('vendor/daterangepicker/date_timepicker.js') }}"></script>
 <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
<script src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"></script>
@include('layouts.partials._script')
@include('admin.post.script')
<script>
    "use strict";

    // UPLOAD IMAGE
    $(document).on('click', '.upload-msg', function() {
        $("#upload").trigger("click");
    });

    $('#reset').on("click", function() {
        $('#display').removeAttr('hidden');
        $('#reset').attr('hidden');
        $('.upload-photo').removeClass('ready result');
        $('#image_preview_container').attr('src', '#');
    });

    function readFile(input) {
        let reader = new FileReader();
        reader.onload = (e) => {
            $('.upload-photo').addClass('ready');
            $('#image_preview_container').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }

    $('#upload').on('change', function() {
        readFile(this);
    });


     $('#reservationtime').daterangepicker({
      autoUpdateInput: false,
     // startDate: moment().subtract(100,'d'),
      //endDate: moment(),
      // maxDate: moment(),

  });
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
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
