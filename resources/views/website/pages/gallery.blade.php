@extends('website.layouts.master')

@section('header')
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Gallery</h1>
                    <p class="fs-4 text-white mb-4 animated slideInDown"> Here are some pictures of the places </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-xxl py-5 destination">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">places</h6>
                <h1 class="mb-5">Popular places</h1>
            </div>
            <div class="row g-3">
                <div class="col-lg-7 col-md-6">
                    <div class="row g-3">
                        <div class="col-lg-12 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                            <a class="position-relative d-block overflow-hidden" href="">
                                <img class="img-fluid" src="{{ asset('dist/image/2.1.jpg') }}" alt="">
                                <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">
                                    name place</div>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                            <a class="position-relative d-block overflow-hidden" href="">
                                <img class="img-fluid" src="{{ asset('dist/image/2.2.jpg') }}" alt="">
                                <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">
                                    name place</div>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.5s">
                            <a class="position-relative d-block overflow-hidden" href="">
                                <img class="img-fluid" src="{{ asset('dist/image/2.3.jpg') }}" alt="">
                                <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">
                                    name place</div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px;">
                    <a class="position-relative d-block h-100 overflow-hidden" href="">
                        <img class="img-fluid position-absolute w-100 h-100" src="{{ asset('dist/image/2.5.jpg') }}"
                            alt="" style="object-fit: cover;">
                        <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">name place
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
