<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky d-flex flex-column justify-content-between h-100 pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'admin.dashboard' ? 'active shadow rounded' : '' }} "
                    aria-current="page" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt fa-lg fa-fw"></i>
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'admin.dishes.index' || 'admin.dishes.create' || 'admin.dishes.edit'? 'active shadow rounded': '' }}"
                    href="{{ route('admin.dishes.index') }}">
                    <i class="fas fa-utensils fa-lg fa-fw"></i>
                    Dishes
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-shopping-bag fa-lg fa-fw"></i>
                    Orders
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-chart-line fa-lg fa-fw"></i>
                    Statistics
                </a>
            </li>
        </ul>
        <div class="dropdown mt-auto p-3">
            <hr>
            <div href="#" class="d-flex align-items-center link-dark text-decoration-none" id="dropdownUser2"
                data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('storage/restaurant_logo/' . Auth::user()->id . '/' . Auth::user()->logo) }}"
                    alt="" width="32" height="32" class="rounded-circle me-2">
                <strong>{{ Auth::user()->name }}</strong>
                <div class="logout text-white ms-auto" aria-labelledby="navbarDropdown">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt fa-lg fa-fw"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>


    </div>
</nav>
