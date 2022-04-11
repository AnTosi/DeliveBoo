@extends('layouts.app')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('page-title','Success')

@section('content')
    <svg version="1.1" id="Livello_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
        y="0px" viewBox="0 0 1431.5 113.39" style="enable-background:new 0 0 1431.5 113.39;" xml:space="preserve">
        <path class="st0" fill="#ffc144" fill-opacity="1"
            d="M-8.5,0.29l48,21.53c48,21.69,144,64.5,240,81.87s192,8.48,288-8.6c96-17.25,192-43.09,288-40.95c96,2.3,192,32.19,288,43.09s192,2.02,240-2.14l48-4.32V0.29h-48c-48,0-144,0-240,0s-192,0-288,0s-192,0-288,0s-192,0-288,0s-192,0-240,0H-8.5z" />
    </svg>

    <div class="container my-5">
        <div class="message text-center">
            <h1>Payment Successful!</h1>
            <p class="lead pb-5">Your payment has been successfully completed</p>
            <p>Click the button below if you want buy again</p>
            <a class="rest-btn btn rounded-pill px-3" href="{{ route('home') }}">Resturants</a>
        </div>
    </div>
@endsection
