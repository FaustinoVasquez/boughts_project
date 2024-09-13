<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>
        @section('title')
            | {{config('app.name')}}
        @show
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    {{--CSRF Token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- global css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css"/>

    <!--page level css-->
@stack('header_styles')
<!--end of page level css-->
</head>
<body class="skin-josh">

@include('shared._header')

<div class="wrapper ">
    <!--LeftSideBar-->
@include('layouts._left_menu')
<!-- End LeftSideBar -->

    <aside class="right-side">
        <!-- Notifications -->

    @include('shared._breadcrumb')
    <!-- Content -->
        @yield('content')

    </aside>
    <!-- right-side -->
</div>
@include('shared._back_to_top')

@include('shared._confirmation')
<!-- global js -->
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

<!-- begin page level js -->
@stack('footer_scripts')
<!-- end page level js -->
</body>
</html>
