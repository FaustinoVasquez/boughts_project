@extends('auth.layouts.appAuth')

@section('content')
        <form action="{{ route('login') }}" autocomplete="on" method="post" role="form" id="login_form" class="my-3">
            @csrf
            <h3 class="black_bg">
                <img src="{{ asset('img/login_logo.png') }}" alt="Boughts Logo">
            </h3>

            <div class="form-group {{ $errors->first('email', 'has-error') }}">
                <label style="margin-bottom:0px;" for="email" class="control-label">
                    <i class="livicon"
                       data-name="mail"
                       data-size="16"
                       data-loop="true"
                       data-c="#3c8dbc"
                       data-hc="#3c8dbc"></i>
                    E-Mail Address / Username
                </label>
                <input id="email"
                       name="email"
                       type="text"
                       placeholder="E-mail or Username"
                       value="{!! old('email') !!}"/>
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
                <input id="password"
                       name="password"
                       type="password"
                       placeholder="Enter a password"/>
                <div class="col-sm-12">
                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="form-group">
                <label>
                    <input type="checkbox"
                           name="remember-me"
                           id="remember-me"
                           value="remember-me"
                           class="square-blue"/>
                    Keep me logged in
                </label>
            </div>

            <p class="login button">
                <button type="submit" class="btn btn-primary btn-block">Log In</button>
            </p>
            <p class="change_link text-center">
                <a href="{{route('password.request')}}">Forgot your password?</a>
            </p>
        </form>
@endsection