@extends('layouts.app')

@section('custom-css')
<link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')

<div class="tags-container">
    <div class="row w-50 mx-auto container my-auto pt-5  justify-content-center flex-wrap g-3">
        @foreach ($tags as $tag)
        <div class="col justify-content-center d-flex ">
            <a href="#" class="text-black text-decoration-none text-center">
                <div class="card rounded-pill">
                    <div class="card-body">
                        <h5 class="card-title">
                            <span>{{ $tag->name }}</span>
                        </h5>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffc144" fill-opacity="1" d="M0,64L48,53.3C96,43,192,21,288,48C384,75,480,149,576,186.7C672,224,768,224,864,208C960,192,1056,160,1152,154.7C1248,149,1344,171,1392,181.3L1440,192L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>

<div class="container mb-5">
    <h3>Ristoranti</h3>
    <div class="row row-cols-3 justify-content-between g-5">
        @foreach ($users as $user)
        <div class="col">
            <a href="#" class="text-decoration-none text-black">
                <div class="card" aria-hidden="true">
                    <img class="card-img-top" src="{{ asset('storage/restaurant_logo/' . $user->id . '/' . $user->logo) }}" alt="">
                    <div class="card-body">
                        <h5 class="card-title">
                            <span>{{ $user->name }}</span>
                        </h5>
                        <p class="card-text placeholder-glow">
                            <span></span>
                            <span class="placeholder col-4"></span>
                            <span class="placeholder col-4"></span>
                            <span class="placeholder col-6"></span>
                            <span class="placeholder col-8"></span>
                        </p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

@endsection