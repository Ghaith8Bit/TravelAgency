@extends('dashboard.layouts.master')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8" style="margin-top: 3.5rem">
                <div class="card shadow">
                    <div class="card-header">
                        <h1 class="card-title">{{ $package->trip->name }}</h1>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $package->trip->description }}</p>
                        <hr>
                        <h5>Trip Details</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Price:</strong> ${{ $package->price }}</p>
                                <p><strong>Start Date:</strong> {{ $package->trip->start_date }}</p>
                                <p><strong>End Date:</strong> {{ $package->trip->end_date }}</p>
                                <p><strong>People Count:</strong> {{ $package->people_count }}</p>
                                <p><strong>Image:</strong></p>
                                <img src="{{ asset($package->trip->image) }}" alt="Trip Image" class="img-fluid"
                                    width="200px">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('dashboard.packages.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
