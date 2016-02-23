@extends('simple-cms::layouts.master')


@section('head')
    <link href="{{ asset("simple-cms/css/admin/app.css")}}" rel="stylesheet" type="text/css"/>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    @yield('admin-head')

    <title>SimpleCMS - {{ $settings->website_title }} </title>
@stop

@section('body')
    <div class="skin-green">
        <div class="wrapper">
            @include('simple-cms::admin.partials.nav-top')
            @include('simple-cms::admin.partials.nav-left')

            <div class="content-wrapper">

                <section class="content-header">
                    @yield('content-header')
                </section>

                <section class="content">
                    @yield('content-body')
                </section>

                <section class="content-footer">
                    @yield('content-footer')
                </section>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{ asset("simple-cms/js/admin/app.js") }}" type="text/javascript"></script>
    <script src="{{ asset("simple-cms/js/admin/bootstrap-notify.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("simple-cms/js/admin/theme.js") }}" type="text/javascript"></script>

    @yield('admin-scripts')

    @if (session('message'))
        <script>
            $(document).ready(function () {
                $.notify({
                    icon: 'glyphicon glyphicon-ok',
                    title: 'Title',
                    message: '{{ session('message') }}',
                    url: '',
                    target: ''
                }, {
                    type: 'success',
                    allow_dismiss: true,
                    newest_on_top: true,
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    offset: 20,
                    spacing: 10,
                    z_index: 1031,
                    delay: 5000,
                    timer: 1000,
                    mouse_over: "pause",
                    animate: {
                        enter: 'animated fadeInDown',
                        exit: 'animated fadeOutUp'
                    },
                    onShow: null,
                    onShown: null,
                    onClose: null,
                    onClosed: null,
                });
            });
        </script>
    @endif
@stop
