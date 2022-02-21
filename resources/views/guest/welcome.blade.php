@extends('layouts.app')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
    <div class="tags-container">
        <div
            class="row row-cols-2 row-cols-sm-3 row-cols-lg-4 mx-auto container-fluid my-auto pt-3  justify-content-center flex-wrap g-3">
            @foreach ($tags as $tag)
            <div class="col justify-content-center d-flex ">
                <a href="#" class="tags_link text-black text-decoration-none text-center">
                    <div class="card rounded-pill" v-on:click="tagHandler({{json_encode($tag)}})"
                        :class=" filterTags.includes({{ json_encode($tag->id) }}) ? 'active' : '' ">
                        <div class="card-body">
                            <h5 class="card-title mb-0">
                                <span> {{$tag->name}} </span>
                            </h5>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach

        </div>
    </div>
    <svg version="1.1" id="Livello_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
        y="0px" viewBox="0 0 1431.5 113.39" style="enable-background:new 0 0 1431.5 113.39;" xml:space="preserve">
        <path class="st0" fill="#ffc144" fill-opacity="1"
            d="M-8.5,0.29l48,21.53c48,21.69,144,64.5,240,81.87s192,8.48,288-8.6c96-17.25,192-43.09,288-40.95c96,2.3,192,32.19,288,43.09s192,2.02,240-2.14l48-4.32V0.29h-48c-48,0-144,0-240,0s-192,0-288,0s-192,0-288,0s-192,0-288,0s-192,0-240,0H-8.5z" />
    </svg>

    <div class="container mb-5">
        <h2 class="my-5 fs-1">Restaurants</h2>
        <div v-if="filteredRest.length > 0" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-5">
            <div v-for="user in filteredRest" :key="user.id">
                <div class="col h-100 px-3">
                    <a class="text-decoration-none text-black text-center border-0 bg-transparent h-100 w-100"
                        :href="user.slug">
                        <div class="rest_card card border-0 shadow-lg" style="border-radius: 1rem;" aria-hidden="true">
                            <img class="card-img-top img-fluid" style="border-radius: 1rem;"
                                :src="'/storage/restaurant_logo' + '/' + user.id + '/' + user.logo " alt="">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <span class="capitalize fs-3 text-black"> @{{ user.name }}</span>
                                </h5>
                                <p class="text-decoration-none mb-1">
                                    @{{ user.address }}
                                </p>
                                <p class="mb-0">
                                    <span v-for="tag in user.tags" :key="tag.id">
                                        @{{ tag.name }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>


        <div v-else-if="filteredUsers.length > 0" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-5">
            <div v-for="user in filteredUsers" :key="user.id">
                <div class="col h-100 px-3">
                    <a class=" text-decoration-none text-black text-center border-0 bg-transparent h-100 w-100"
                        :href="user.slug">
                        <div class="rest_card card border-0 shadow-lg" style="border-radius: 1rem;" aria-hidden="true">
                            <img class="card-img-top img-fluid" style="border-radius: 1rem;"
                                :src="'/storage/restaurant_logo' + '/' + user.id + '/' + user.logo " alt="">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <span class="capitalize fs-3 text-black"> @{{ user.name }}</span>
                                </h5>
                                <p class="text-decoration-none mb-1">
                                    @{{ user.address }}
                                </p>
                                <p class="mb-0">
                                    <span v-for="tag in user.tags" :key="tag.id">
                                        @{{ tag.name }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div v-else class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-5">
            <div v-for="user in users" :key="user.id">
                <div class="col h-100 px-3">
                    <a class=" text-decoration-none text-black text-center border-0 bg-transparent h-100 w-100"
                        :href="user.slug">
                        <div class="card border-0 shadow-lg" style="border-radius: 1rem;" aria-hidden="true">

                            <img class="card-img-top img-fluid" style="border-radius: 1rem;"
                                :src="'/storage/restaurant_logo' + '/' + user.id + '/' + user.logo " alt="">

                            <div class="card-body">
                                <h5 class="card-title">
                                    <span class="capitalize fs-3 text-black"> @{{ user.name }}</span>
                                </h5>
                                <p class="text-decoration-none">
                                    @{{ user.address }}
                                </p>
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
                        r="30"></circle>
                </svg>
            </div>

        </div>

        <button v-on:click="prev" v-show="currentPage != 1">
            prev
        </button>
        <div v-for="page in lastPage" :key="page" class="page">
            <button v-on:click="current(page)">
                @{{page}}
            </button>
        </div>
        <button v-on:click="next"  v-show="lastPage != currentPage">
            next
        </button>
    @endsection
