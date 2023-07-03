<nav class="main-header navbar navbar-expand-md navbar-dark">
    <!-- Navbar brand -->
    <a class="navbar-brand" href="{{ route('website.home') }}">Trips</a>

    <!-- Hamburger icon for navbar toggle button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="{{ route('dashboard.home') }}"
                    class="nav-link {{ Route::is('dashboard.home') ? 'text-primary' : '' }}">Home</a>
            </li>
            @if (auth()->user()->isAdmin())
                <li class="nav-item">
                    <a href="{{ route('dashboard.users.index') }}"
                        class="nav-link {{ Route::is('dashboard.users.index') ? 'text-primary' : '' }}">Users</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.trips.index') }}"
                        class="nav-link {{ Route::is('dashboard.trips.index') ? 'text-primary' : '' }}">Trips</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.packages.index') }}"
                        class="nav-link {{ Route::is('dashboard.packages.index') ? 'text-primary' : '' }}">Packages</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.reservations.index') }}"
                        class="nav-link {{ Route::is('dashboard.reservations.index') ? 'text-primary' : '' }}">Reservations</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.ratings.index') }}"
                        class="nav-link {{ Route::is('dashboard.ratings.index') ? 'text-primary' : '' }}">Ratings</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.contacts.index') }}"
                        class="nav-link {{ Route::is('dashboard.contacts.index') ? 'text-primary' : '' }}">Contacts</a>
                </li>
            @endif
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="toggleIcon();">
                    <i id="switch-icon" class="fas" style="font-size: 20px;"></i>
                </a>
            </li>
        </ul>


        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('dashboard.profile.index') }}">
                        Profile
                    </a>
                    <a class="dropdown-item" href="{{ route('auth.logout') }}"
                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
