@extends('website.layouts.master')

@section('header')
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">{{ __('contact.header_title') }}</h1>
                    <p class="fs-4 text-white mb-4 animated slideInDown">
                        {{ __('contact.header_description') }}
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
                <h6 class="section-title bg-white text-center text-primary px-3">{{ __('contact.get_in_touch') }}</h6>
                <br><br>
                <h1 class="mb-5">{{ __('contact.contact_us') }}</h1>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="info-box">
                                <i class="fa fa-map"></i>
                                <h3>{{ __('contact.our_location') }}</h3>
                                <p>{{ __('contact.location_details') }}</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="info-box mt-4">
                                <i class="fa fa-envelope"></i>
                                <h3>{{ __('contact.email_us') }}</h3>
                                <p>{{ __('contact.email_address') }}</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="info-box mt-4">
                                <i class="fa fa-phone-alt"></i>
                                <h3>{{ __('contact.call_us') }}</h3>
                                <p>{{ __('contact.phone_number') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form action="{{ route('website.contact.send') }}" method="POST" class="form">
                        @csrf
                        <div class="row">
                            <div class="col form-group">
                                <input type="text" class="form-control" name="first_name"
                                    placeholder="{{ __('contact.first_name') }}" value="{{ old('first_name') }}">
                            </div>
                            <div class="col form-group">
                                <input type="text" class="form-control" name="last_name"
                                    placeholder="{{ __('contact.last_name') }}" value="{{ old('last_name') }}">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="email"
                                    placeholder="{{ __('contact.your_email') }}" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <textarea name="message" class="form-control" rows="5" placeholder="{{ __('contact.your_message') }}">{{ old('message') }}</textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit">{{ __('contact.send_button') }}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
