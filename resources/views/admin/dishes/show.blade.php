@extends('layouts.admin')


@section('content')
    <div class="container">
        <div class="back mt-3">
            <a class="text-muted" href="{{ route('admin.dishes.index') }}">
                <i class="fas fa-arrow-left fa-lg fa-fw"></i>
            </a>
        </div>
        <div class="row my-4">
            <div class="col-6">
                <h1>
                    Dish info
                </h1>
            </div>
            <div class="col-6 align-self-center text-end">
                <a class="me-4 text-dark" href="{{ route('admin.dishes.edit', $dish->slug) }}">
                    <i class="fas fa-pencil-alt fa-lg fa-fw"></i>
                </a>
                <!-- Button trigger modal -->
                <a type="button" class="text-dark" data-bs-toggle="modal"
                    data-bs-target="#delete_dish-{{ $dish->slug }}">
                    <i class="fas fa-trash-alt fa-lg fa-fw"></i>
                </a>

                <!-- Modal -->
                <div class="modal fade" id="delete_dish-{{ $dish->slug }}" tabindex="-1" role="dialog"
                    aria-labelledby="delete_dish_{{ $dish->title }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete: {{ $dish->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">
                                WARNING! ⚠️
                                <br>
                                You are permanently deleting "{{ $dish->name }}" from your menu
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <form action="{{ route('admin.dishes.destroy', $dish->slug) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-3">
                <div class="text-muted">
                    Name:
                </div>
            </div>
            <div class="col-9">
                <h3>{{ $dish->name }}</h3>
            </div>
            <div class="col-3">
                <div class="text-muted">
                    Image:
                </div>
            </div>
            <div class="col-9">
                <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}">
            </div>
            <div class="col-3">
                <div class="text-muted">
                    Price:
                </div>
            </div>
            <div class="col-9">
                <p>&euro;{{ $dish->price }}</p>
            </div>
            <div class="col-3">
                <div class="text-muted">
                    Description:
                </div>
            </div>
            <div class="col-9">
                <p>{{ $dish->description }}</p>

            </div>
            <div class="col-3">
                <div class="text-muted">
                    Ingredients:
                </div>
            </div>
            <div class="col-9">
                <p>{{ $dish->ingredients }}</p>

            </div>
        </div>
    </div>
@endsection
