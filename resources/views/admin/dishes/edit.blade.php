@extends('layouts.admin')

@section('custom-css')
    <link rel="stylesheet" href="{{ 'css/create.css' }}">
@endsection
@section('content')
    <div class="container lg-sm pt-3">

        {{-- back to index --}}
        <div class="back">
            <a class="text-muted" href="{{ route('admin.dishes.index') }}">
                <i class="fas fa-arrow-left fa-lg fa-fw"></i>
            </a>
        </div>


        <form action="{{ route('admin.dishes.update', $dish->slug) }}" method="post" enctype="multipart/form-data">
            <div class="d-flex justify-content-between py-3">
                <div class="col-6">
                    <h1>Edit your dish</h1>
                </div>
                {{-- form submit --}}
                <div class="col-6 text-end">
                    <button type="submit" class="btn btn-dark">Submit</button>
                </div>
            </div>
            @csrf
            @method('PUT')

            {{-- name --}}
            <div class="mb-3">
                <label for="" class="form-label">Name*:</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    placeholder="" aria-describedby="nameHelper" required value="{{ $dish->name }}">
                <small id="nameHelper" class="text-muted">Type the name of your creation</small>

                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- //name --}}

            {{-- image --}}

            <div class="mb-3">
                <div class="flex-wrap row d-flex row-cols-sm-2 row-cols-1">

                    <div class="col col-md-6">
                        <label for="old_image" class="form-label">
                            Your old image:
                        </label>
                        <div class="old_image mb-3">
                            @if ($dish->image == null)
                                <img class="img-fluid" style="width: 100%"
                                    src="{{ asset('img/no-food-image.jpeg') }}" alt="">
                            @else
                                <img class="img-fluid" style="width: 100%"
                                    src="{{ asset('storage/' . $dish->image) }}" alt="">
                            @endif
                        </div>
                    </div>


                    <div class="col col-md-6">
                        <label for="thumbnail" class="form-label">
                            Your new image:
                        </label>
                        <div class="thumbnail mb-3">
                            <img style="width: 100%"
                                src="http://www.fotopettine.it/wp-content/themes/panama/assets/img/empty/600x600.png"
                                id="thumb" alt="New image" class="img-fluid">
                        </div>
                    </div>

                    <div class="col ms-auto">
                        <input type="file" v-on:change="change" class="form-control @error('image') is-invalid @enderror"
                            name="image" id="my_image" aria-describedby="imageHelper" accept=".png, .jpg">
                        <small id="imageHelper" class="form-text text-muted">Add an image file, only .png and .jpg file
                            below 500 kB are accepted</small>
                    </div>


                </div>

                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- //image --}}

            {{-- ingredients --}}

            <div class="mb-3">
                <label for="ingredients" class="form-label">Ingredients*:</label>
                <textarea type="textarea" rows="3" class="form-control @error('ingredients') is-invalid @enderror"
                    name="ingredients" id="ingredients" aria-describedby="ingredientsHelper" placeholder="Ingredients"
                    required>{{ $dish->ingredients }}</textarea>
                <small id="ingredientsHelper" class="form-text text-muted">Write your dish' ingredients</small>

                @error('ingredients')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- //ingredients --}}

            {{-- description --}}

            <div class="mb-3">
                <label for="description" class="form-label">Description*:</label>
                <textarea type="textarea" rows="5" class="form-control @error('description') is-invalid @enderror"
                    name="description" id="description" aria-describedby="descriptionHelper" placeholder="Description"
                    required>{{ $dish->description }}</textarea>
                <small id="descriptionHelper" class="form-text text-muted">Describe your dish</small>

                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- //description --}}

            {{-- price --}}

            <div class="mb-3">
                <label for="price" class="form-label">Price in ???*:</label>
                <input type="number" class="form-control" name="price" id="price" aria-describedby="priceHelper"
                    step="0.01" value="{{ $dish->price }}" required placeholder="???">
                <small id="priceHelper" class="form-text text-muted">Write your dish' price in ???</small>

                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- //price --}}

            {{-- avilability --}}

            <div class="form-check">
                <input type="hidden" class="form-check-input" name="visibility" id="visibility" value="0">
                <input type="checkbox" class="form-check-input" name="visibility" id="visibility" value="1">
                <label name="visibility" class="form-check-label" for="visibility">
                    Dish availability
                </label>
            </div>

            {{-- //avilability --}}


            <div class="pt-3 pb-2 text-muted">
                <p>All the fields with * are required</p>
            </div>
            <div class="col-4 submit my-3">
                <button type="submit" class="btn btn-dark">Submit</button>
            </div>

        </form>
    </div>
@endsection
