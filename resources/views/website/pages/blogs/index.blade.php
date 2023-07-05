@extends('website.layouts.master')

@section('header')
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">{{ __('website/blogs/index.blog') }}</h1>
                    <p class="fs-4 text-white mb-4 animated slideInDown">{{ __('website/blogs/index.blog_description') }}</p>
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
                        {{ __('website/blogs/index.testimonial') }}
                    </h6>
                    <h3 class="mb-5">{{ __('website/blogs/index.explore_our_blogs') }}</h3>
                    <br>
                </div>
                <div class="row g-4">
                    @foreach ($ratings as $rating)
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="blog-item shadow rounded overflow-hidden">
                                <div class="position-relative">
                                    <img class="img-fluid" src="{{ asset($rating->trip->image) }}" alt="blog">
                                    <small
                                        class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">{{ $rating->created_at->diffForHumans() }}</small>
                                </div>
                                <div class="p-4 mt-2">
                                    <div class="d-flex justify-content-between mb-3">
                                        <h5 class="mb-0">{{ $rating->trip->name }}</h5>
                                    </div>
                                    <p class="text-body mb-3">{{ $rating->trip->description }}</p>
                                    <div class="d-flex justify-content-between">
                                        <div class="ps-2">
                                            @for ($i = 1; $i <= $rating->rating; $i++)
                                                <small class="fa fa-star text-primary"></small>
                                            @endfor
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
