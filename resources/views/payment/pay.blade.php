@extends('layouts.app')

@section('content')
    <div class="payPage"></div>
    <div class="container">
        <div class="row mt-5 row-cols-1 row-cols-lg-2">
            <div class="col d-flex flex-column justify-content-center">
                <h1><strong>You are about to pay at the restaurant:</strong> <span
                        class="fs-1">{{ $restaurant->name }}</span></h1>


                <span class="fs-2"><strong>The name of the order is:</strong>{{ $order->customer_name }}</span>
                <span class="fs-3"><strong>Located in via:</strong> {{ $order->address }}</span>
                <span class="fs-3"><strong>E-mail:</strong> {{ $order->email }}</span>
                <span class="fs-3" id="total_price"><strong>Price:</strong> {{ $order->total_price }}€</span>


            </div>

            <div class="col">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div id="dropin-container"></div>
                        <button id="submit-button" class="btn bg_secondary_smooth text_secondary fw-bold">Request payment
                            method</button>
                    </div>
                </div>
            </div>

            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}

        </div>
    </div>
@endsection

@section('custom-js')
    <script type="module">
        var button = document.querySelector('#submit-button');
        var client_token = "{{ $token }}"
        var total_price = parseInt(document.getElementById('total_price').innerHTML);

        braintree.dropin.create({
            authorization: client_token,
            selector: '#dropin-container'
        }, function(createErr, instance) {
            button.addEventListener('click', function() {
                instance.requestPaymentMethod(function(err, payload) {
                    $.get('{{ route('payment.make', $order->id) }}', {
                        payload
                    }, function(response) {
                        if (response.success) {
                            alert('Payment successfull!');
                        } else {
                            alert('Payment failed');
                        }
                    }, 'json');
                });
            });
        });
    </script>
@endsection
