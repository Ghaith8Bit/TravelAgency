@extends('website.layouts.master')

@section('header')
    <header class="flex">
        <div class="container-fluid bg-primary py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white mb-3 animated slideInDown">{{ __('home.welcome_title') }}</h1>
                        <h1 class="display-3 text-white mb-3  "> {{ __('home.visit_title') }} @if (LaravelLocalization::getCurrentLocale() == 'en')
                                <span class="changecontentEn"></span>
                            @else
                                <span class="changecontentAr"></span>
                            @endif
                        </h1>
                        <p class="fs-4 text-white mb-4 animated slideInDown">{{ __('home.experience_text') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <br>
    <section class="container py-4">
        <h2 class="text-center">{{ __('home.trips_section_title') }}</h2>
        <br>
        <div class="products">
            <div class="container">
                <div class="row card-deck">
                    @foreach ($trips as $trip)
                        <div class="col-lg-4">
                            <div class="card">
                                <img src="{{ asset($trip->image) }}" class="card-img-top" alt="Product 1">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $trip->name }}</h5>
                                    <p class="card-text">{{ $trip->description }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="{{ route('website.trips.show', ['trip' => $trip]) }}"
                                                class="btn btn-outline-success">{{ __('home.trip_view_button') }}</a>
                                        </div>
                                        <span class="price">{{ $trip->price }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">{{ __('home.services_section_title') }}
                </h6>
                <h1 class="mb-5">{{ __('home.services_subtitle') }}</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-globe text-primary mb-4"></i>
                            <h5>{{ __('home.syriawide_tours_title') }}</h5>
                            <p>{{ __('home.syriawide_tours_description') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-hotel text-primary mb-4"></i>
                            <h5>{{ __('home.hotels_title') }}</h5>
                            <p>{{ __('home.hotels_description') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-user text-primary mb-4"></i>
                            <h5>{{ __('home.suitable_price_title') }}</h5>
                            <p>{{ __('home.suitable_price_description') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-cog text-primary mb-4"></i>
                            <h5>{{ __('home.activities_tours_title') }}</h5>
                            <p>{{ __('home.activities_tours_description') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">{{ __('home.packages_section_title') }}
                </h6>
                <h1 class="mb-5">{{ __('home.packages_subtitle') }}</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($packages as $package)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="package-item">
                            <div class="overflow-hidden">
                                <img class="img-fluid" src="{{ asset($package->trip->image) }}" alt="">
                            </div>
                            <div class="d-flex border-bottom">
                                <small class="flex-fill text-center border-end py-2"><i
                                        class="fa fa-map-marker-alt text-primary me-2"></i>{{ Str::limit($package->trip->name, 22, '...') }}</small>
                                <small class="flex-fill text-center border-end py-2"><i
                                        class="fa fa-calendar-alt text-primary me-2"></i>{{ $package->trip->getTripDurationInDays() . ' ' }}{{ $package->trip->getTripDurationInDays() == 1 ? 'day' : 'days' }}
                                </small>
                                <small class="flex-fill text-center py-2"><i
                                        class="fa fa-user text-primary me-2"></i>{{ $package->people_count }}</small>
                            </div>
                            <div class="text-center p-4">
                                <h3 class="mb-0">{{ $package->price }}</h3>
                                <p>{{ $package->trip->description }}</p>
                                <div class="d-flex justify-content-center mb-2">
                                    <a href="{{ route('website.packages.show', ['package' => $package]) }}"
                                        class="btn btn-sm btn-primary px-3 border-end"
                                        style="border-radius: 30px 0 0 30px;">{{ __('home.package_read_button') }}</a>
                                    <form
                                        action="{{ route('website.reservations.store.package', ['package' => $package]) }}"
                                        method="POST" id="bookNowForm">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary px-3"
                                            style="border-radius: 0 30px 30px 0;">{{ __('home.package_book_button') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center pb-4 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">{{ __('home.process_section_title') }}
                </h6>
                <h1 class="mb-5">3 {{ __('home.process_subtitle') }}</h1>
            </div>
            <div class="row gy-5 gx-4 justify-content-center">
                <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative border border-primary pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow"
                            style="width: 100px; height: 100px;">
                            <i class="fa fa-globe fa-3x text-white"></i>
                        </div>
                        <h5 class="mt-4">{{ __('home.choose_destination_title') }}</h5>
                        <hr class="w-25 mx-auto bg-primary mb-1">
                        <hr class="w-50 mx-auto bg-primary mt-0">
                        <p class="mb-0">{{ __('home.choose_destination_text') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="position-relative border border-primary pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow"
                            style="width: 100px; height: 100px;">
                            <i class="fa fa-dollar-sign fa-3x text-white"></i>
                        </div>
                        <h5 class="mt-4">{{ __('home.pay_online_title') }}</h5>
                        <hr class="w-25 mx-auto bg-primary mb-1">
                        <hr class="w-50 mx-auto bg-primary mt-0">
                        <p class="mb-0">{{ __('home.pay_online_text') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="position-relative border border-primary pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow"
                            style="width: 100px; height: 100px;">
                            <i class="fa fa-plane fa-3x text-white"></i>
                        </div>
                        <h5 class="mt-4">{{ __('home.fly_today_title') }}</h5>
                        <hr class="w-25 mx-auto bg-primary mb-1">
                        <hr class="w-50 mx-auto bg-primary mt-0">
                        <p class="mb-0">{{ __('home.fly_today_text') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
