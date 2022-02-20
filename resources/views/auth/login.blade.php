@extends('layouts.app')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="login_page">

        <svg version="1.1" id="Livello_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            x="0px" y="0px" viewBox="0 0 1431.5 113.39" style="enable-background:new 0 0 1431.5 113.39;"
            xml:space="preserve">
            <path class="st0" fill="#FCC045" fill-opacity="1"
                d="M-8.5,0.29l48,21.53c48,21.69,144,64.5,240,81.87s192,8.48,288-8.6c96-17.25,192-43.09,288-40.95c96,2.3,192,32.19,288,43.09s192,2.02,240-2.14l48-4.32V0.29h-48c-48,0-144,0-240,0s-192,0-288,0s-192,0-288,0s-192,0-288,0s-192,0-240,0H-8.5z" />
        </svg>

        <div class="container mt-5">

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group row justify-content-center ms-2">

                    <div class="col-8 col-sm-5">
                        <label for="email" class="form-label fs-4 text-md-right">E-mail Address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row justify-content-center ms-2">

                    <div class="col-8 col-sm-5 password-field mt-4">
                        <label for="password" class="form-label fs-4 text-md-right">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">

                        <span><i id="toggler" class="far fa-eye toggler"></i></span>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group mt-3 row justify-content-center ms-2">
                    <div class="col-8 col-sm-5">
                        <div class="form-check d-flex align-items-baseline">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label fs-5 ps-2" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row justify-content-center ms-2">
                    <div class="col-8 col-sm-5 d-flex ">
                        <button type="submit" class="btn bg_secondary text-white rounded-pill fw-bold py-2 px-5 short_btn">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link ps-4" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>


        </div>
    </div>
@endsection
