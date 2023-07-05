<div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-3">{{ __('website/footer.company') }}</h4>
                <a class="btn btn-link" href="">{{ __('website/footer.about') }}</a>
                <a class="btn btn-link" href="">{{ __('website/footer.contact') }}</a>
                <a class="btn btn-link" href="">{{ __('website/footer.privacy') }}</a>
                <a class="btn btn-link" href="">{{ __('website/footer.terms') }}</a>
                <a class="btn btn-link" href="">{{ __('website/footer.faq') }}</a>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-3">{{ __('website/footer.contact') }}</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>{{ __('website/footer.address') }}</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>{{ __('website/footer.phone') }}</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>{{ __('website/footer.email') }}</p>
                <div class="d-flex pt-2">
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-3">{{ __('website/footer.gallery') }}</h4>
                <div class="row g-2 pt-2">
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="{{ asset('dist/img/package-1.jpg') }}" alt="">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="{{ asset('dist/img/package-2.jpg') }}" alt="">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="{{ asset('dist/img/package-3.jpg') }}" alt="">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="{{ asset('dist/img/package-2.jpg') }}" alt="">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="{{ asset('dist/img/package-3.jpg') }}" alt="">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="{{ asset('dist/img/package-1.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom"
                        href="{{ route('website.home') }}">{{ __('website/footer.footer_home') }}</a>,
                    {{ __('website/footer.rights_reserved') }}.

                    {{ __('website/footer.designed_by') }} <a class="border-bottom"
                        href="{{ route('website.about') }}">{{ __('website/footer.footer_about') }}</a>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="footer-menu">
                        <a href="{{ route('website.home') }}">{{ __('website/footer.footer_home') }}</a>
                        <a href="">{{ __('website/footer.footer_trips') }}</a>
                        <a href="{{ route('website.about') }}">{{ __('website/footer.footer_about') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
