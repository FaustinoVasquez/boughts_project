@extends('auth.layouts.appAuth')

@section('content')

        <form action="{{ route('password.email') }}" autocomplete="on" method="post" role="form" id="reset_mail">
            @csrf
            <h3 class="black_bg my-3">
                <img src="{{ asset('assets/img/login_logo.png') }}" alt="Boughts logo"></h3>
            <p style="font-size:14px !important;">
                Enter your email address below and we'll send a special reset password link to your
                inbox.
            </p>
            <!-- CSRF Token -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

            <div class="form-group {{ $errors->first('email', 'has-error') }}">
                <label style="margin-bottom:0px;" for="email">
                    <i class="livicon" data-name="mail" data-size="16" data-loop="true" data-c="#3c8dbc"
                       data-hc="#3c8dbc"></i>
                    Your email
                </label>
                <input id="email" name="email" required type="email" placeholder="your@mail.com"
                       value="{!! old('email') !!}"/>
                <div class="col-sm-12">
                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <p class="login button">
                <button type="submit" class="btn btn-success btn-block">Send Password Reset Link</button>
            </p>
            <p class="change_link text-center">
                <a href="{{route('login')}}">Back to login</a>
            </p>
        </form>
@endsection