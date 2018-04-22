
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }} - @yield('title')</title>

        <link rel="stylesheet" href="{{ asset('adminlte/css/all.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/skin-blue.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <!--
    BODY TAG OPTIONS:
    =================
    Apply one or more of the following classes to get the
    desired effect
    |---------------------------------------------------------|
    | SKINS         | skin-blue                               |
    |               | skin-black                              |
    |               | skin-purple                             |
    |               | skin-yellow                             |
    |               | skin-red                                |
    |               | skin-green                              |
    |---------------------------------------------------------|
    |LAYOUT OPTIONS | fixed                                   |
    |               | layout-boxed                            |
    |               | layout-top-nav                          |
    |               | sidebar-collapse                        |
    |               | sidebar-mini                            |
    |---------------------------------------------------------|
    -->
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            @include("shared.main.header")
            @include("shared.main.aside")

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content')
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            @include("shared.main.footer")

            {{--   @include("shared.main.sidebar") --}}


        </div>
        <!-- ./wrapper -->

        <script src="{{ asset("adminlte/js/all.js") }}"></script>
        <script src="{{ asset("adminlte/dist/js/adminlte.min.js") }}"></script>
        <script>
function deleteModel(event, form_id, message) {
    event.preventDefault();
    if (confirm(message)) {
        document.getElementById(form_id).submit();
        return true;
    }
    return false;
}

$('.date-picker').datepicker();
        </script>
        @stack('scripts')

        <!-- Optionally, you can add Slimscroll and FastClick plugins.
             Both of these plugins are recommended to enhance the
             user experience. -->
    </body>
</html>