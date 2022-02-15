@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="logo">
                <img src="{{ asset('storage/' . $user->logo) }}" alt="{{ $user->name }}">
            </div>
            <h3>{{ $user->name }}</h3>
        </div>
        <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}">
        <p>{{ $user->description }}</p>
    </div>
@endsection
