@extends('dashboard.layouts.master')

@section('content')
    <style>
        body {
            overflow-x: hidden;
            overflow-y: hidden;
        }
    </style>
    @if (auth()->user()->isAdmin())
        <section>
            <div class="container-fluid">
                <div class="row" style="margin-top: 5rem">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user-shield"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Administrator Accounts</span>
                                <span class="info-box-number">
                                    1
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-user"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">User Accounts</span>
                                <span class="info-box-number">1</span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix hidden-md-up"></div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-book"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Courses</span>
                                <span class="info-box-number">1</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bullhorn"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Announcements</span>
                                <span class="info-box-number">1</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-dark text-light" style="padding: 24.4vh 0 30.4vh 0rem;margin-top: 3rem">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Carousel indicators -->
                        <ol class="carousel-indicators" style="margin-bottom:-5rem">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            {{-- <li data-target="#myCarousel" data-slide-to="1"></li> --}}
                        </ol>
                        <!-- Wrapper for carousel items -->
                        <div class="carousel-inner">
                            <div class="carousel-item active text-center">
                                <h2 class="mx-auto">User Management <span class="ml-2"><i class="fas fa-user"></i></span>
                                </h2>
                                <p class="testimonial mx-auto">This slide can take you to the page where you can manage all
                                    the
                                    users on the application.</p>
                                <a href="{{ route('dashboard.users.index') }}"><button class="btn btn-dark">Manage
                                        Users</button></a>
                            </div>
                        </div>
                        <!-- Carousel controls -->
                        <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if (auth()->user()->isUser())
        <section>
            @if (session('success'))
                <div class="alert alert-success" role="alert" style="margin-top: 3.5rem;margin-bottom: -3rem;">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger" role="alert" style="margin-top: 3.5rem;margin-bottom: -3rem;">
                    {{ session('error') }}
                </div>
            @endif
            <div class="container-fluid">
                <div class="row" style="margin-top: 5rem">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-hourglass-half"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Credit Hours</span>
                                <span class="info-box-number">
                                    1
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-chart-line"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">GPA</span>
                                <span class="info-box-number">1</span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix hidden-md-up"></div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-graduation-cap"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Passed Courses</span>
                                <span class="info-box-number">1</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i
                                    class="fas fa-exclamation-triangle"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Conditional Passed Courses</span>
                                <span class="info-box-number">1</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-dark text-light" style="padding: 24.4vh 0 30.4vh 0rem;margin-top: 3.5rem">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Carousel indicators -->
                        <ol class="carousel-indicators" style="margin-bottom:-5rem">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            {{-- <li data-target="#myCarousel" data-slide-to="1"></li> --}}
                        </ol>
                        <!-- Wrapper for carousel items -->
                        <div class="carousel-inner">
                            <div class="carousel-item active text-center">
                                <h2 class="mx-auto">User Management <span class="ml-2"><i
                                            class="fas fa-user"></i></span>
                                </h2>
                                <p class="testimonial mx-auto">This slide can take you to the page where you can manage all
                                    the
                                    users on the application.</p>
                                <a href="{{ route('dashboard.users.index') }}"><button class="btn btn-dark">Manage
                                        Users</button></a>
                            </div>
                        </div>
                        <!-- Carousel controls -->
                        <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
