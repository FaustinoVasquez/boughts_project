@csrf

<div class="form-group striped-col">
    <div class="row">
        <label for="name" class="col-md-3 control-label">{{ __('First Name') }}</label>
        <div class="col-md-6">
            <input type="text"
                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                   name="name"
                   value="{{ old('name',$user->Name) }}"
                   autofocus
                   placeholder="Name">

            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <label for="LastName" class="col-md-3 control-label">{{ __('Last Name') }}</label>
        <div class="col-md-6">
            <input id="lastname"
                   type="text"
                   class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}"
                   name="lastname"
                   value="{{ old('lastname',$user->LastName) }}"
                   placeholder="Last Name"
                   autofocus>

            @if ($errors->has('lastname'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('lastname') }}</strong>
                </span>
            @endif
        </div>
    </div>

</div>


<div class="form-group striped-col">
    <div class="row">
        <label for="email" class="col-md-3 control-label">{{ __('E-Mail Address') }}</label>
        <div class="col-md-6">
            <input id="email"
                   type="email"
                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                   name="email"
                   value="{{ old('email',$user->Email) }}"
                   placeholder="Email">

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <label for="username" class="col-md-3 control-label">{{ __('User Name') }}</label>
        <div class="col-md-6">
            <input id="username"
                   type="text"
                   class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                   name="username"
                   value="{{ old('username',$user->Username) }}"
                   autofocus
                   placeholder="UserName">

            @if ($errors->has('username'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="form-group striped-col">
    <div class="row">
        <label for="profile" class="col-md-3 control-label">{{ __('Profile') }}</label>
        <div class="col-md-6">
            @if(auth()->user()->isAdmin())
            <select id="profile"
                    name="profile"
                    class="form-control {{ $errors->has('profile') ? ' is-invalid' : '' }}">
                <option value="">Select profile</option>
                @foreach(trans('users.profiles') as $profile)
                    <option value="{{$profile}}"
                            {{old('profile',$user->Profile)==$profile ? 'selected':''}}>{{$profile}}
                    </option>
                @endforeach
            </select>
            @else
                <input id="profile"
                       type="text"
                       class="form-control{{ $errors->has('profile') ? ' is-invalid' : '' }}"
                       name="profile"
                       value="{{ old('profile',$user->Profile) }}"
                       autofocus
                       placeholder="profile"
                       readonly>
            @endif

            @if ($errors->has('profile'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('profile') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>


<div class="form-group">
    <div class="row">
        <label for="password" class="col-md-3 control-label">{{ __('Password') }}</label>
        <div class="col-md-6">
            <input id="password"
                   type="password"
                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                   name="password"
                   placeholder="Password">

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="form-group striped-col">
    <div class="row">
        <label for="password-confirm" class="col-md-3 control-label">{{ __('Confirm Password') }}</label>
        <div class="col-md-6">
            <input id="password-confirm"
                   type="password"
                   class="form-control{{ $errors->has('password-confirm') ? ' is-invalid' : '' }}"
                   name="password_confirmation"
                   placeholder="Password Confirmation">
            @if ($errors->has('password-confirm'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password-confirm') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

{{--@if((Request::is("admin/users/$user->Id/edit"))))--}}
{{--<div class="form-group">--}}
    {{--<div class="row">--}}
        {{--<label for="password" class="col-md-3 control-label">{{ __('State') }}</label>--}}
        {{--<div class="col-md-6">--}}
            {{--@foreach(trans('users.deletes') as $delete=>$label)--}}
                {{--<label class="radio-inline " for="form-inline-radio1">--}}
                    {{--<input class="radio-blue"--}}
                           {{--name="deleted"--}}
                           {{--type="radio"--}}
                           {{--id="state_{{$delete}}"--}}
                           {{--value="{{$delete}}"--}}
                            {{--{{ old('Deleted',$user->Deleted)==$delete ? 'checked' :'' }}>--}}
                    {{--{{ __($label) }}</label>--}}

            {{--@endforeach--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--@endif--}}