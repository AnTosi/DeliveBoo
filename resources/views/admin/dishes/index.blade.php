@extends('layouts.admin')

@section('content')
    @if (session('message'))
        <div class="alert alert-success mt-2">
            {{ session('message') }}
        </div>
    @endif

    <div class="d-flex justify-content-between pt-3">
        <div class="col-6">
            <h1>Dishes</h1>
        </div>
        <div class="col-6 text-end">
            <a name="" id="" class="btn btn-dark" href="{{ route('admin.dishes.create') }}" role="button">
                Add dish
            </a>
        </div>
    </div>

    <table class="table table-responsive-md table-striped">
        <thead>
            <tr>
                <th class="text-center" scope="col">ID</th>
                <th class="text-center" scope="col">Name</th>
                <th class="text-center" scope="col">Image</th>
                <th class="text-center" scope="col">Price</th>
                <th class="text-center" scope="col">Visible</th>
                <th class="text-center created" scope="col">Created</th>
                <th class="text-center updated" scope="col">Updated</th>
                <th class="text-center" scope="col">Option </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($dishes as $dish)
                <tr>
                    <td class="text-center align-middle">{{ $dish->id }}</td>

                    <td class="text-center align-middle">{{ $dish->name }}</td>

                    <td class="text-center align-middle">
                        @if ($dish->image == null)
                            <img class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover"
                                src="{{ asset('img/no-food-image.jpeg') }}" alt="">
                        @else
                            <img class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover"
                                src="{{ asset('storage/' . $dish->image) }}" alt="">
                        @endif

                    </td>

                    <td class="text-center align-middle">&euro;{{ $dish->price }}</td>

                    <td class="text-center align-middle">
                        @if ($dish->visibility === 1)
                            <i class="fas fa-check" style="color: green;"></i>
                        @else
                            <i class="fas fa-times" style="color: red;"></i>
                        @endif
                    </td>

                    <td class="text-center align-middle created">{{ $dish->created_at }}</td>

                    <td class="text-center align-middle updated">{{ $dish->updated_at }}</td>

                    <td class="text-center align-middle">
                        <div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-wrench fa-fw"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.dishes.show', $dish->slug) }}">View</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.dishes.edit', $dish->slug) }}">Edit</a></li>


                                <!-- trigger modal -->
                                <li><button class="dropdown-item" type="button"
                                        data-bs-target="#delete{{ $dish->slug }}" data-bs-toggle="modal">Delete</button>
                                </li>


                            </ul>
                            <!-- Modal -->
                            <div class="modal fade" id="delete{{ $dish->slug }}" tabindex="-1" role="dialog"
                                aria-labelledby="{{ $dish->slug }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete: {{ $dish->name }}?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body text-start">
                                            WARNING! ??????
                                            <br>
                                            You are permanently deleting "{{ $dish->name }}" from your menu

                                        </div>
                                        <div class="modal-footer text-start">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <form action="{{ route('admin.dishes.destroy', $dish->slug) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger text-white" type="submit">Delete</button>
                                            </form>
                                        </div>
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
