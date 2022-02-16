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

    @include('partials.wave')

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
