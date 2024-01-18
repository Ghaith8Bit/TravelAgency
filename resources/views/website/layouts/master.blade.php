<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}">

<head>
    <meta charset="utf-8">
    <title>Trips</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">


    @include('website.includes.styles')

</head>

<body style="background-image:none">

    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">

        @include('website.includes.navbar')

        @yield('header')

        @yield('content')

        @include('website.includes.footer')

        @include('website.includes.scripts')
</body>

</html>
