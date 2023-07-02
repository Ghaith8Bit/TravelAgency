@extends('dashboard.layouts.master')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8" style="margin-top: 3.5rem">
                <div class="card shadow">
                    <div class="card-header">
                        <h1 class="card-title">{{ $trip->name }}</h1>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $trip->description }}</p>
                        <hr>
                        <h5>Trip Details</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Price:</strong> ${{ $trip->price }}</p>
                                <p><strong>Start Date:</strong> {{ $trip->start_date }}</p>
                                <p><strong>End Date:</strong> {{ $trip->end_date }}</p>
                                <p><strong>Image:</strong></p>
                                <img src="{{ asset($trip->image) }}" alt="Trip Image" class="img-fluid" width="200px">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('dashboard.trips.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
