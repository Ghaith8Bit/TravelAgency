@extends('dashboard.layouts.master')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert" style="margin-top: 3.5rem">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert" style="margin-top: 3.5rem">
            {{ session('error') }}
        </div>
    @endif
    <div class="container">
        <div class="row mb-3" style="margin-top: 5rem">
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th>Rating</th>
                            <th>Trip Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ratings as $rating)
                            <tr>
                                <td>
                                    @for ($i = 1; $i <= $rating->rating; $i++)
                                        <i class="fa fa-star text-warning"></i>
                                    @endfor
                                </td>
                                <td>{{ $rating->trip->name }}</td>
                                <td>{{ $rating->trip->start_date->format('Y-m-d') }}</td>
                                <td>{{ $rating->trip->end_date->format('Y-m-d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No ratings found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $ratings->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
