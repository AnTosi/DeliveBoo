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
                    <th class="text-center" scope="col">ID</th>
                    <th class="text-center" scope="col">Name</th>
                    <th class="text-center" scope="col">Image</th>
                    <th class="text-center" scope="col">Ingredients</th>
                    <th class="text-center" scope="col">Description</th>
                    <th class="text-center" scope="col">Price</th>
                    <th class="text-center" scope="col">Visible</th>
                    <th class="text-center" scope="col">Created At</th>
                    <th class="text-center" scope="col">Updated At</th>
                    <th class="text-center" scope="col">Option </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($dishes as $dish)
                    <tr>
                        <td class="text-center">{{ $dish->id }}</td>

                        <td class="text-center">{{ $dish->name }}</td>

                        <td class="text-center"><img width="100" height="80"
                                src="{{ asset('storage/' . $dish->image) }}" alt=""></td>

                        <td class="text-center">{{ $dish->ingredients }}</td>

                        <td class="text-center">{{ $dish->description }}</td>

                        <td class="text-center">{{ $dish->price }}</td>

                        <td class="text-center">
                            @if ($dish->visibility === 1)
                                <p>True</p>
                            @else
                                <p>False</p>
                            @endif
                        </td>

                        <td class="text-center">{{ $dish->created_at }}</td>

                        <td class="text-center">{{ $dish->updated_at }}</td>

                        <td class="text-center"> <a class="btn btn-primary" href="#" role="button">View</a></td>

                        <td class="text-center"><a class="btn btn-primary" href="#" role="button">Edit</a></td>

                        <td class="text-center">
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
                                            <form action="#" method="dish">
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
