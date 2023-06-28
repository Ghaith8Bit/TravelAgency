@extends('website.layouts.master')

@section('header')
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Contact</h1>
                    <p class="fs-4 text-white mb-4 animated slideInDown">
                        How can we help you?
                        <br>For a quick answer, send us your inquiry
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <section class="contact">
        <div class="container">
            <div class="text-center pb-5 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">GET IN TOUCH WITH US</h6>
                <br><br>
                <h1 class="mb-5">contact us</h1>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="info-box">
                                <i class="fa fa-map"></i>
                                <h3>Our location</h3>
                                <p>houses</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="info-box mt-4">
                                <i class="fa fa-envelope"></i>
                                <h3>Email us</h3>
                                <p>example@gmail.com</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="info-box mt-4">
                                <i class="fa fa-phone-alt"></i>
                                <h3>call us</h3>
                                <p>0932542345</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form action="{{ route('website.contact.send') }}" method="POST" class="form">
                        @csrf
                        <div class="row">
                            <div class="col form-group">
                                <input type="text" class="form-control" name="first_name" placeholder="First name"
                                    value="{{ old('first_name') }}">
                            </div>
                            <div class="col form-group">
                                <input type="text" class="form-control" name="last_name" placeholder="Last name"
                                    value="{{ old('last_name') }}">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="email" placeholder="Your email"
                                    value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <textarea name="message" class="form-control" rows="5" placeholder="Your Message">{{ old('message') }}</textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit">Send</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
