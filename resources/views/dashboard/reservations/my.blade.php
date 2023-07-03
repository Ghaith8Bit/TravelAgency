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
                            <th>Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Price</th>
                            <th>Type</th>
                            <th>Is Paid</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reservations as $reservation)
                            <tr>
                                <td>
                                    @if ($reservation->reservationable_type === 'App\Models\Trip')
                                        {{ $reservation->reservationable->name }}
                                    @elseif ($reservation->reservationable_type === 'App\Models\Package')
                                        {{ $reservation->reservationable->trip->name }}
                                    @else
                                        Unknown Type
                                    @endif
                                </td>
                                <td>
                                    @if ($reservation->reservationable_type === 'App\Models\Trip')
                                        {{ $reservation->reservationable->start_date->format('Y-m-d') }}
                                    @elseif ($reservation->reservationable_type === 'App\Models\Package')
                                        {{ $reservation->reservationable->trip->start_date->format('Y-m-d') }}
                                    @else
                                        Unknown Type
                                    @endif
                                </td>
                                <td>
                                    @if ($reservation->reservationable_type === 'App\Models\Trip')
                                        {{ $reservation->reservationable->end_date->format('Y-m-d') }}
                                    @elseif ($reservation->reservationable_type === 'App\Models\Package')
                                        {{ $reservation->reservationable->trip->end_date->format('Y-m-d') }}
                                    @else
                                        Unknown Type
                                    @endif
                                </td>
                                <td>{{ $reservation->reservationable->price }}</td>
                                <td>
                                    @if ($reservation->reservationable_type === 'App\Models\Trip')
                                        Trip
                                    @elseif ($reservation->reservationable_type === 'App\Models\Package')
                                        Package
                                    @else
                                        Unknown Type
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch d-flex justify-content-center pl-0">
                                        <input class="form-check-input" type="checkbox" name="is_paid" value="1"
                                            {{ $reservation->is_paid ? 'checked' : '' }} disabled>
                                        <label class="form-check-label" for="isPaidSwitch{{ $reservation->id }}"
                                            style="cursor: default"></label>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No reservations found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $reservations->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
