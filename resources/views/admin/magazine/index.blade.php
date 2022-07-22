@extends('adminlte::page')

@section('title', 'Magazines')

@section('content_header')
    @if(\Illuminate\Support\Facades\Auth::user()->username !== 'magazine-user')
        @head(['linkIndex'=>'Magazines'])
        @slot('title')
            {{ __('Magazines') }} ({{ \App\Helpers\Magazines::magazineCount() }})
        @endslot
        @endhead
    @else
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ __('Magazines') }} ({{ \App\Helpers\Magazines::magazineCount() }})</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    @endif
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (\Illuminate\Support\Facades\Auth::User()->hasRole(['superadmin']))
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <h4>Direct Access</h4>
                        <label class="switch ml-2">
                            <input type="checkbox" {{ ($defaultMagazine == 1) ? 'checked' : '' }} onclick="changeStatusMagazine(this)">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <span>Access URL: </span>
                    <a id="myInputMagazine" href="{{ route('magazine.default-view') }}">
                        {{ route('magazine.default-view') }}
                    </a>
                    <button class="btn btn-light" onclick="copyFunction()" id="copyInputMagazine">Copy</button>
                </div>
            </div>
            @endif

            @include('layouts.partials._table')
        </div>
    </div>
@stop

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/pace-progress/themes/blue/pace-theme-minimal.css') }}">
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 30px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider.round {
            border-radius: 34px;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 23px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }
    </style>
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    @include('layouts.partials._script')
    <script>
        function changeStatusMagazine(magazine) {

            console.log("working");
            console.log(magazine.checked);

            $.ajax({
                url: "{{ route('magazines.change-status') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    status: magazine.checked
                },
                error: function(xhr, statusText, err) {
                    alert("Error:" + xhr.status);
                },
                success: function() {

                }
            });
        }
        function copyFunction() {
            let copyText = $("#myInputMagazine").attr('href');

            document.addEventListener('copy', function (e) {
                e.clipboardData.setData('text/plain', copyText);
                e.preventDefault();
            }, true);

            document.execCommand('copy');

            $("#copyInputMagazine").html('Copied');

            setTimeout(function () {
                $("#copyInputMagazine").html('Copy');
            }, 2000);
        }

    </script>
@stop

@section('footer')
    @include('layouts.partials._footer')
@stop
