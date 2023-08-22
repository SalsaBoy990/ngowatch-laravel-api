@extends('layouts.public')

@section('content')

    <main class="card content-600">
        <div class="header">
            <h1 class="h3 text-white">{{ __('Login') }}</h1>
        </div>
        <div class="padding-1-5">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <label for="email" class="margin-top-0">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="@error('email') border border-red @enderror" name="email"
                       value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <div role="alert"><strong class="text-red fs-14">{{ $message }}</strong></div>
                @enderror

                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="@error('password') border border-red @enderror"
                       name="password"
                       required autocomplete="current-password">

                @error('password')
                <div role="alert"><strong class="text-red fs-14">{{ $message }}</strong></div>
                @enderror

                <div class="inline-block margin-top-1 margin-bottom-1">
                    <input type="checkbox" name="remember" id="remember" checked
                           class="margin-left-0" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" style="display: inline">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <div class="bar">
                    <button type="submit" class="secondary margin-top-1">
                        {{ __('Login') }}
                    </button>

                    @if (Route::has('password.request'))
                        <a class="button secondary alt margin-top-1" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>

            </form>
        </div>
    </main>

@endsection
