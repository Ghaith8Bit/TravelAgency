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
                        <h6 class="text-white text-uppercase">{{ __('website/trips/show.booking') }}</h6>
                        <h1 class="text-white mb-4">{{ __('website/trips/show.online_booking') }}</h1>
                        <p class="mb-4">{{ __('website/trips/show.experience_trip') }}</p>
                        <p class="mb-4">{{ __('website/trips/show.plan_trip') }}</p>
                        <p class="mb-2">{{ __('website/trips/show.start_date') }} <span
                                class="text-white">{{ $trip->start_date->format('Y-m-d') }}</span></p>
                        <p class="mb-2">{{ __('website/trips/show.end_date') }} <span
                                class="text-white">{{ $trip->end_date->format('Y-m-d') }}</span>
                        </p>
                        <p class="mb-2">{{ __('website/trips/show.price') }} <span
                                class="text-white">{{ $trip->price }}</span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h1 class="text-white mb-4">{{ __('website/trips/show.book_now') }}</h1>
                        <form action="{{ route('website.reservations.store.trip', ['trip' => $trip]) }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <button class="btn btn-outline-light w-100 py-3"
                                        type="submit">{{ __('website/trips/show.book_now') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
