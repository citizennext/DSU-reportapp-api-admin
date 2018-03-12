@extends('layouts.login')

@section('login-content')
    <form action="{{ route('password.email') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} form-group-default" id="emailGroup">
            <label for="email">{{ __('voyager.generic.email') }}</label>
            <div class="controls">
                <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder="{{ __('voyager.generic.email') }}" class="form-control" required>
                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ __($errors->first('email')) }}</strong>
                </span>
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-block login-button">
            <span>{{ __('voyager.login.reset_pasword') }}</span>
        </button>

    </form>
@endsection
