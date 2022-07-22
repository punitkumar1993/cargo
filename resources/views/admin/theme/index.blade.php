@extends('adminlte::page')

@section('title', 'Themes')

@section('content_header')
    @head(['linkIndex'=>'Themes'])
    @slot('title')
        {{ __('Themes') }}
    @endslot
    @endhead
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body">
                    <div class="row">
                        @php $nop = 1; @endphp
                        @foreach($dirs as $dir)
                            <div class="col-md-3 col-sm-4 cover">
                                <figure class="pos-relative mg-b-0">
                                    <img src="{{ asset('themes/'.last(explode('/', $dir)).'/screenshot.png') }}" class="img-fit-cover" alt="" />
                                    <figcaption class="pos-absolute b-0 p-20 d-flex w-100 justify-content-center">
                                        <div class="btn-group hide">
                                            @if (Settings::get('current_theme') != Settings::theme_name(Settings::get_theme(last(explode('/', $dir)))))
                                                <button type="button" href="#" class="btn btn-dark btn-icon activate" title="Activate" data-toggle="tooltip" data-placement="{{ __('top') }}" data-theme="{{ Settings::theme_name(Settings::get_theme(last(explode('/', $dir)))) }}" data-themedir="{{ last(explode('/', $dir)) }}"><i class="fas fa-play"></i></button>
                                            @endif
                                            <button type="button" class="btn btn-dark btn-icon view" title="{{ __('View') }}" data-themedir="{{ last(explode('/', $dir)) }}" data-dir><i class="fas fa-eye"></i></button>
                                            @if (Settings::get('current_theme') != Settings::theme_name(Settings::get_theme(last(explode('/', $dir)))))
                                                <button type="button" class="btn btn-dark btn-icon" data-delete="" title="Delete" data-toggle="tooltip" data-placement="top"><i class="fas fa-trash-alt"></i></button>
                                            @endif
                                        </div>
                                    </figcaption>
                                </figure>
                                <h5 class="text-center">{{ Settings::get_data_theme(Settings::get_theme(last(explode('/', $dir))), 'theme_name') }}</h5>
                            </div>
                            @php $nop++; @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="view">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Theme Name</th>
                                <td class="row1"></td>
                            </tr>
                            <tr>
                                <th>Version</th>
                                <td class="row2"></td>
                            </tr>
                            <tr>
                                <th>Author</th>
                                <td class="row3"></td>
                            </tr>
                            <tr>
                                <th>Author URI</th>
                                <td class="row4"></td>
                            </tr>
                            <tr>
                                <th>Theme URI</th>
                                <td class="row5"></td>
                            </tr>
                            <tr>
                                <th>License</th>
                                <td class="row6"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default float-right" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/pace-progress/themes/blue/pace-theme-minimal.css') }}">
    <style>
        .pos-relative {
            position:relative;
        }
        .img-fit-cover {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .pos-absolute {
            position: absolute;
        }
        .btn-group, .btn-group-vertical {
            position: relative;
            display: inline-flex;
            vertical-align: middle;
        }
        .b-0 {
            bottom: 0;
        }
        .p-20 {
            padding: 20px;
        }
         .hide {
             visibility: hidden;
         }
        .cover:hover .hide  {
            visibility: visible;
        }
        [class*="col-"]:not(:last-child){
            margin-bottom: 30px;
        }
    </style>
@stop

@section('adminlte_js')
{{--    @include('layouts.partials._script')--}}
@if(session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
@endif
    <script>
        $(function () {
            "use strict";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('[data-toggle="tooltip"]').tooltip();

            $(".activate").on("click", function() {
                const theme = $(this).data("theme");
                const themedir = $(this).data("themedir");
                $.ajax({
                    data: {
                        "theme": theme,
                        "theme_dir": themedir,
                    },
                    type: "PATCH",
                    url: "{{ route('theme.activated') }}",
                    cache: false,
                    success: function(response) {
                        location.reload();
                    }
                });
            })

            $(".view").on("click", function() {
                let theme_name = $(this).data('themedir');
                $.ajax({
                    url: "{{ route('theme') }}",
                    method: 'GET',
                    data: {'theme': theme_name},
                    success: function(resp) {
                        console.log(resp);
                        $('.row1').html(resp.theme_name);
                        $('.row2').html(resp.version);
                        $('.row3').html(resp.author);
                        $('.row4').html(resp.author_uri);
                        $('.row5').html(resp.theme_uri);
                        $('.row6').html(resp.license);

                        $('#view').modal('show');
                    }
                })



            })

        })
    </script>
@stop

@section('footer')
    @include('layouts.partials._footer')
@stop
