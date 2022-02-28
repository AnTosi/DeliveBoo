@extends('layouts.app')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
    <div class="registration_page">
        <svg version="1.1" id="Livello_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            x="0px" y="0px" viewBox="0 0 1431.5 113.39" style="enable-background:new 0 0 1431.5 113.39;"
            xml:space="preserve">
            <path class="st0" fill="#ffc144" fill-opacity="1"
                d="M-8.5,0.29l48,21.53c48,21.69,144,64.5,240,81.87s192,8.48,288-8.6c96-17.25,192-43.09,288-40.95c96,2.3,192,32.19,288,43.09s192,2.02,240-2.14l48-4.32V0.29h-48c-48,0-144,0-240,0s-192,0-288,0s-192,0-288,0s-192,0-288,0s-192,0-240,0H-8.5z" />
        </svg>
        <div class="container mt-5">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                {{-- name --}}

                <div class="form-group row justify-content-center ms-2">

                    <div class="col-8 col-sm-5">
                        <label for="name" class="form-label fs-4 text-md-right">Restaurant Name*</label>
                        <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- //name --}}



                {{-- email --}}

                <div class="form-group row justify-content-center ms-2 mt-4">

                    <div class="col-8 col-sm-5">
                        <label for="email" class="form-label fs-4 text-md-right">E-mail Address*</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- //email --}}


                {{-- password --}}

                <div class="form-group row justify-content-center ms-2 mt-4">

                    <div class="col-8 col-sm-5 password-field">
                        <label for="password" class="form-label fs-4 text-md-right">{{ __('Password*') }}</label>
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

                {{-- //password --}}

                {{-- password confirmation --}}
                <div class="form-group row justify-content-center ms-2 mt-4">

                    <div class="col-8 col-sm-5 password-field">
                        <label for="password-confirm"
                            class="form-label fs-4 text-md-right">{{ __('Confirm Password*') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password">
                    </div>
                </div>
                {{-- password //confirmation --}}

                {{-- address --}}

                <div class="form-group row justify-content-center ms-2 mt-4">
                    <div class="col-8 col-sm-5">
                        <label for="address" class="form-label fs-4 text-md-right">Restaurant Address*</label>
                        <input id="address" type="address" class="form-control @error('address') is-invalid @enderror"
                            name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- //address --}}

                {{-- vat - vat --}}

                <div class="form-group row justify-content-center ms-2 mt-4">
                    <div class="col-8 col-sm-5">
                        <label for="vat" class="form-label fs-4 text-md-right">VAT*</label>
                        <input id="vat" type="vat" class="form-control @error('vat') is-invalid @enderror" name="vat"
                            value="{{ old('vat') }}" pattern="[0-9]{11}"
                            oninvalid="this.setCustomValidity('VAT field require 11 digits')"
                            oninput="this.setCustomValidity('')" autocomplete="vat" autofocus>

                        @error('vat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- //vat - vat --}}

                {{-- image --}}

                <div class="form-group row justify-content-center ms-2 mt-4">
                    <div class="col-8 col-sm-5">
                        <label for="image" class="form-label fs-4 text-md-right">Background Image*</label>
                        <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                            accept=".jpg,.png" autofocus>

                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                {{-- //image --}}

                {{-- logo --}}

                <div class="form-group row justify-content-center ms-2 mt-4">
                    <div class="col-8 col-sm-5">
                        <label for="logo" class="form-label fs-4 text-md-right">Logo*</label>
                        <input id="logo" type="file" class="form-control @error('logo') is-invalid @enderror" name="logo"
                            accept=".jpg,.png" autofocus>

                        @error('logo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- //logo --}}


                {{-- Categories tags types --}}

                <div class="form-group row pt-4 justify-content-center ms-2">
                    <div class="col-8 col-sm-5">
                        <label for="tags" class="form-label fs-4 text-md-right">Restaurant tags*</label>
                        <select class="selectpicker @error('tags') is-invalid @enderror d-block" multiple
                            data-live-search="true" name="tags[]" id="tags">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>

                        @error('tags')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- //Categories tags types --}}

                <div class="pt-3 pb-2 text-center text-danger">
                    <p>All the fields with * are required</p>
                </div>

                {{-- Submit button --}}

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">

                        <button type="submit" class="btn bg_secondary text-white rounded-pill fw-bold py-2 px-5 short_btn">
                            {{ __('Register') }}
                        </button>

                    </div>
                </div>

                {{-- //Submit button --}}

            </form>
        </div>
    </div>
@endsection
