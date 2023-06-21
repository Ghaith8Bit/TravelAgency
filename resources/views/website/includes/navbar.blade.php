<nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
    <a href="{{ route('website.home') }}" class="navbar-brand p-0">
        <h1 class="text-primary m-0"><i class="fa fa-map-marker-alt me-3"></i><span>T</span>rips</h1>
        </h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="{{ route('website.home') }}"
                class="nav-item nav-link {{ Route::is('website.home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('website.trips.index') }}"
                class="nav-item nav-link {{ Route::is('website.trips.index') ? 'active' : '' }}">Trips</a>
            <a href="{{ route('website.about') }}"
                class="nav-item nav-link {{ Route::is('website.about') ? 'active' : '' }}">About</a>
            <a href="{{ route('website.blogs.index') }}"
                class="nav-item nav-link {{ Route::is('website.blogs.index') ? 'active' : '' }}">Blog</a>
            <a href="{{ route('website.contact') }}"
                class="nav-item nav-link {{ Route::is('website.contact') ? 'active' : '' }}">Contact</a>
            <a href="{{ route('website.gallery') }}"
                class="nav-item nav-link {{ Route::is('website.gallery') ? 'active' : '' }} ">Gallery</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Register</a>
                <div class="dropdown-menu m-0">
                    <a href="{{ route('auth.authentication') }}" class="dropdown-item">Login</a>
                    <a href="{{ route('auth.authentication') }}#sign-up-btn" class="dropdown-item">Register</a>
                </div>
            </div>
        </div>
    </div>
</nav>
