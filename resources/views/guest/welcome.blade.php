@extends('layouts.app')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
    {{-- <div class="tags-container">
        <div
            class="row row-cols-2 row-cols-sm-3 row-cols-lg-4 mx-auto container-fluid my-auto pt-3  justify-content-center flex-wrap g-3">
            @foreach ($tags as $tag)
                <div class="col-2 justify-content-center d-flex">
                    <a href="#" class="tags_link text-black text-decoration-none text-center">
                        <div class="card rounded-pill tag_card" v-on:click="tagHandler({{ json_encode($tag) }})"
                            :class=" filterTags.includes({{ json_encode($tag->id) }}) ? 'active' : '' ">
                            <div class="card-body py-2">
                                <h5 class="card-title mb-0">
                                    <span> {{ $tag->name }} </span>
                                </h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div> --}}

    <div class="nav-scroller">
        <nav class="tags-scroller">
            @foreach ($tags as $tag)
                <a href="#" class="tags_link text-black text-decoration-none text-center">
                    <div class="card rounded-pill tag_card" v-on:click="tagHandler({{ json_encode($tag) }})"
                        :class=" filterTags.includes({{ json_encode($tag->id) }}) ? 'active' : '' ">
                        <div class="card-body py-2">
                            <h5 class="card-title mb-0">
                                <span> {{ $tag->name }} </span>
                            </h5>
                        </div>
                    </div>
                </a>
            @endforeach
        </nav>
    </div>



    <svg version="1.1" id="Livello_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
        y="0px" viewBox="0 0 1431.5 113.39" style="enable-background:new 0 0 1431.5 113.39;" xml:space="preserve">
        <path class="st0" fill="#ffc144" fill-opacity="1"
            d="M-8.5,0.29l48,21.53c48,21.69,144,64.5,240,81.87s192,8.48,288-8.6c96-17.25,192-43.09,288-40.95c96,2.3,192,32.19,288,43.09s192,2.02,240-2.14l48-4.32V0.29h-48c-48,0-144,0-240,0s-192,0-288,0s-192,0-288,0s-192,0-288,0s-192,0-240,0H-8.5z" />
    </svg>

    <div class="container mb-5">

        <h2 class="my-5 fs-1">Restaurants</h2>

        <div v-show="searchInput != '' && filteredRest == 0">
            <p class="fs-1">
                Sorry, no restaurant to show with this name (Be sure to press 'enter' to send your research)
            </p>
            <p class="fs-1">
                other results:
            </p>
        </div>

        <div v-if="filteredRest.length > 0" class="gutter row row-cols-md-2 row-cols-lg-3">

            <div v-for="user in filteredRest" :key="user.id">
                <div class="col h-100 px-3">
                    <a class="text-decoration-none text-black text-center border-0 bg-transparent h-100 w-100"
                        :href="user.slug">
                        <div class="rest_card card border-0 shadow-lg" aria-hidden="true">
                            <div class="img_wrapper">
                                <img class="card-img-top"
                                    :src="'/storage/restaurant_logo' + '/' + user.id + '/' + user.logo " alt="">
                                <h5 class="card-title capitalize text-white">
                                    @{{ user.name }}
                                    {{-- <p><span class="capitalize fs-2 text-white"> </span></p> --}}
                                </h5>
                            </div>

                            <div class="card_body">
                                {{-- <p class="text-decoration-none mb-1">
                                @{{ user.address }}
                            </p> --}}
                                <span v-for="tag in user.tags" :key="tag.id">
                                    @{{ tag.name }}
                                </span>

                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div v-else-if="filterTags.length > 0">
            <div v-if="filteredUsers.length > 0" class="gutter row row-cols-1 row-cols-md-2 row-cols-lg-3">
                <div v-for="user in filteredUsers" :key="user.id">
                    <div class="col h-100 px-3">
                        <a class="text-decoration-none text-black text-center border-0 bg-transparent h-100 w-100"
                            :href="user.slug">
                            <div class="rest_card card border-0 shadow-lg" aria-hidden="true">
                                <div class="img_wrapper">
                                    <img class="card-img-top"
                                        :src="'/storage/restaurant_logo' + '/' + user.id + '/' + user.logo " alt="">
                                    <h5 class="card-title capitalize text-white">
                                        @{{ user.name }}
                                        {{-- <p><span class="capitalize fs-2 text-white"> </span></p> --}}
                                    </h5>
                                </div>

                                <div class="card_body">
                                    <span v-for="tag in user.tags" :key="tag.id">
                                        @{{ tag.name }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                </a>
            </div>
            <div v-else>
                <p>
                    Sorry, there are no restaurants in this tipology :(
                </p>
            </div>
        </div>

        <div v-else class="gutter row row-cols-1 row-cols-md-2 row-cols-lg-3">
            <div v-for="user in users" :key="user.id">
                <div class="col h-100 px-3">
                    <a class="text-decoration-none text-black text-center border-0 bg-transparent h-100 w-100"
                        :href="user.slug">
                        <div class="rest_card card border-0 shadow-lg" aria-hidden="true">

                            <div class="img_wrapper">
                                <img class="card-img-top"
                                    :src="'/storage/restaurant_logo' + '/' + user.id + '/' + user.logo " alt="">
                                <h5 class="card-title capitalize text-white">
                                    @{{ user.name }}
                                    {{-- <p><span class="capitalize fs-2 text-white"> </span></p> --}}
                                </h5>
                            </div>

                            <div class="card_body">
                                {{-- <p class="text-decoration-none mb-1">
                                    @{{ user.address }}
                                </p> --}}
                                <span v-for="tag in user.tags" :key="tag.id">
                                    @{{ tag.name }}
                                </span>

                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div v-else>
            <div class="text-center mt-5">
                <p class="fs-1">Loading</p>
                <svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66"
                    xmlns="http://www.w3.org/2000/svg">
                    <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33"
                        r="30">
                    </circle>
                </svg>
            </div>
        </div>

        <div v-if="filteredUsers == 0 && filterTags.length == 0 && filteredRest == 0"
            class="d-flex justify-content-center mt-5">
            <button class="btn btn-outline-dark me-1" v-on:click="prev" v-show="currentPage != 1">
                Prev
            </button>
            <div v-for="page in lastPage" :key="page" class="page">
                <button class="btn btn-outline-dark mx-1" v-on:click="current(page)">
                    @{{ page }}
                </button>
            </div>
            <button class="btn btn-outline-dark ms-1" v-on:click="next" v-show="lastPage != currentPage">
                Next
            </button>
        </div>
    </div>
@endsection
