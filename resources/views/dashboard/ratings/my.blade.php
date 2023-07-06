@extends('dashboard.layouts.master')

@section('content')
    <style>
        .rating input {
            display: none;
        }

        .rating label {
            cursor: pointer;
            color: #ddd;
        }

        .rating label:before {
            content: '\2605';
            font-size: 24px;
        }

        .rating input:checked~label {
            color: #ffc107;
        }
    </style>
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
            <div class="col-md-12">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRatingModal"
                    @if ($trips->isEmpty()) disabled @endif>
                    {{ __('dashboard/ratings/index.add_rating') }}
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th>{{ __('dashboard/ratings/index.rating') }}</th>
                            <th>{{ __('dashboard/ratings/index.trip_name') }}</th>
                            <th>{{ __('dashboard/ratings/index.start_date') }}</th>
                            <th>{{ __('dashboard/ratings/index.end_date') }}</th>
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
                                <td colspan="4">{{ __('dashboard/ratings/index.no_ratings') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $ratings->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <!-- Add Rating Modal -->
    <div class="modal fade" id="addRatingModal" tabindex="-1" aria-labelledby="addRatingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRatingModalLabel">{{ __('dashboard/ratings/index.add_rating') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dashboard.ratings.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="trip_id">{{ __('dashboard/ratings/index.trip_name') }}</label>
                            <select class="form-control" id="trip_id" name="trip_id"
                                @if ($trips->isEmpty()) disabled @endif>
                                @foreach ($trips as $trip)
                                    <option value="{{ $trip->id }}">{{ $trip->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="rating">{{ __('dashboard/ratings/index.rating') }}</label>
                            <div class="rating">
                                <input type="radio" id="star5" name="rating" value="5"
                                    @if ($trips->isEmpty()) disabled @endif>
                                <label for="star5"></label>
                                <input type="radio" id="star4" name="rating" value="4"
                                    @if ($trips->isEmpty()) disabled @endif>
                                <label for="star4"></label>
                                <input type="radio" id="star3" name="rating" value="3"
                                    @if ($trips->isEmpty()) disabled @endif>
                                <label for="star3"></label>
                                <input type="radio" id="star2" name="rating" value="2"
                                    @if ($trips->isEmpty()) disabled @endif>
                                <label for="star2"></label>
                                <input type="radio" id="star1" name="rating" value="1"
                                    @if ($trips->isEmpty()) disabled @endif checked>
                                <label for="star1"></label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" id="submitBtn"
                            @if ($trips->isEmpty()) disabled @endif>{{ __('dashboard/ratings/index.submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
