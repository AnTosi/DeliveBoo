@extends('layouts.app')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/restaurant_show.css') }}">
@endsection


@section('content')

    <div class="container-fliud">
        <img width="100%" height="200" style="filter: blur(20px); object-fit:cover"
            src="{{ asset('storage/restaurant_image/' . $user->id . '/' . $user->image) }}" alt="...">
    </div>

    <div class="container info_cart">
        <div class="row g-3 flex-md-nowrap flex-wrap">
            <div class="col-md-8 col-12 restaurant_aside">
                <div class="info_wrap restaurant_info pt-5 pb-2 px-5 shadow-lg p-3 mb-5 bg-body ">
                    <h1 class="fs-1 fw-bold">{{ $user->name }} <span class="fs-3"><sup>®</sup></span></h1>

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

                <div v-if="user.dishes" class="row row-cols-2 g-3">
                    {{-- @foreach ($dishes as $dish)
                        @if ($dish->visibility == true) --}}
                    <div v-for="dish in displayedDishes" :key="dish.id" class="col dish">

                        <div class="info_wrap pt-4 pb-2 px-5 shadow-lg p-3 mb-5 h-75">
                            <div class="row row-cols-2 align-items-center">
                                <div class="col-4"><img :src="'storage/' + dish.image " class="rounded-circle"
                                        style="object-fit:cover; width:75px; height:75px" alt="">
                                </div>
                                <div class="col">
                                    <h1 class="fs-3 fw-bold"> @{{ dish.name }}</h1>
                                </div>
                            </div>
                            {{-- Image and dish name --}}

                            <div class="row row-cols-2 justify-content-between align-items-center">
                                <div class="col mt-4">
                                    <h4> @{{ dish.price }} €</h4>
                                </div>
                                <div v-on:click="addToCart(dish)"
                                    class="col-9 d-flex justify-content-center align-items-center add_to_cart">
                                    <a class="btn fs-3 fw-bold text_secondary pe-auto">+</a>
                                </div>
                            </div>
                            {{-- Price and Add to cart --}}
                        </div>
                    </div>
                </div>

                {{-- PAGINAZIONE --}}
                <div class="mx-auto d-flex justify-content-center">

                    <nav aria-label="Page navigation example">
                        <ul class="pagination d-flex">
                            <li class="page-item">
                                <button type="button" class="page-link" v-if="page != 1" v-on:click="page--"> Previous
                                </button>
                            </li>
                            <li class="page-item d-flex">
                                <button type="button" class="page-link" v-for="pageNumber in pages"
                                    :class="{active: activePage(pageNumber)}" v-on:click="page = pageNumber">
                                    @{{ pageNumber }}</button>
                            </li>
                            <li class="page-item">
                                <button type="button" v-on:click="nextPage" class="page-link">
                                    Next </button>
                            </li>
                        </ul>
                    </nav>
                </div>
                {{-- / PAGINAZIONE --}}

            </div>

            <div class="col">
                <section style="border-radius: 1rem; background-color: white">

                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col">
                            <div class="card border-0" style="background: none;">
                                <div class="card-body p-4 shadow-lg" style="border-radius: 1rem;">

                                    <div class="row">

                                        {{-- PRODOTTI CARRELLO --}}

                                        <div v-for="product in cart" class="card mb-3">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between flex-wrap">
                                                    <div class="d-flex flex-row align-items-center">
                                                        <div>
                                                            <img :src="'storage/' + product.image " class="rounded-circle"
                                                                alt="Shopping item"
                                                                style=" width: 55px; height: 55px; object-fit: cover;">
                                                        </div>
                                                        <div class="ms-3">
                                                            <h5 class="m-0">@{{ product.name }}</h5>
                                                            <p class="small mb-0"></p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-row align-items-center">
                                                        <div style="width: 50px;">
                                                            <h5 class="fw-normal mb-0 ms-3"> 1 </h5>
                                                        </div>
                                                        <div style="width: 80px;">
                                                            <h5 class="mb-0">@{{ product.price }} €</h5>
                                                        </div>
                                                        <a href="#!" v-on:click="removeCart(product)"
                                                            style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- // PRODOTTI CARRELLO --}}

                                        <div class="flex-column">

                                            <div class="d-flex justify-content-between">
                                                <p class="mb-2">Subtotal</p>
                                                <p class="mb-2">$4798.00</p>
                                            </div>

                                            <div class="d-flex justify-content-between">
                                                <p class="mb-2">Shipping</p>
                                                <p class="mb-2">$20.00</p>
                                            </div>

                                            <div class="d-flex justify-content-between mb-4">
                                                <p class="mb-2">Total(Incl. taxes)</p>
                                                <p class="mb-2">$4818.00</p>
                                            </div>

                                            <button type="button" id="submit-button"
                                                class="btn text_secondary bg_secondary_smooth btn-block btn-lg">
                                                <div class="d-flex justify-content-between fw-bold">
                                                    <span>$4818.00 Checkout
                                                        <i class="fas fa-long-arrow-alt-right ms-2"></i>
                                                    </span>
                                                </div>
                                            </button>

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>
            </div>
        </div>
    </div>

@endsection
