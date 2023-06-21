@extends('website.layouts.master')

@section('header')
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Packages</h1>
                    <p class="fs-4 text-white mb-4 animated slideInDown">Explore Our Exciting Packages in this page
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <section id="blog" class="py-4">
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title bg-white text-center text-primary px-3">Testimonial</h6>
                    <h3 class="mb-5">Explore Our <span class="text-primary text-uppercase"><br>This is the page of all
                            Pacages we have</span></h3>
                    <br>
                </div>
                <div class="row g-4">
                    @foreach ($packages as $package)
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="blog-item shadow rounded overflow-hidden">
                                <div class="position-relative">
                                    <img class="img-fluid" src="{{ asset('dist/image/blog-1.jpg') }}" alt="blog">
                                    <small
                                        class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">{{ $package->trip->start_date }}</small>
                                </div>
                                <div class="p-4 mt-2">
                                    <div class="d-flex justify-content-between mb-3">
                                        <h5 class="mb-0">{{ $package->trip->name }}</h5>

                                    </div>
                                    <p class="text-body mb-3">{{ $package->trip->description }}</p>
                                    <div class="d-flex justify-content-between">
                                        <a class="btn btn-sm btn-primary rounded py-2 px-4"
                                            href="{{ route('website.packages.show', ['package' => $package]) }}">View
                                            Detail</a>
                                        <div class="ps-2">
                                            <small class="fa fa-star text-primary"></small>
                                            <small class="fa fa-star text-primary"></small>
                                            <small class="fa fa-star text-primary"></small>
                                            <small class="fa fa-star text-primary"></small>
                                            <small class="fa fa-star text-primary"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
