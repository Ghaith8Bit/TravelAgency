@extends('website.layouts.master')

@section('header')
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">{{ __('website/trips/index.trips') }}</h1>
                    <p class="fs-4 text-white mb-4 animated slideInDown">{{ __('website/trips/index.explore') }}</p>
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
                    <h6 class="section-title bg-white text-center text-primary px-3">
                        {{ __('website/trips/index.testimonial') }}
                    </h6>
                    <h3 class="mb-5">{{ __('website/trips/index.page_title') }}<span
                            class="text-primary text-uppercase"><br></span></h3>
                    <br>
                    <!-- Filter Button -->
                    <div class="text-center">
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                            data-bs-target="#filterModal">
                            {{ __('website/trips/index.open_filter') }}
                        </button>
                    </div>
                </div>
                <div class="row g-4">
                    @foreach ($trips as $trip)
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="blog-item shadow rounded overflow-hidden">
                                <div class="position-relative">
                                    <img class="img-fluid" src="{{ asset($trip->image) }}" alt="blog">
                                    <small
                                        class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">
                                        {{ $trip->start_date->diffForHumans() }}
                                    </small>
                                </div>
                                <div class="p-4 mt-2">
                                    <div class="d-flex justify-content-between mb-3">
                                        <h5 class="mb-0">{{ $trip->name }}</h5>
                                    </div>
                                    <p class="text-body mb-3">{{ $trip->description }}</p>
                                    <div class="d-flex justify-content-between">
                                        <a class="btn btn-sm btn-primary rounded py-2 px-4"
                                            href="{{ route('website.trips.show', ['trip' => $trip]) }}">{{ __('website/trips/index.view_details') }}</a>
                                        <div>
                                            @php
                                                $averageRating = $trip->averageRating();
                                            @endphp

                                            @if ($averageRating > 0)
                                                @for ($i = 1; $i <= $averageRating; $i++)
                                                    <small class="fa fa-star text-primary"></small>
                                                @endfor
                                            @else
                                                <small>{{ __('website/trips/index.no_rating') }}</small>
                                            @endif
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


    <!-- Filter Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">{{ __('website/trips/index.filter_options') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('website.trips.index') }}" method="GET">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="filter-start-date"
                                class="form-label">{{ __('website/trips/index.start_date_range') }}</label>
                            <div class="input-group">
                                <input type="date" class="form-control" id="filter-start-date"
                                    placeholder="{{ __('website/trips/index.from') }}" name="start-date"
                                    value="{{ Request::get('start-date') }}">
                                <input type="date" class="form-control" id="filter-end-date"
                                    placeholder="{{ __('website/trips/index.to') }}" name="end-date"
                                    value="{{ Request::get('end-date') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="filter-price-min"
                                class="form-label">{{ __('website/trips/index.min_price') }}</label>
                            <input type="number" class="form-control" id="filter-price-min"
                                placeholder="{{ __('website/trips/index.enter_min_price') }}" name="price-min"
                                value="{{ Request::get('price-min') }}">
                        </div>

                        <div class="mb-3">
                            <label for="filter-price-max"
                                class="form-label">{{ __('website/trips/index.max_price') }}</label>
                            <input type="number" class="form-control" id="filter-price-max"
                                placeholder="{{ __('website/trips/index.enter_max_price') }}" name="price-max"
                                value="{{ Request::get('price-max') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('website/trips/index.close') }}</button>
                        <button type="submit" class="btn btn-primary"
                            id="apply-filter-btn">{{ __('website/trips/index.apply_filter') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
