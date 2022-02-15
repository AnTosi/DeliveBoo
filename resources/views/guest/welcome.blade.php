@extends('layouts.app')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
    <div class="tags-container">
        <div
            class="row row-cols-1 row-cols-md-2 row-cols-lg-4 w-50 mx-auto container my-auto pt-5  justify-content-center flex-wrap g-3">
            @foreach ($tags as $tag)
                <div class="col justify-content-center d-flex ">
                    <a href="#" class="tags_link text-black text-decoration-none text-center">
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
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#ffc144" fill-opacity="1"
            d="M0,160L34.3,170.7C68.6,181,137,203,206,192C274.3,181,343,139,411,112C480,85,549,75,617,69.3C685.7,64,754,64,823,74.7C891.4,85,960,107,1029,138.7C1097.1,171,1166,213,1234,224C1302.9,235,1371,213,1406,202.7L1440,192L1440,0L1405.7,0C1371.4,0,1303,0,1234,0C1165.7,0,1097,0,1029,0C960,0,891,0,823,0C754.3,0,686,0,617,0C548.6,0,480,0,411,0C342.9,0,274,0,206,0C137.1,0,69,0,34,0L0,0Z">
        </path>
    </svg>

    <div class="container mb-5">
        <h3>Ristoranti</h3>
        <div class="row row-cols-3 justify-content-between g-5">
            @foreach ($users as $user)
                <div class="col">
                    <a href="#" class="text-decoration-none text-black">
                        <div class="card" aria-hidden="true">
                            <img class="card-img-top"
                                src="{{ asset('storage/restaurant_logo/' . $user->id . '/' . $user->logo) }}" alt="">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <span class="capitalize">{{ $user->name }}</span>
                                </h5>
                                <p>
                                    {{ $user->address }}
                                </p>
                                @if ($user->tags)
                                    @foreach ($user->tags as $tag)
                                        <span>
                                            {{ $tag->name }},
                                        </span>
                                        @if ($loop->last)
                                            <span>
                                                {{ $tag->name }}
                                            </span>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
