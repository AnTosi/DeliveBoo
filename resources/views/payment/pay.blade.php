@extends('layouts.app')

@section('content')
    <div class="payPage"></div>
    <div class="container">
        <div class="row mt-5 row-cols-1 row-cols-lg-2">
            <div class="col d-flex flex-column justify-content-center text-center">
                <h1><strong>Confirm your order and proceed to checkout</strong></h1>


                <span class="text-muted fs-4"><strong>Restaurant name: </strong>{{ $restaurant->name }}</span>
                <span class="text-muted fs-4"><strong>Delivery to: </strong>{{ $order->customer_name }}</span>
                <span class="text-muted fs-4"><strong>Address: </strong> {{ $order->address }}</span>
                <span class="text-muted fs-4"><strong>E-mail:</strong> {{ $order->email }}</span>
                <span class="text-muted fs-4" id="total_price"><strong>Total price: </strong>
                    €{{ $order->total_price }}</span>


            </div>

            <div class="col">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-md-offset-2 text-center">
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
                            //alert('Payment successfull!');
                            location.replace("http://127.0.0.1:8000/payment/successful");
                        } else {
                            location.replace("http://127.0.0.1:8000/payment/failed");
                        }
                    }, 'json');
                });
            });
        });
    </script>
@endsection
