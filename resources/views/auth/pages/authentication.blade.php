@extends('auth.layouts.master')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;

        }

        .container {
            position: relative;
            width: 70vw;
            height: 80vh;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

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

        .signin-signup {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-around;
            z-index: 5;
        }

        form {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            width: 40%;
            min-width: 238px;
            padding: 0 10px;
        }

        form.sign-in-form {
            opacity: 1;
            transition: 0.5s ease-in-out;
            transition-delay: 1s;
        }

        form.sign-up-form {
            opacity: 0;
            transition: 0.5s ease-in-out;
            transition-delay: 1s;
        }

        .title {
            font-size: 35px;
            color: #000;
            margin-bottom: 10px;
        }

        .input-field {
            width: 100%;
            height: 50px;
            background: #f0f0f0;
            margin: 10px 0;
            border: 2px solid #000;
            border-radius: 50px;
            display: flex;
            align-items: center;
        }

        .input-field i {
            flex: 1;
            text-align: center;
            color: #666;
            font-size: 18px;
        }

        .input-field input {
            flex: 5;
            background: none;
            border: none;
            outline: none;
            width: 100%;
            font-size: 18px;
            font-weight: 600;
            color: #444;
        }

        .btn {
            width: 150px;
            height: 50px;
            border: none;
            border-radius: 50px;
            background: linear-gradient(#000, #000);
            color: #ddd;
            font-weight: 600;
            margin: 10px 0;
            text-transform: uppercase;
            cursor: pointer;
        }

        .btn:hover {
            background: #333;
        }

        .social-text {
            margin: 10px 0;
            font-size: 16px;
        }

        .social-media {
            display: flex;
            justify-content: center;
        }

        .social-icon {
            height: 45px;
            width: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #444;
            border: 1px solid #444;
            border-radius: 50px;
            margin: 0 5px;
        }

        a {
            text-decoration: none;
        }

        .social-icon:hover {
            color: #516721;
            border-color: #516721;
        }

        .panels-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-around;
        }

        .panel {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-around;
            width: 35%;
            min-width: 238px;
            padding: 0 10px;
            text-align: center;
            z-index: 6;
        }

        .left-panel {
            pointer-events: none;
        }

        .content {
            color: #0c0c0c;
            transition: 1.1s ease-in-out;
            transition-delay: 0.5s;
        }

        .panel h3 {
            font-size: 24px;
            font-weight: 600;
        }

        .panel p {
            font-size: 15px;
            padding: 10px 0;
        }

        .image {
            width: 100%;
            transition: 1.1s ease-in-out;
            transition-delay: 0.4s;
        }

        .left-panel .image,
        .left-panel .content {
            transform: translateX(-200%);
        }

        .right-panel .image,
        .right-panel .content {
            transform: translateX(0);
        }

        .account-text {
            display: none;
        }

        /*Animation*/
        .container.sign-up-mode::before {
            transform: translateX(0);
        }

        .container.sign-up-mode .right-panel .image,
        .container.sign-up-mode .right-panel .content {
            transform: translateX(200%);
        }

        .container.sign-up-mode .left-panel .image,
        .container.sign-up-mode .left-panel .content {
            transform: translateX(0);
        }

        .container.sign-up-mode form.sign-in-form {
            opacity: 0;
        }

        .container.sign-up-mode form.sign-up-form {
            opacity: 1;
        }

        .container.sign-up-mode .right-panel {
            pointer-events: none;
        }

        .container.sign-up-mode .left-panel {
            pointer-events: all;
        }

        /*Responsive*/
        @media (max-width:779px) {
            .container {
                width: 100vw;
                height: 100vh;
            }
        }

        @media (max-width:635px) {
            .container::before {
                display: none;
            }

            form {
                width: 80%;
            }

            form.sign-up-form {
                display: none;
            }

            .container.sign-up-mode2 form.sign-up-form {
                display: flex;
                opacity: 1;
            }

            .container.sign-up-mode2 form.sign-in-form {
                display: none;
            }

            .panels-container {
                display: none;
            }

            .account-text {
                display: initial;
                margin-top: 30px;
            }
        }

        @media (max-width:320px) {
            form {
                width: 90%;
            }
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
                    <h3>New to Brand?</h3>
                    <p>Join us today and experience the benefits of our services.</p>
                    <button class="btn" id="sign-up-btn">Sign up</button>
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
