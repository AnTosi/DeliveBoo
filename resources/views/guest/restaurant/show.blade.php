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
        <div class="row g-3 flex-wrap">
            <div class="col-9 restaurant_aside">
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
                    <div v-for="dish in user.dishes" :key="dish.id" class="col dish">
                        <div class="info_wrap pt-4 pb-2 px-5 shadow-lg p-3 mb-5 bg-body ">
                            <div class="row row-cols-2">
                                <div class="col-3"><img :src="'storage/' + dish.image "
                                        class="img-fluid rounded-circle" height="100" width="100" alt="">
                                </div>
                                <div class="col-9">
                                    <h1 class="fs-3 fw-bold"> @{{ dish.name }}</h1>
                                </div>
                            </div>
                            {{-- Image and dish name --}}

                            <div class="row row-cols-2 justify-content-between align-items-center">
                                <div class="col-3 mt-4">
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
                    {{-- @else
                            <p>Gesù malefico</p>
                        @endif
                    @endforeach --}}
                </div>
                <div class="mx-auto d-flex justify-content-center">
                    {{-- {{ $dishes->links() }} --}}
                </div>
            </div>

            <div class="col">
                <section class="h-100 h-custom " style="border-radius: 1rem; background-color: white">
                    <div class="">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col">
                                <div class="card" style="background: none; border: none;">
                                    <div class="card-body p-4 shadow-lg" style="border-radius: 1rem;">

                                        <div class="row">

                                            <div class="flex-row">
                                                <h5 class="mb-3"><a href="#!" class="text-body"><i
                                                            class="fas fa-long-arrow-alt-left me-2"></i>Continue
                                                        shopping</a></h5>
                                                <hr>

                                                <div class="d-flex justify-content-between align-items-center mb-4">
                                                    <div>
                                                        <p class="mb-1">Shopping cart</p>
                                                        <p class="mb-0">You have 4 items in your cart</p>
                                                    </div>
                                                    <div>
                                                        <p class="mb-0"><span class="text-muted">Sort
                                                                by:</span> <a href="#!" class="text-body">price <i
                                                                    class="fas fa-angle-down mt-1"></i></a></p>
                                                    </div>
                                                </div>

                                                {{-- PRODOTTI CARRELLO --}}
                                               
                                                    <div  v-for="product in cart" class="card mb-3">
                                                        <div class="card-body">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="d-flex flex-row align-items-center">
                                                                    <div>
                                                                        <img :src="'storage/' + product.image "
                                                                            class="img-fluid rounded-3" alt="Shopping item"
                                                                            style="width: 65px;">
                                                                    </div>
                                                                    <div class="ms-3">
                                                                        <h5 class="m-0">@{{product.name}}</h5>
                                                                        <p class="small mb-0"></p>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-row align-items-center">
                                                                    <div style="width: 50px;">
                                                                        <h5 class="fw-normal mb-0 ms-3"> 1 </h5>
                                                                    </div>
                                                                    <div style="width: 80px;">
                                                                        <h5 class="mb-0">@{{product.price}} €</h5>
                                                                    </div>
                                                                    <a href="#!" v-on:click="removeCart(product)" style="color: #cecece;"><i
                                                                            class="fas fa-trash-alt"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                              

                                                {{-- <div class="card mb-3">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="d-flex flex-row align-items-center">
                                                                <div>
                                                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/img2.webp"
                                                                        class="img-fluid rounded-3" alt="Shopping item"
                                                                        style="width: 65px;">
                                                                </div>
                                                                <div class="ms-3">
                                                                    <h5>Samsung galaxy Note 10 </h5>
                                                                    <p class="small mb-0">256GB, Navy Blue</p>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-row align-items-center">
                                                                <div style="width: 50px;">
                                                                    <h5 class="fw-normal mb-0">2</h5>
                                                                </div>
                                                                <div style="width: 80px;">
                                                                    <h5 class="mb-0">$900</h5>
                                                                </div>
                                                                <a href="#!" style="color: #cecece;"><i
                                                                        class="fas fa-trash-alt"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card mb-3">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="d-flex flex-row align-items-center">
                                                                <div>
                                                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/img3.webp"
                                                                        class="img-fluid rounded-3" alt="Shopping item"
                                                                        style="width: 65px;">
                                                                </div>
                                                                <div class="ms-3">
                                                                    <h5>Canon EOS M50</h5>
                                                                    <p class="small mb-0">Onyx Black</p>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-row align-items-center">
                                                                <div style="width: 50px;">
                                                                    <h5 class="fw-normal mb-0">1</h5>
                                                                </div>
                                                                <div style="width: 80px;">
                                                                    <h5 class="mb-0">$1199</h5>
                                                                </div>
                                                                <a href="#!" style="color: #cecece;"><i
                                                                        class="fas fa-trash-alt"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card mb-3 mb-lg-0">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="d-flex flex-row align-items-center">
                                                                <div>
                                                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/img4.webp"
                                                                        class="img-fluid rounded-3" alt="Shopping item"
                                                                        style="width: 65px;">
                                                                </div>
                                                                <div class="ms-3">
                                                                    <h5>MacBook Pro</h5>
                                                                    <p class="small mb-0">1TB, Graphite</p>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-row align-items-center">
                                                                <div style="width: 50px;">
                                                                    <h5 class="fw-normal mb-0">1</h5>
                                                                </div>
                                                                <div style="width: 80px;">
                                                                    <h5 class="mb-0">$1799</h5>
                                                                </div>
                                                                <a href="#!" style="color: #cecece;"><i
                                                                        class="fas fa-trash-alt"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                {{-- // PRODOTTI CARRELLO --}}
                                            </div>
                                            <div class="flex-column">

                                                <div class="card bg-primary text-white rounded-3">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                                            <h5 class="mb-0">Card details</h5>
                                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp"
                                                                class="img-fluid rounded-3" style="width: 45px;"
                                                                alt="Avatar">
                                                        </div>

                                                        <p class="small mb-2">Card type</p>
                                                        <a href="#!" type="submit" class="text-white"><i
                                                                class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                                                        <a href="#!" type="submit" class="text-white"><i
                                                                class="fab fa-cc-visa fa-2x me-2"></i></a>
                                                        <a href="#!" type="submit" class="text-white"><i
                                                                class="fab fa-cc-amex fa-2x me-2"></i></a>
                                                        <a href="#!" type="submit" class="text-white"><i
                                                                class="fab fa-cc-paypal fa-2x"></i></a>

                                                        <form class="mt-4">
                                                            <div class="form-outline form-white mb-4">
                                                                <input type="text" id="typeName"
                                                                    class="form-control form-control-lg" siez="17"
                                                                    placeholder="Cardholder's Name" />
                                                                <label class="form-label" for="typeName">Cardholder's
                                                                    Name</label>
                                                            </div>

                                                            <div class="form-outline form-white mb-4">
                                                                <input type="text" id="typeText"
                                                                    class="form-control form-control-lg" siez="17"
                                                                    placeholder="1234 5678 9012 3457" minlength="19"
                                                                    maxlength="19" />
                                                                <label class="form-label" for="typeText">Card
                                                                    Number</label>
                                                            </div>

                                                            <div class="row mb-4">
                                                                <div class="col-md-6">
                                                                    <div class="form-outline form-white">
                                                                        <input type="text" id="typeExp"
                                                                            class="form-control form-control-lg"
                                                                            placeholder="MM/YYYY" size="7" id="exp"
                                                                            minlength="7" maxlength="7" />
                                                                        <label class="form-label"
                                                                            for="typeExp">Expiration</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-outline form-white">
                                                                        <input type="password" id="typeText"
                                                                            class="form-control form-control-lg"
                                                                            placeholder="&#9679;&#9679;&#9679;" size="1"
                                                                            minlength="3" maxlength="3" />
                                                                        <label class="form-label"
                                                                            for="typeText">Cvv</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </form>

                                                        <hr class="my-4">

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
                                                            class="btn btn-info btn-block btn-lg">
                                                            <div class="d-flex justify-content-between">
                                                                <span>$4818.00</span>
                                                                <span>Checkout <i
                                                                        class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                                            </div>
                                                        </button>

                                                    </div>
                                                </div>

                                            </div>

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
