@extends('auth.layouts.master')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('auth/css/style.css') }}">
@endsection

@section('content')
    {{-- <div class="container">
        <div class="signin-signup">
            <form method="POST" action="{{ route('auth.email.send') }}">
                @csrf
                <div>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div>
                    <button type="submit">Send Reset Link</button>
                </div>
            </form>
        </div>
    </div> --}}



    <div class="container">
        <div class="signin-signup">
            <form action="{{ route('auth.email.send') }}" method="POST" class="sign-in-form">
                @csrf
                <h2 class="title">Reset</h2>
                <br><br><br>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <input type="submit" value="Send Link" class="btn">
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
@endsection
