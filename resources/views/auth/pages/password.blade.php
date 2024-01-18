@extends('auth.layouts.master')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('auth/css/style.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="signin-signup">
            <form method="POST" action="{{ route('auth.password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="{{ $email }}" required disabled
                        readonly>
                </div>
                <div>
                    <label for="password">New Password:</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div>
                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required>
                </div>
                <div>
                    <button type="submit">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
@endsection
