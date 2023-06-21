<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>

    <!-- Include CSS and other head content -->

    @yield('styles')
</head>

<body>
    <a href="{{ redirect()->back()->getTargetUrl() }}"><button class="btn" id="go-back-btn"
            style="width: 50px;margin:10px;position: absolute;left: 0;top: 0;"><i
                class="fas fa-arrow-left"></i></button></a>
    <!-- Main content area -->
    @yield('content')

    <!-- Include JavaScript -->
    @yield('scripts')
</body>

</html>
