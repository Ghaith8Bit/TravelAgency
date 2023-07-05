@extends('website.layouts.master')

@section('header')
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">{{ __('gallery.header_title') }}</h1>
                    <p class="fs-4 text-white mb-4 animated slideInDown">{{ __('gallery.header_description') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-xxl py-5 destination">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">{{ __('gallery.section_title') }}</h6>
                <h1 class="mb-5">{{ __('gallery.popular_places_title') }}</h1>
            </div>
            <div class="row g-3">
                @foreach ($trips->chunk(3) as $chunk)
                    <div class="col-lg-4">
                        @foreach ($chunk as $trip)
                            <div class="wow zoomIn" data-wow-delay="0.1s">
                                <a class="position-relative d-block overflow-hidden" href="#">
                                    <img class="img-fluid" src="{{ asset($trip->image) }}" alt="">
                                    <div
                                        class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">
                                        {{ Str::limit($trip->name, 18, '...') }}
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    @if (!$loop->last && ($loop->index + 1) % 3 === 0)
                        <div class="col-lg-4 wow zoomIn" data-wow-delay="0.7s">
                            <a class="position-relative d-block h-100 overflow-hidden" href="#">
                                <img class="img-fluid position-absolute w-100 h-100" src="{{ asset($trip->image) }}"
                                    alt="" style="object-fit: cover;">
                                <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">
                                    {{ Str::limit($trip->name, 18, '...') }}
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
