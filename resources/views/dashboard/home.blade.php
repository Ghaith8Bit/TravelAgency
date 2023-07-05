@extends('dashboard.layouts.master')

@section('content')
    <style>
        body {
            overflow-x: hidden;
            overflow-y: hidden;
        }
    </style>
    @if (auth()->user()->isAdmin())
        <section>
            <div class="container-fluid">
                <div class="row" style="margin-top: 5rem">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user-shield"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">{{ __('dashboard/home.administrator_accounts') }}</span>
                                <span class="info-box-number">{{ $adminCount }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-user"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">{{ __('dashboard/home.user_accounts') }}</span>
                                <span class="info-box-number">{{ $userCount }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix hidden-md-up"></div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-suitcase"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">{{ __('dashboard/home.trips') }}</span>
                                <span class="info-box-number">{{ $tripCount }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-box"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">{{ __('dashboard/home.packages') }}</span>
                                <span class="info-box-number">{{ $packageCount }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-dark text-light" style="padding: 24.4vh 0 30.4vh 0rem;margin-top: 3rem">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Carousel indicators -->
                        <ol class="carousel-indicators" style="margin-bottom:-5rem">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                            <li data-target="#myCarousel" data-slide-to="3"></li>
                            <li data-target="#myCarousel" data-slide-to="4"></li>
                            <li data-target="#myCarousel" data-slide-to="5"></li>
                        </ol>
                        <!-- Wrapper for carousel items -->
                        <div class="carousel-inner">
                            <div class="carousel-item active text-center">
                                <h2 class="mx-auto">{{ __('dashboard/home.user_management') }} <span class="ml-2"><i
                                            class="fas fa-user"></i></span>
                                </h2>
                                <p class="testimonial mx-auto">{{ __('dashboard/home.user_management_slide') }}</p>
                                <a href="{{ route('dashboard.users.index') }}"><button
                                        class="btn btn-dark">{{ __('dashboard/home.manage_users') }}</button></a>
                            </div>
                            <div class="carousel-item text-center">
                                <h2 class="mx-auto">{{ __('dashboard/home.trip_management') }} <span class="ml-2"><i
                                            class="fas fa-suitcase"></i></span>
                                </h2>
                                <p class="testimonial mx-auto">{{ __('dashboard/home.trip_management_slide') }}</p>
                                <a href="{{ route('dashboard.trips.index') }}"><button
                                        class="btn btn-dark">{{ __('dashboard/home.manage_trips') }}</button></a>
                            </div>
                            <div class="carousel-item text-center">
                                <h2 class="mx-auto">{{ __('dashboard/home.package_management') }} <span class="ml-2"><i
                                            class="fas fa-box"></i></span>
                                </h2>
                                <p class="testimonial mx-auto">{{ __('dashboard/home.package_management_slide') }}</p>
                                <a href="{{ route('dashboard.packages.index') }}"><button
                                        class="btn btn-dark">{{ __('dashboard/home.manage_packages') }}</button></a>
                            </div>
                            <div class="carousel-item text-center">
                                <h2 class="mx-auto">{{ __('dashboard/home.reservation_management') }} <span
                                        class="ml-2"><i class="fas fa-calendar-check"></i></span>
                                </h2>
                                <p class="testimonial mx-auto">{{ __('dashboard/home.reservation_management_slide') }}</p>
                                <a href="{{ route('dashboard.reservations.index') }}"><button
                                        class="btn btn-dark">{{ __('dashboard/home.manage_reservations') }}</button></a>
                            </div>
                            <div class="carousel-item text-center">
                                <h2 class="mx-auto">{{ __('dashboard/home.rating_management') }} <span class="ml-2"><i
                                            class="fas fa-star"></i></span>
                                </h2>
                                <p class="testimonial mx-auto">{{ __('dashboard/home.rating_management_slide') }}</p>
                                <a href="{{ route('dashboard.ratings.index') }}"><button
                                        class="btn btn-dark">{{ __('dashboard/home.manage_ratings') }}</button></a>
                            </div>
                            <div class="carousel-item text-center">
                                <h2 class="mx-auto">{{ __('dashboard/home.contact_management') }} <span class="ml-2"><i
                                            class="fas fa-phone"></i></span>
                                </h2>
                                <p class="testimonial mx-auto">{{ __('dashboard/home.contact_management_slide') }}</p>
                                <a href="{{ route('dashboard.contacts.index') }}"><button
                                        class="btn btn-dark">{{ __('dashboard/home.manage_contacts') }}</button></a>
                            </div>
                        </div>
                        <!-- Carousel controls -->
                        <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if (auth()->user()->isUser())
        <section>
            <div class="container-fluid">
                <div class="row" style="margin-top: 5rem">
                    <div class="col-12 col-sm-6">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary elevation-1"><i
                                    class="fas fa-calendar-check"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">{{ __('dashboard/home.reserved_trips') }}</span>
                                <span class="info-box-number">{{ $reservationCount }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-star"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">{{ __('dashboard/home.total_ratings') }}</span>
                                <span class="info-box-number">{{ $ratingCount }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-dark text-light" style="padding: 24.4vh 0 30.4vh 0rem;margin-top: 3rem">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Carousel indicators -->
                        <ol class="carousel-indicators" style="margin-bottom:-5rem">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                        </ol>
                        <!-- Wrapper for carousel items -->
                        <div class="carousel-inner">
                            <div class="carousel-item active text-center">
                                <h2 class="mx-auto">{{ __('dashboard/home.my_reservations') }}<span class="ml-2"><i
                                            class="fas fa-calendar-check"></i></span>
                                </h2>
                                <p class="testimonial mx-auto">{{ __('dashboard/home.my_reservations_slide') }}</p>
                                <a href="{{ route('dashboard.reservations.myReservations') }}"><button
                                        class="btn btn-dark">{{ __('dashboard/home.my_reservations_button') }}</button></a>
                            </div>
                            <div class="carousel-item text-center">
                                <h2 class="mx-auto">{{ __('dashboard/home.my_ratings') }}<span class="ml-2"><i
                                            class="fas fa-star"></i></span>
                                </h2>
                                <p class="testimonial mx-auto">{{ __('dashboard/home.my_ratings_slide') }}</p>
                                <a href="{{ route('dashboard.ratings.myRatings') }}"><button
                                        class="btn btn-dark">{{ __('dashboard/home.my_ratings_button') }}</button></a>
                            </div>
                        </div>
                        <!-- Carousel controls -->
                        <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
