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
                class="nav-item nav-link {{ Route::is('website.home') ? 'active' : '' }}">{{ __('website/navbar.home') }}</a>
            <a href="{{ route('website.trips.index') }}"
                class="nav-item nav-link {{ Route::is('website.trips.index') ? 'active' : '' }}">{{ __('website/navbar.trips') }}</a>
            <a href="{{ route('website.packages.index') }}"
                class="nav-item nav-link {{ Route::is('website.packages.index') ? 'active' : '' }}">{{ __('website/navbar.packages') }}</a>
            <a href="{{ route('website.about') }}"
                class="nav-item nav-link {{ Route::is('website.about') ? 'active' : '' }}">{{ __('website/navbar.about') }}</a>
            <a href="{{ route('website.blogs.index') }}"
                class="nav-item nav-link {{ Route::is('website.blogs.index') ? 'active' : '' }}">{{ __('website/navbar.blog') }}</a>
            <a href="{{ route('website.contact') }}"
                class="nav-item nav-link {{ Route::is('website.contact') ? 'active' : '' }}">{{ __('website/navbar.contact') }}</a>
            <a href="{{ route('website.gallery') }}"
                class="nav-item nav-link {{ Route::is('website.gallery') ? 'active' : '' }} ">{{ __('website/navbar.gallery') }}</a>
            @guest
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle"
                        data-bs-toggle="dropdown">{{ __('website/navbar.register') }}</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ route('auth.authentication') }}"
                            class="dropdown-item">{{ __('website/navbar.login') }}</a>
                        <a href="{{ route('auth.authentication') }}#sign-up-btn"
                            class="dropdown-item">{{ __('website/navbar.register') }}</a>
                    </div>
                </div>
            @endguest
            @auth
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle"
                        data-bs-toggle="dropdown">{{ __('website/navbar.dashboard') }}</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ route('dashboard.home') }}"
                            class="dropdown-item">{{ __('website/navbar.dashboard') }}</a>
                        <a href="#" class="dropdown-item"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('website/navbar.logout') }}
                        </a>
                    </div>
                </div>
            @endauth
            <!-- Language Switcher Button -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    {{ LaravelLocalization::getCurrentLocaleName() }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li>
                            <a rel="alternate" hreflang="{{ $localeCode }}"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                class="dropdown-item">
                                {{ $properties['native'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</nav>
<form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
    @csrf
</form>
