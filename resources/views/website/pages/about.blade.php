@extends('website.layouts.master')

@section('header')
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">{{ __('website/about.about') }}</h1>
                    <p class="fs-4 text-white mb-4 animated slideInDown">{{ __('website/about.using_our_website') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <h6 class="section-title bg-white text-start text-primary pe-3">{{ __('website/about.about_us') }}</h6>
                    <h1 class="mb-4">{{ __('website/about.welcome_to_trips') }}</h1>
                    <p class="mb-4">{{ __('website/about.trips_description') }}</p>
                    <div class="row g-3 pb-4">
                        <div class="col-sm-4 wow fadeIn" data-wow-delay="0.1s">
                            <div class="border rounded p-1">
                                <div class="border rounded text-center p-4">
                                    <i class="fas fa-suitcase facts-icon text-primary mb-2"></i>
                                    <h2 class="mb-1" data-toggle="counter-up">{{ $tripCount }}</h2>
                                    <p class="mb-0">{{ __('website/about.total_trips') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 wow fadeIn" data-wow-delay="0.3s">
                            <div class="border rounded p-1">
                                <div class="border rounded text-center p-4">
                                    <i class="fas fa-box facts-icon text-primary mb-2"></i>
                                    <h2 class="mb-1" data-toggle="counter-up">{{ $packageCount }}</h2>
                                    <p class="mb-0">{{ __('website/about.total_packages') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 wow fadeIn" data-wow-delay="0.5s">
                            <div class="border rounded p-1">
                                <div class="border rounded text-center p-4">
                                    <i class="fas fa-calendar-check facts-icon text-primary mb-2"></i>
                                    <h2 class="mb-1" data-toggle="counter-up">{{ $reservationCount }}</h2>
                                    <p class="mb-0">{{ __('website/about.total_reservations') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s"
                                src="{{ asset('dist/image/Qunitera.jpg') }}" style="margin-top: 25%;">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s"
                                src="{{ asset('dist/image/hamah.jpg') }}">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s"
                                src="{{ asset('dist/image/aleppo.jpg') }}">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s"
                                src="{{ asset('dist/image/Damascus.jpg') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
