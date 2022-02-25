@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5 row-cols-2">
            <div class="col d-flex flex-column justify-content-center">

                <span class="fs-1">{{ $restaurant->name }}</span>

                <span class="fs-2">{{ $order->customer_name }}</span>
                <span class="fs-3">{{ $order->address }}</span>
                <span class="fs-3">{{ $order->email }}</span>
                <span class="fs-3" id="total_price">{{ $order->total_price }}</span>


            </div>

            <div class="col">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div id="dropin-container"></div>
                        <button id="submit-button">Request payment method</button>
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
