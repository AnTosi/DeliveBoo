@extends('layouts.app')

@section('content')
    <div class="div">
        <div class="container py-5">
            <h1 class="text-center">
                Checkout:
            </h1>
            <div class="row py-5 row-cols-3 justify-content-evenly g-3">
                @foreach ($listaOrdine as $id => $qty)
                    @foreach ($piatti as $piatto)
                        @if ($id == $piatto->id)
                            <div class="col d-flex justify-content-center">
                                <div class="card border-0 text-start shadow-lg"
                                    style="width: 268px; height:100%; padding: 0;border-radius: 1rem;">
                                    <img style="width: 100%;height: 100%;object-fit: cover;border-radius: 1rem;"
                                        class="card-img-top" src="{{ asset('Storage/' . $piatto->image) }}" alt="#">
                                    <div class="card-body">
                                        <h4 class="card-title mb-3">{{ $piatto->name }}</h4>
                                        <p class="card-text">Quantity: {{ $qty }}</p>
                                        <p class="card-text">Total dish price: {{ $piatto->price * $qty }} € </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
            <div class="mb-3 d-flex flex-row justify-content-center">
                <form action="#" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="customer_name" class="form-label fs-4">Write your name</label>
                        <input type="text" name="customer_name" id="customer_name"
                            class="form-control bg-white border-0 shadow-lg " placeholder="Write your name"
                            aria-describedby="helpName">
                        <small id="helpName" class="text-muted">Name</small>
                    </div>
                    <div class="form-group">
                        <label for="address" class="form-label fs-3">Write your Address</label>
                        <input type="text" name="address" id="address" class="form-control bg-white border-0 shadow-lg"
                            placeholder="Address" aria-describedby="helpAddress">
                        <small id="helpAddress" class="text-muted">Address</small>
                    </div>

                    <div class="form-group d-flex">
                        <div class="dish_price_only me-2">
                            <label for="dish_price" class="form-label fs-3">Dish Price</label>
                            <input class="form-control" name="dish_price" id="dish_price" type="text"
                                value="{{ $prezzo_totale }}€" readonly>
                        </div>
                        <div class="dish_price_delivery ms-2">
                            <label for="dish_price" class="form-label fs-3">Total Price</label>

                            @if ($prezzo_totale < 25)
                                <input class="form-control" type="text" name="total_price" id="total_price"
                                    value="{{ $prezzo_totale + 2.5 }}€" readonly>
                                <small class="text-danger">Pay 2.50€ for orders under 25€</small>
                            @else
                                <input class="form-control" type="text" name="total_price" id="total_price"
                                    value="{{ $prezzo_totale }}€" readonly>
                                <small class="text-success">Free Shipping</small>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-3">

                        <button class="btn bg_secondary_smooth text_secondary fw-bold " type="submit">
                            Proceed to Payment
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
