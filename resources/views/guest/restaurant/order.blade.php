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
                                <div class="card text-start shadow-lg"
                                    style="width: 268px; height:100%; padding: 0;border-radius: 1rem;">
                                    <img style="width: 100%;height: 100%;object-fit: cover;border-radius: 1rem;"
                                        class="card-img-top" src="{{ asset('Storage/' . $piatto->image) }}" alt="#">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $piatto->name }}</h4>
                                        <p class="card-text">Quantity: {{ $qty }}</p>
                                        <p class="card-text">Total dish price: {{ $piatto->price * $qty }} € </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
            <div class="mb-3">
                <form action="#" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="customer_name" class="form-label"></label>
                        <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-muted">Help text</small>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label"></label>
                        <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-muted">Help text</small>
                    </div>

                    <div class="form-group">
                        <label for="" class="form-label"></label>
                        <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-muted">Help text</small>
                    </div>

                    <div class="form-group">
                        <label for="" class="form-label"></label>
                        <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-muted">Help text</small>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
