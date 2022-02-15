@extends('layouts.app')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
    <div class="tags-container">
        <div
            class="row row-cols-1 row-cols-md-2 row-cols-lg-4 w-50 mx-auto container my-auto pt-3  justify-content-center flex-wrap g-3">
            @foreach ($tags as $tag)
                <div class="col justify-content-center d-flex ">
                    <a href="#" class="tags_link text-black text-decoration-none text-center">
                        <div class="card rounded-pill">
                            <div class="card-body">
                                <h5 class="card-title mb-0">
                                    <span>{{ $tag->name }}</span>
                                </h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <svg version="1.1" id="Livello_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
        y="0px" viewBox="0 0 1431.5 113.39" style="enable-background:new 0 0 1431.5 113.39;" xml:space="preserve">
        <path class="st0" fill="#FCC045" fill-opacity="1" d="M-8.5,0.29l48,21.53c48,21.69,144,64.5,240,81.87s192,8.48,288-8.6c96-17.25,192-43.09,288-40.95
                                                 c96,2.3,192,32.19,288,43.09s192,2.02,240-2.14l48-4.32V0.29h-48c-48,0-144,0-240,0s-192,0-288,0s-192,0-288,0s-192,0-288,0
                                                 s-192,0-240,0H-8.5z" />
    </svg>

    <div class="container mb-5">
        <h2 class="my-5">Restaurants</h2>
        <div class="row row-cols-3 g-5">
            @foreach ($users as $user)
                <div class="col">
                    <a href="{{ route('restaurant.show', $user->slug) }}" class="text-decoration-none text-black">
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
                                        @if (!$loop->last)
                                            <span>
                                                {{ $tag->name }},
                                            </span>
                                        @else
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
