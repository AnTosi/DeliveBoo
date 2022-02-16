@extends('layouts.app')

@section('custom-css')
<link rel="stylesheet" href="{{asset('css/register.css')}}">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            {{-- name --}}

                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Restaurant Name*') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- //name --}}

                            {{-- email --}}

                            <div class="form-group row py-2">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address*') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- //email --}}


                            {{-- password --}}

                            <div class="form-group row py-2">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password*') }}</label>

                                <div class="col-md-6 password-field">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">
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

                            <div class="form-group row py-2">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password*') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            {{-- password //confirmation --}}

                            {{-- address --}}

                            <div class="form-group row py-2">
                                <label for="address"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Address*') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text"
                                        class="form-control @error('address') is-invalid @enderror" name="address"
                                        value="{{ old('address') }}" required autocomplete="address" autofocus>

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- //address --}}

                            {{-- vat - vat --}}

                            <div class="form-group row py-2">
                                <label for="vat"
                                    class="col-md-4 col-form-label text-md-right">{{ __('VAT*') }}</label>

                                <div class="col-md-6">
                                    <input id="vat" type="text" class="form-control @error('vat') is-invalid @enderror"
                                        name="vat" value="{{ old('vat') }}" pattern="[0-9]{11}"
                                        oninvalid="this.setCustomValidity('VAT field require 11 digits')"
                                        oninput="this.setCustomValidity('')" autocomplete="vat" autofocus
                                    >

                                    @error('vat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong> {{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- //vat - vat --}}

                            {{-- image --}}

                            <div class="form-group row py-2">
                                <label for="image"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Background Image*') }}</label>

                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror"
                                        name="image" autofocus accept=".jpg,.png" required>

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- //image --}}

                            {{-- logo --}}

                            <div class="form-group row py-2">
                                <label for="logo" class="col-md-4 col-form-label text-md-right">{{ __('Logo*') }}</label>

                                <div class="col-md-6">
                                    <input id="logo" type="file" class="form-control @error('logo') is-invalid @enderror"
                                        name="logo" autofocus accept=".jpg,.png" required>

                                    @error('logo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- //logo --}}


                            {{-- Categories tags types --}}

                            <div class="form-group row py-2">
                                <label for="tags" class="col-md-4 col-form-label text-md-right">{{ __('Typology of restaurant*') }}</label>

                                <div class="col-md-6">
                                    <select class="selectpicker @error('tags') is-invalid @enderror" multiple
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

                            <div class="pt-3 text-muted pb-2">
                                <p>All the fields with * are required</p> 
                            </div>

                            {{-- Submit button --}}

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                
                                    <button type="submit" class="btn bg_secondary text-white">
                                        {{ __('Register') }}
                                    </button>
                                    
                                </div>
                            </div>

                            {{-- Submit button --}}

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
