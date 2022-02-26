@extends('layouts.app')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/restaurant_show.css') }}">
@endsection


@section('content')
    <div class="container-fliud">
        <svg version="1.1" id="Livello_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            x="0px" y="0px" viewBox="0 0 1431.5 113.39" style="enable-background:new 0 0 1431.5 113.39;"
            xml:space="preserve">
            <path class="st0" fill="#ffc144" fill-opacity="1"
                d="M-8.5,0.29l48,21.53c48,21.69,144,64.5,240,81.87s192,8.48,288-8.6c96-17.25,192-43.09,288-40.95c96,2.3,192,32.19,288,43.09s192,2.02,240-2.14l48-4.32V0.29h-48c-48,0-144,0-240,0s-192,0-288,0s-192,0-288,0s-192,0-288,0s-192,0-240,0H-8.5z" />
        </svg>
        <img class="cover-bg" src="{{ asset('storage/restaurant_image/' . $user->id . '/' . $user->image) }}"
            alt="...">
    </div>

    <div class="container info_cart">
        <div class="row g-3 flex-md-nowrap flex-wrap">
            <div class="col-md-8 col-12 restaurant_aside">

                {{-- Restaurant info --}}
                <div class="info_wrap restaurant_info pt-5 pb-2 px-5 shadow-lg mb-5 bg-body ">


                    <h1 class="fs-1 fw-bold">{{ $user->name }} <span class="fs-3"><sup>®</sup></span>
                    </h1>

                    <h3>
                        {{ $user->address }}
                    </h3>

                    @if ($user->tags)
                        @foreach ($user->tags as $tag)
                            @if (!$loop->last)
                                <span class="fs-5">
                                    {{ $tag->name }},
                                </span>
                            @else
                                <span class="fs-5">
                                    {{ $tag->name }}
                                </span>
                            @endif
                        @endforeach
                    @endif

                    <p class="text-muted">Free delivery for orders of 25 € or more.</p>
                </div>

                {{-- Dish list --}}
                <div class="row row-cols-1 row-cols-xl-2 g-3">
                    @foreach ($dishes as $dish)
                        @if ($dish->visibility == true)
                            <div class="col dish">
                                <div class="info_wrap pt-4 pb-2 px-5 bg-white shadow-lg d-flex " style="height:170px">
                                    <button data-bs-toggle="modal" data-bs-target="#show-{{ $dish->slug }}"
                                        class="border-0 bg-white col-10 d-flex">
                                        <div class="col-5 text-start">

                                            @if ($dish->image == null)
                                                <img class="rounded-circle"
                                                    style="object-fit:cover; width:100px; height:100px"
                                                    src="{{ asset('img/no-food-image.jpeg') }}" alt="">
                                            @else
                                                <img class="rounded-circle"
                                                    style="object-fit:cover; width:100px; height:100px"
                                                    src="{{ asset('storage/' . $dish->image) }}" alt="">
                                            @endif

                                        </div>
                                        <div class="info col-7 ms-4 text-start">
                                            <h1 class="fs-3 fw-bold"> {{ $dish->name }}</h1>
                                            <h4>€ {{ $dish->price }}</h4>
                                        </div>
                                    </button>

                                    <div v-on:click="addToCart({{ json_encode($dish) }})"
                                        class="col-2 d-flex justify-content-center align-items-center add_to_cart align-self-end ms-auto mb-4">
                                        <a class="btn fs-3 fw-bold text_secondary pe-auto">+</a>
                                    </div>

                                </div>
                                <!-- <div class="info_wrap pt-4 pb-2 px-5 bg-white shadow-lg ">
                                                                            <button data-bs-toggle="modal" data-bs-target="#show-{{ $dish->slug }}"
                                                                                class="border-0 bg-white col-9">
                                                                                <div class="row justify-content-between align-items-center">
                                                                                    <div class="col-4">
                                                                                        @if ($dish->image == null)
    <img class="rounded-circle"
                                                                                                style="object-fit:cover; width:75px; height:75px"
                                                                                                src="{{ asset('img/no-food-image.jpeg') }}" alt="">
@else
    <img class="rounded-circle"
                                                                                                style="object-fit:cover; width:75px; height:75px"
                                                                                                src="{{ asset('storage/' . $dish->image) }}" alt="">
    @endif
                                                                                    </div>
                                                                                    <div class="col-8">
                                                                                        <h1 class="fs-3 fw-bold text-start"> {{ $dish->name }}</h1>
                                                                                    </div>
                                                                                </div>
                                                                                {{-- Image and dish name --}}
                                                                            </button>

                                                                            <div class="row justify-content-between align-items-center bg-white">
                                                                                <div class="col-6 mt-4">
                                                                                    <h4>€ {{ $dish->price }}</h4>
                                                                                </div>
                                                                                <div v-on:click="addToCart({{ json_encode($dish) }})"
                                                                                    class="col-2 d-flex justify-content-center align-items-center add_to_cart">
                                                                                    <a class="btn fs-3 fw-bold text_secondary pe-auto">+</a>
                                                                                </div>
                                                                            </div>
                                                                            {{-- Price and Add to cart --}}
                                                                        </div> -->
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="show-{{ $dish->slug }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0">
                                        <div class="modal-body mx-auto">
                                            <div class="row flex-column justify-content-center">
                                                <div class="col-12 text-capitalize fs-1">{{ $dish->name }}</div>
                                                <div class="col-12">
                                                    @if ($dish->image == null)
                                                        <img style="height: 300px; object-fit: cover"
                                                            src="{{ asset('img/no-food-image.jpeg') }}" alt="">
                                                    @else
                                                        <img style="height: 300px; object-fit: cover"
                                                            src="{{ asset('storage/' . $dish->image) }}" alt="">
                                                    @endif
                                                </div>
                                                <div class="col-12 mt-4">
                                                    <h4>Description</h4>
                                                    <p class="capitalize">{{ $dish->description }}</p>
                                                </div>
                                                <div class="col-12">
                                                    <h4>Ingredients</h4>
                                                    <p>{{ $dish->ingredients }}</p>
                                                </div>
                                                <div class="col-12">
                                                    <h4>€ {{ $dish->price }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="button" class="btn bg_secondary_smooth text_secondary fw-bold"
                                                v-on:click="addToCart({{ json_encode($dish) }})">
                                                <span>Add to Cart</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center mt-5">

                                <p class="fs-1">Currently there are no dishes available 😅</p>

                            </div>
                        @endif
                    @endforeach
                </div>

                {{-- PAGINAZIONE --}}
                <div class="mx-auto d-flex justify-content-center mt-5">
                    {{ $dishes->links() }}
                </div>
                {{-- / PAGINAZIONE --}}

            </div>
            {{-- CART --}}
            <div class="col-md-4 col-12">
                <section class="bg-white" style="border-radius: 1rem">

                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col">
                            <div class="card border-0" style="background: none;">
                                <div class="card-body p-4 shadow-lg" style="border-radius: 1rem;">

                                    <div class="row">

                                        {{-- PRODOTTI CARRELLO --}}
                                        <form action="{{ route('orders.showOrder') }}" method="post">
                                            @csrf
                                            <div v-if="cart.length > 0" class="cart_wrapper">
                                                <div v-if="product.user_id == {{ json_encode($user->id) }}"
                                                    v-for="(product,index) in cart" :key="index" class="card mb-3">
                                                    <div class="card-body">
                                                        <div class="d-flex flex-nowrap">
                                                            <div class="d-flex flex-row align-items-center">

                                                                <div v-if="product.image == null">
                                                                    <img class="rounded-circle"
                                                                        style="object-fit:cover; width:55px; height:55px"
                                                                        src="{{ asset('img/no-food-image.jpeg') }}"
                                                                        alt="">
                                                                </div>
                                                                <div v-else>
                                                                    <img class="rounded-circle"
                                                                        style="object-fit:cover; width:55px; height:55px"
                                                                        :src="'storage/' + product.image " alt="">
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-column align-items-center">
                                                                <div class="ms-3">
                                                                    <small class="m-0">@{{ product.name.trim().substring(0, 15) }}...
                                                                    </small>
                                                                </div>
                                                                <input type="number" min="1"
                                                                    oninput="validity.valid || (value = '');"
                                                                    :name="'qty[' + product.id + ']'" v-bind:id="product.id"
                                                                    value="1" class="w-50 input-filed">
                                                            </div>
                                                            <div class="d-flex flex-row align-items-center">
                                                                <div
                                                                    class=" align-items-center justify-content-center d-flex box">
                                                                </div>
                                                                <div style="width: 80px;">
                                                                    <h5 class="mb-0">@{{ product.price }} €</h5>
                                                                </div>
                                                                <a v-on:click="removeCart(product)"
                                                                    style="color: #000000;"><i
                                                                        class="fas ms-1 fa-trash-alt"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-else>
                                                <img src="https://cdn.discordapp.com/attachments/940183903816257559/945788459283542056/astronaut-grey-scale.png"
                                                    alt="#">
                                            </div>
                                            {{-- // PRODOTTI CARRELLO --}}

                                            <div class="flex-column">
                                                <button type="submit" id="submit-button"
                                                    class="btn text_secondary bg_secondary_smooth btn-block btn-lg">
                                                    <div class="d-flex justify-content-between fw-bold">
                                                        <span>Checkout
                                                            <i class="fas fa-long-arrow-alt-right ms-2"></i>
                                                        </span>
                                                    </div>
                                                </button>

                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>
            </div>
            {{-- / CART --}}
        </div>
    </div>

@endsection
