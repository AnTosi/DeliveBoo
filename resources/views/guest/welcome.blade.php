@extends('layouts.app')

@section('content')
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

    <div class="container">
        <div class="row row-cols-12 justify-content-between g-3">
            @foreach ($tags as $tag)
                <div class="col">
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
@endsection
