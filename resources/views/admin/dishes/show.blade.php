@extends('layouts.admin')


@section('content')
    <div class="container">
        <h3>{{ $dish->name }}</h3>
        <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}">
        <p>{{ $dish->price }}</p>
        <p>{{ $dish->description }}</p>
    </div>
@endsection
