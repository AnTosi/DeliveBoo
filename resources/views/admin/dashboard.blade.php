@extends('layouts.admin')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')

    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt fa-lg fa-fw"></i>
                        Dashboard
                    </a>
                </li>
            </ul>

        </div>
    </nav>


@endsection
