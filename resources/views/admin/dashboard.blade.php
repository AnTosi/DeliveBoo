@extends('layouts.admin')

@section('custom-css')
@endsection

@section('content')
    <div class="container my-4">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>

            <div class="col-md-8 my-4">
                <div class="card">
                    <div class="card-body text-center py-4">
                        <h2 class="card-title">Dish</h2>
                        <p class="card-text lead">Create a new dish</p>
                    </div>
                    <a name="" id="" class="btn btn-dark" href="{{ route('admin.dishes.create') }}" role="button">
                        New Dish

                    </a>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center py-4">
                        <h2 class="card-title">Orders</h2>
                        <p class="card-text lead">View your orders</p>
                    </div>
                    <a name="" id="" class="btn btn-dark" href="{{ route('admin.orders.index') }}" role="button">
                        View

                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center py-4">
                        <h2 class="card-title">Statistics</h2>
                        <p class="card-text lead">View statistics</p>
                    </div>
                    <a name="" id="" class="btn btn-dark" href="#" role="button">
                        View

                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
