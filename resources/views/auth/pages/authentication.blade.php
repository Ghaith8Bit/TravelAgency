@extends('auth.layouts.master')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('auth/css/style.css') }}">
    <style>
        .container::before {
            content: "";
            position: absolute;
            top: 0;
            left: -50%;
            width: 100%;
            height: 100%;
            background: linear-gradient(-45deg, #86B817, #86B817);
            z-index: 6;
            transform: translateX(100%);
            transition: 1s ease-in-out;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="signin-signup">
            <form action="{{ route('auth.signin') }}" method="POST" class="sign-in-form">
                @csrf
                <h2 class="title">LOGIN</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" name="email" placeholder="Username">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password">
                </div>
                <input type="submit" value="Login" class="btn">
                <p class="account-text">Don't have an account? <a href="#" id="sign-up-btn2">Sign up</a></p>
            </form>
            <form action="{{ route('auth.signup') }}" method="POST" class="sign-up-form">
                @csrf
                <h2 class="title">SIGN UP</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" placeholder="Username">
                </div>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="text" name="email" placeholder="Email">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password">
                </div>
                <input type="submit" value="Sign up" class="btn">
                <p class="account-text">Already have an account? <a href="#" id="sign-in-btn2">Sign in</a></p>
            </form>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Member of Brand?</h3>
                    <p>Welcome back! Sign in to access your account.</p>
                    <button class="btn" id="sign-in-btn">LOGIN</button>
                </div>
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <a href="{{ route('auth.email.form') }}" data-toggle="modal" data-target="#resetPasswordModal"
                        style="text-decoration: underline">Reset Password</a>
                    <h3> Or New to Brand?</h3>
                    <p>Join us today and experience the benefits of our services.</p>
                    <button class="btn" id="sign-up-btn">Sign up</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="resetPasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resetPasswordModalLabel">Reset Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add your reset password form or content here -->
                    <p>Reset password content goes here...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- Add any other buttons or actions as needed -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const sign_in_btn = document.querySelector("#sign-in-btn");
        const sign_up_btn = document.querySelector("#sign-up-btn");
        const container = document.querySelector(".container");
        const sign_in_btn2 = document.querySelector("#sign-in-btn2");
        const sign_up_btn2 = document.querySelector("#sign-up-btn2");
        if (window.location.hash === "#sign-up-btn") {

            // Get the current URL
            const currentURL = window.location.href;

            // Check if the URL contains a #
            const hashIndex = currentURL.indexOf("#");
            if (hashIndex !== -1) {
                sign_up_btn.click();
                container.classList.remove("sign-up-mode2");
                container.classList.add("sign-up-mode");
                // Remove the fragment identifier
                var cleanUrl = currentURL.split("#")[0];

                // Replace the current URL without the fragment identifier
                history.replaceState(null, null, cleanUrl);
            }
        }
        sign_up_btn.addEventListener("click", () => {
            container.classList.add("sign-up-mode");
        });
        sign_in_btn.addEventListener("click", () => {
            container.classList.remove("sign-up-mode");
        });
        sign_up_btn2.addEventListener("click", () => {
            container.classList.add("sign-up-mode2");
        });
        sign_in_btn2.addEventListener("click", () => {
            container.classList.remove("sign-up-mode2");
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    @if (session('toastify'))
        <script>
            Toastify({
                text: '{{ session('toastify.text') }}',
                className: '{{ session('toastify.className') }}',
                duration: 2000,
            }).showToast();
        </script>
    @endif
@endsection
