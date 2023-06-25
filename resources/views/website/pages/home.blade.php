@extends('website.layouts.master')

@section('header')
    <header class="flex">
        <div class="container-fluid bg-primary py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white mb-3 animated slideInDown">Welcom To Syria</h1>
                        <h1 class="display-3 text-white mb-3  "> Visit <span class="changecontent"></span></h1>
                        <p class="fs-4 text-white mb-4 animated slideInDown">Experience the ultimate adventure with
                            our incredible trips program!
                            Join us today and discover the best tourist destinations in the syria , while enjoying
                            unforgettable
                            experience</p>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <br>
    <section class="container py-4">
        <h2 class="text-center">Trips</h2>
        <br>
        <div class="products">
            <div class="container">
                <div class="row card-deck">
                    @foreach ($trips as $trip)
                        <div class="col-lg-4">
                            <div class="card">
                                <img src="{{ asset('dist/image/Damascus.jpg') }}" class="card-img-top" alt="Product 1">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $trip->name }}</h5>
                                    <p class="card-text">{{ $trip->description }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="{{ route('website.trips.show', ['trip' => $trip]) }}"
                                                class="btn btn-outline-success">View Details</a>
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
                <h6 class="section-title bg-white text-center text-primary px-3">Services</h6>
                <h1 class="mb-5">Our Services</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-globe text-primary mb-4"></i>
                            <h5>Syriawide Tours</h5>
                            <p>Learn about the most beautiful monuments and tourist places in Syria</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-hotel text-primary mb-4"></i>
                            <h5>Hotels</h5>
                            <p>Hotel Reservations: The website can facilitate the booking of flights and
                                accommodations.
                                Users can search for available flights, compare prices, and make reservations
                                directly through the site</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-user text-primary mb-4"></i>
                            <h5>Suitable Price</h5>
                            <p>Providing the best tourist trips at the best prices, commensurate with the
                                capabilities of all customers</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-cog text-primary mb-4"></i>
                            <h5>Activities and Tours</h5>
                            <p>Travel organizing websites often offer
                                a wide range of activities and tours for travelers to choose from</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Packages</h6>
                <h1 class="mb-5">Awesome Packages</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($packages as $package)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="package-item">
                            <div class="overflow-hidden">
                                <img class="img-fluid" src="{{ asset('dist/image/Damascus.jpg') }}" alt="">
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
                                        style="border-radius: 30px 0 0 30px;">Read More</a>
                                    <a href="#" class="btn btn-sm btn-primary px-3"
                                        style="border-radius: 0 30px 30px 0;">Book Now</a>
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
                <h6 class="section-title bg-white text-center text-primary px-3">Process</h6>
                <h1 class="mb-5">3 Easy Steps</h1>
            </div>
            <div class="row gy-5 gx-4 justify-content-center">
                <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative border border-primary pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow"
                            style="width: 100px; height: 100px;">
                            <i class="fa fa-globe fa-3x text-white"></i>
                        </div>
                        <h5 class="mt-4">Choose A Destination</h5>
                        <hr class="w-25 mx-auto bg-primary mb-1">
                        <hr class="w-50 mx-auto bg-primary mt-0">
                        <p class="mb-0">Explore our diverse range of destinations and choose your dream location. From
                            exotic beach getaways to bustling city adventures, we offer an array of options to suit your
                            travel preferences.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="position-relative border border-primary pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow"
                            style="width: 100px; height: 100px;">
                            <i class="fa fa-dollar-sign fa-3x text-white"></i>
                        </div>
                        <h5 class="mt-4">Pay Online</h5>
                        <hr class="w-25 mx-auto bg-primary mb-1">
                        <hr class="w-50 mx-auto bg-primary mt-0">
                        <p class="mb-0">Securely complete your payment online to confirm your travel booking. We offer
                            convenient and safe payment options, ensuring a hassle-free experience for our customers.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="position-relative border border-primary pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow"
                            style="width: 100px; height: 100px;">
                            <i class="fa fa-plane fa-3x text-white"></i>
                        </div>
                        <h5 class="mt-4">Fly Today</h5>
                        <hr class="w-25 mx-auto bg-primary mb-1">
                        <hr class="w-50 mx-auto bg-primary mt-0">
                        <p class="mb-0">Pack your bags and get ready for an amazing journey. Once your booking is
                            confirmed, you can embark on your adventure and fly to your chosen destination today. Let us
                            take care of the rest!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
