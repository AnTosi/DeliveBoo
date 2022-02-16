@extends('layouts.app')


@section('content')

    @include('partials.wave')
    
    <div class="container">
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ asset('storage/restaurant_image/' . $user->id . '/' . $user->image) }}"
                        class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="d-flex">
                            <img width="60" src="{{ asset('storage/restaurant_logo/' . $user->id . '/' . $user->logo) }}"
                                alt="">
                            <h5 class="card-title">{{ $user->name }}</h5>
                        </div>
                        <p class="card-text">
                            {{ $user->address }}
                        </p>
                        <p class="card-text">
                            <small class="text-muted">
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
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
