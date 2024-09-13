<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- global level css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('library/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet"/>
    <!-- end of global level css -->
    <!-- page level css -->
    {{--    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/advbuttons.css') }}" />--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/login.css') }}"/>
    <link href="{{ asset('library/iCheck/css/square/blue.css') }}" rel="stylesheet"/>
    <!-- end of page level css -->

    <style>
        .help-block {
            color: #a94442;
        }

        .change_link .btn-warning {
            color: #fff;
        }

        #wrapper label {
            color: rgb(64, 92, 96);
            font-weight: 700;
        }
    </style>

</head>

<body>
<div class="container">
    <div class="row my-3">
        <div class="col-12 mx-auto">
            <div id="notific">
                @include('shared._notifications')
            </div>
        </div>
    </div>
    <div class="row vertical-offset-100">
        <!-- Notifications -->
        <div class="col-sm-6 col-sm-offset-3  col-md-5 col-md-offset-4 col-lg-4 col-lg-offset-4 mx-auto">
            <div id="container_demo">
                <div id="wrapper">
                    <div id="login" class="animate form">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- global js -->
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

<script src="{{ asset('library/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
<!--livicons-->
<script src="{{ asset('js/raphael.min.js') }}"></script>
<script src="{{ asset('js/livicons-1.4.min.js') }}"></script>
<script src="{{ asset('library/iCheck/js/icheck.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/pages/login.js') }}" type="text/javascript"></script>
<!-- end of global js -->
</body>
</html>