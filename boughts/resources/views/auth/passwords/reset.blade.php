@extends('auth.layouts.appAuth')

@section('content')

    <form method="POST" action="{{ route('password.update') }}" autocomplete="on" role="form" id="reset_pw">
        @csrf

        <h3 class="black_bg my-3">
            <img src="{{ asset('assets/img/login_logo.png') }}" alt="Boughts Logo">
        </h3>

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group" {{ $errors->first('email', 'has-error') }}>
            <label style="margin-bottom:0px;" for="email" class="uname control-label">
                <i class="livicon"
                   data-name="mail"
                   data-size="16"
                   data-loop="true"
                   data-c="#3c8dbc"
                   data-hc="#3c8dbc"></i>
                E-Mail Address
            </label>

            <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}">
            <div class="col-sm-12">
                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
            </div>

        </div>

        <div class="form-group {{ $errors->first('password', 'has-error') }}">
            <label style="margin-bottom:0px;" for="password">
                <i class="livicon"
                   data-name="key"
                   data-size="16"
                   data-loop="true"
                   data-c="#3c8dbc"
                   data-hc="#3c8dbc"></i>
                Password
            </label>

            <input id="password" type="password" name="password">
            <div class="col-sm-12">
                {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        <div class="form-group">
            <label style="margin-bottom:0px;" for="password-confirm">
                <i class="livicon"
                   data-name="key"
                   data-size="16"
                   data-loop="true"
                   data-c="#3c8dbc"
                   data-hc="#3c8dbc"></i>
                Confirm Password
            </label>
            <input id="password-confirm"
                   name="password_confirmation"
                   required type="password"
                   placeholder="Confirm Password"/>
        </div>

        <p class="login button">
            <button type="submit" class="btn btn-success btn-block">Reset Password</button>
        </p>
        <p class="change_link text-center">
            <a href="{{route('login')}}">Back to login</a>
        </p>

    </form>
@endsection
