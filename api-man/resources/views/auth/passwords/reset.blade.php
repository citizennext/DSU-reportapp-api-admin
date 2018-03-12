@extends('layouts.login')

@section('login-content')
    <form action="{{ route('password.request') }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} form-group-default" id="emailGroup">
            <label for="email">{{ __('voyager.generic.email') }}</label>
            <div class="controls">
                <input type="text" name="email" id="email" value="{{ $email or old('email') }}" placeholder="{{ __('voyager.generic.email') }}" class="form-control" required autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                    <strong>{{ __($errors->first('email')) }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} form-group-default" id="passwordGroup">
            <label for="password">{{ __('voyager.generic.password') }}</label>
            <div class="controls">
                <input type="password" name="password" id="password" placeholder="{{ __('voyager.generic.password') }}" class="form-control" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                    <strong>{{ __($errors->first('password')) }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} form-group-default" id="passwordConfirmationGroup">
            <label for="password-confirm">{{ __('voyager.generic.password_confirm') }}</label>
            <div class="controls">
                <input type="password" name="password_confirmation" id="password-confirm" placeholder="{{ __('voyager.generic.password_confirm') }}" class="form-control" required>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                    <strong>{{ __($errors->first('password_confirmation')) }}</strong>
                </span>
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-block login-button">
            <span>{{ __('voyager.login.reset_pasword') }}</span>
        </button>

    </form>
@endsection
