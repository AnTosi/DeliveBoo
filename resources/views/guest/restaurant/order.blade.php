@extends('layouts.app')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/orders.css') }}">
@endsection

@section('content')
    <div class="div">
        <div class="container py-5">
            <h1 class="text-center">
                Checkout:
            </h1>
            <div class="row pb-5 row-cols-1 row-cols-lg-2 justify-content-evenly g-3">

                <div class="col col-lg-8">
                    <div class="row row-cols-1 row-cols-lg-2 g-3">
                        @if ($listaOrdine)
                            @foreach ($listaOrdine as $id => $qty)
                                @foreach ($piatti as $piatto)
                                    @if ($id == $piatto->id)
                                        <div class="col col-lg-6 dish">
                                            <div class="info_wrap p-4 bg-white shadow-lg d-flex"
                                                style="height:150px; border-radius:1rem">
                                                <div class="col-4 text-start">
                                                    @if ($piatto->image == null)
                                                        <img class="rounded-circle"
                                                            style="object-fit:cover; width:90px; height:90px"
                                                            src="{{ asset('img/no-food-image.jpeg') }}" alt="">
                                                    @else
                                                        <img class="rounded-circle"
                                                            style="object-fit:cover; width:90px; height:90px"
                                                            src="{{ asset('Storage/' . $piatto->image) }}" alt="">
                                                    @endif
                                                </div>
                                                <div class="info col-8 ms-4 text-start">
                                                    <h5 class="card-title mb-3">{{ $piatto->name }}</h5>
                                                    <p class="card-text">Quantity: {{ $qty }}</p>
                                                    <p class="card-text">Total dish price:
                                                        {{ $piatto->price * $qty }} €
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                    </div>
                </div>


                <div class="col col-lg-4 mb-3 d-flex flex-row justify-content-center">
                    <form method="post" action="{{ route('payment.pay') }}">
                        @csrf

                        <div class="form-group">
                            <label for="customer_name" class="form-label fs-4">Write your name</label>
                            <input type="text" name="customer_name" id="customer_name"
                                class="form-control bg-white border-0 shadow-lg " placeholder="Write your name"
                                aria-describedby="helpName">
                            <small id="helpName" class="text-muted">Name</small>
                        </div>
                        <input type="text" hidden name="piatti" value="{{ json_encode($piatti) }}">
                        <input type="text" hidden name="ordini" value="{{ json_encode($listaOrdine) }}">
                        <input hidden type="number" value="{{ $restaurant->id }}" name="user_id">
                        <div class="form-group">
                            <label for="email" class="form-label fs-4">Write your e-mail</label>
                            <input type="email" required name="email" id="email"
                                class="form-control bg-white border-0 shadow-lg " placeholder="Write your name"
                                aria-describedby="helpName">
                            <small id="helpName" class="text-muted">E-Mail</small>
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
                                    value="{{ $prezzo_totale }}" readonly>
                            </div>
                            <div class="dish_price_delivery ms-2">
                                <label for="dish_price" class="form-label fs-3">Total Price</label>

                                @if ($prezzo_totale < 25)
                                    <input class="form-control" type="text" name="total_price" id="total_price"
                                        value="{{ $prezzo_totale + 2.5 }}" readonly>
                                    <small class="text-danger">Pay 2.50€ for orders under 25€</small>
                                @else
                                    <input class="form-control" type="text" name="total_price" id="total_price"
                                        value="{{ $prezzo_totale }}" readonly>
                                    <small class="text-success">Free Shipping</small>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button class="btn bg_secondary_smooth text_secondary fw-bold" type="submit"> Proceed to
                                payment</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
