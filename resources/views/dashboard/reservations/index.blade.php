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
                            <th>{{ __('dashboard/reservations/index.user') }}</th>
                            <th>{{ __('dashboard/reservations/index.reservation') }}</th>
                            <th>{{ __('dashboard/reservations/index.type') }}</th>
                            <th>{{ __('dashboard/reservations/index.is_paid') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->user->name }}</td>
                                <td>
                                    @if ($reservation->reservationable_type === 'App\Models\Trip')
                                        {{ $reservation->reservationable->name }}
                                    @elseif ($reservation->reservationable_type === 'App\Models\Package')
                                        {{ $reservation->reservationable->trip->name }}
                                    @else
                                        {{ __('dashboard/reservations/index.unknown_type') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($reservation->reservationable_type === 'App\Models\Trip')
                                        {{ __('dashboard/reservations/index.trip') }}
                                    @elseif ($reservation->reservationable_type === 'App\Models\Package')
                                        {{ __('dashboard/reservations/index.package') }}
                                    @else
                                        {{ __('dashboard/reservations/index.unknown_type') }}
                                    @endif
                                </td>

                                <td class="text-center">
                                    <div class="form-check form-switch d-flex justify-content-center pl-0">
                                        <input class="form-check-input" type="checkbox"
                                            id="isPaidSwitch{{ $reservation->id }}" name="is_paid" value="1"
                                            {{ $reservation->is_paid ? 'checked' : '' }}
                                            onchange="event.preventDefault(); document.getElementById('isPaidForm{{ $reservation->id }}').submit();">
                                        <label class="form-check-label" for="isPaidSwitch{{ $reservation->id }}"></label>
                                        <form action="{{ route('dashboard.reservations.isPaid', $reservation) }}"
                                            method="POST" id="isPaidForm{{ $reservation->id }}" style="display:none;">
                                            @csrf
                                            @method('PATCH')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">{{ __('dashboard/reservations/index.no_reservations') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $reservations->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
