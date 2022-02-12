@extends('layouts.admin')

@section('content')
    @if (session('message'))
        <div class="alert alert-success mt-2">
            {{ session('message') }}
        </div>
    @endif
    <h1 class="mt-5">Dishes</h1>

    <div class="table-responsive">
        <a class="btn btn-dark mt-4 mb-4" href="{{ route('admin.dishes.create') }}" role="button">Add dish</a>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Ingredients</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Is Visible</th>
                    <th scope="col">Option </th>
                    <th scope="col"> </th>
                    <th scope="col"> </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($dishes as $dish)
                    <tr>
                        <td>{{ $dish->id }}</td>
                        <td>{{ $dish->name }}</td>
                        <td><img width="100" height="80"
                                src="{{ asset('storage/restaurant_logo/' . $dish->id . '/' . $dish->logo) }}" alt=""></td>
                        <td>{{ $dish->ingredients }}</td>
                        <td>{{ $dish->description }}</td>
                        <td>{{ $dish->price }}</td>
                        <td>
                            @if ($dish->visiblitity == 0)
                                True
                            @else
                                False
                            @endif

                        </td>
                        <td>{{ $dish->created_at }}</td>
                        <td>{{ $dish->updated_at }}</td>

                        <td>
                            <a class="btn btn-primary" href="{{ route('dishs.show', $dish->id) }}" role="button">View</a>
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.dishs.edit', $dish->id) }}"
                                role="button">Edit</a>
                        </td>

                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger " data-bs-toggle="modal"
                                data-bs-target="#delete{{ $dish->id }}">
                                Delete
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="delete{{ $dish->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="{{ $dish->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete {{ $dish->name }}?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Attenzione stai eliminando un dish definitivamente ⚠️
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <form action="{{ route('admin.dishs.destroy', $dish->id) }}" method="dish">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-danger" type="submit">Delete</button>


                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </td>



                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <div>
        {{ $dishes->links() }}
    </div>

@endsection
