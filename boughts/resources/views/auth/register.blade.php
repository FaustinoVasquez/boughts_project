@extends('auth.layouts.appAuth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('name') }}</label>
                                <input id="name"
                                       type="text"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       name="name"
                                       value="{{ old('name') }}"
                                       autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="form-group row">
                            <label for="LastName">{{ __('lastname') }}</label>
                                <input id="lastname"
                                       type="text"
                                       class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}"
                                       name="lastname"
                                       value="{{ old('lastname') }}"
                                       autofocus>

                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif

                        </div>


                        <div class="form-group row">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email"
                                       type="email"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       name="email" value="{{ old('email') }}" >

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="form-group row">
                            <label for="username">{{ __('username') }}</label>
                                <input id="username"
                                       type="text"
                                       class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                       name="username"
                                       value="{{ old('username') }}"
                                       autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="form-group row">
                            <label for="profile">{{ __('profile') }}</label>
                            <select id="profile" name="profile" class="form-control {{ $errors->has('profile') ? ' is-invalid' : '' }}">
                            <option value="">Select profile</option>
                            <option value="Administrator">Administrator</option>
                            <option value="User">User</option>
                            </select>
                                @if ($errors->has('profile'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('profile') }}</strong>
                                    </span>
                                @endif
                        </div>


                        <div class="form-group row">
                            <label for="password">{{ __('password') }}</label>
                                <input id="password"
                                       type="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       name="password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="form-group row">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm"
                                       type="password"
                                       class="form-control{{ $errors->has('password-confirm') ? ' is-invalid' : '' }}"
                                       name="password_confirmation">
                        </div>
                        @if ($errors->has('password-confirm'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password-confirm') }}</strong>
                                    </span>
                        @endif
                        <div class="form-group row">
                            <label for="deleted">{{ __('deleted') }}
                                <input id="deleted"
                                       type="checkbox"
                                       class="form-control"
                                       name="deleted"
                                       value="{{ old('deleted') }}" autofocus>
                            </label>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
