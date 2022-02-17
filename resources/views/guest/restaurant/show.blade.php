@extends('layouts.app')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/restaurant_show.css') }}">
@endsection


@section('content')

    <div class="container-fliud">
        <img width="100%" height="200" style="filter: blur(20px)"
            src="{{ asset('storage/restaurant_image/' . $user->id . '/' . $user->image) }}" alt="...">
    </div>

    <div class="container info_cart">
        <div class="row">
            <div class="col-9 restaurant_aside">
                <div class="restaurant_info pt-5 pb-2 px-5 shadow-lg p-3 mb-5 bg-body ">
                    <h1 class="fs-1 fw-bold">{{ $user->name }} <span class="fs-3"><sup>®</sup></span></h1>

                    <h3>
                        {{ $user->address }}
                    </h3>

                    @if ($user->tags)
                        @foreach ($user->tags as $tag)
                            @if (!$loop->last)
                                <span class="fs-5">
                                    {{ $tag->name }},
                                </span>
                            @else
                                <span class="fs-5">
                                    {{ $tag->name }}
                                </span>
                            @endif
                        @endforeach
                    @endif

                    <p class="text-muted">Free delivery for orders of 25 € or more.</p>
                </div>

                <div class="row row-cols-2">
                    <div class="col">
                        @foreach ($user->dishes as $dish)
                            <p>Dish</p>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col">
                cart
            </div>

        </div>

    </div>


@endsection
