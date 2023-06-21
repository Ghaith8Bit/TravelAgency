@extends('website.layouts.master')

@section('header')
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">{{ $trip->name }}</h1>
                    <p class="fs-4 text-white mb-4 animated slideInDown">{{ $trip->description }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="booking p-5">
                <div class="row g-5 align-items-center">
                    <div class="col-md-6 text-white">
                        <h6 class="text-white text-uppercase">Booking</h6>
                        <h1 class="text-white mb-4">Online Booking</h1>
                        <p class="mb-4">Experience the trip of a lifetime with our online booking service. Discover
                            amazing destinations, exciting activities, and create unforgettable memories.</p>
                        <p class="mb-4">Whether you're seeking a relaxing getaway or an adventurous journey, our team is
                            here to assist you in planning the perfect trip. With our carefully curated selection of
                            packages, you can find the ideal travel experience tailored to your preferences.</p>
                        <p class="mb-2">Start Date: <span
                                class="text-white">{{ $trip->start_date->format('Y-m-d') }}</span></p>
                        <p class="mb-2">End Date: <span class="text-white">{{ $trip->end_date->format('Y-m-d') }}</span>
                        </p>
                        <p class="mb-2">Price: <span class="text-white">{{ $trip->price }}</span></p>
                    </div>
                    <div class="col-md-6">
                        <h1 class="text-white mb-4">Book Now</h1>
                        <form action="#" method="POST">
                            <div class="row g-3">
                                <div class="col-12">
                                    <button class="btn btn-outline-light w-100 py-3" type="submit">Book Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
