@extends('layouts.admin')

@section('content')
    @if (session('message'))
        <div class="alert alert-success mt-2">
            {{ session('message') }}
        </div>
    @endif

    <div class="d-flex justify-content-between pt-3">
        <div class="col-6">
            <h1>Orders</h1>
        </div>
        <div class="col-6 text-end">
            <a name="" id="" class="btn btn-dark" href="{{ route('admin.orders.create') }}" role="button">
                Add Order
            </a>
        </div>
    </div>

    <table class="table table-responsive-md table-striped">
        <thead>
            <tr>
                <th class="text-center" scope="col">Date</th>
                <th class="text-center" scope="col">Customer Name</th>
                <th class="text-center" scope="col">Email</th>
                <th class="text-center" scope="col">Address</th>
                <th class="text-center" scope="col">Total Price</th>
                <th class="text-center" scope="col">Dishes</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($orders as $order)
                <tr>
                    <td class="text-center align-middle">{{ $order->data }}</td>

                    <td class="text-center align-middle">{{ $order->customer_name }}</td>

                    <td class="text-center align-middle">{{ $order->email }}</td>

                    <td class="text-center align-middle ">{{ $order->address }}</td>

                    <td class="text-center align-middle ">{{ $order->total_price }}€</td>

                    <td class="text-center align-middle">
                        <div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-utensils"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                                <li><button class="dropdown-item" type="button" data-bs-target="#delete{{ $order->id }}"
                                        data-bs-toggle="modal">Dishes</button>
                                </li>

                            </ul>
                            <!-- Modal -->
                            <div class="modal fade" id="delete{{ $order->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="{{ $order->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Customer: {{ $order->customer_name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body text-start">

                                            <p>Order id: {{ $order->id }}</p>

                                            @foreach ($order->dishes as $dish)
                                                <div class="py-2">
                                                    <div>Dish:  <span class="fs-4">{{ $dish->name }}</span> </div>
                                                    <div>Servings:  <span class="fs-4">{{ $dish->pivot->quantity }}</span> </div>
                                                </div>
                                            @endforeach

                                        </div>
                                        <div class="modal-footer text-start">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
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
        {{ $orders->links() }}
    </div>
@endsection
