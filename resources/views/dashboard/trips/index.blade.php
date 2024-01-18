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
            <div class="col-md-6">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal">
                    {{ __('dashboard/trips/index.add_new_trip') }}
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th>{{ __('dashboard/trips/index.name') }}</th>
                            <th>{{ __('dashboard/trips/index.description') }}</th>
                            <th>{{ __('dashboard/trips/index.price') }}</th>
                            <th>{{ __('dashboard/trips/index.start_date') }}</th>
                            <th>{{ __('dashboard/trips/index.end_date') }}</th>
                            <th>{{ __('dashboard/trips/index.image') }}</th>
                            <th>{{ __('dashboard/trips/index.control') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($trips as $trip)
                            <tr>
                                <td>{{ Str::limit($trip->name, 30, '...') }}</td>
                                <td>{{ Str::limit($trip->description, 30, '...') }}</td>
                                <td>{{ $trip->price }}</td>
                                <td><small>{{ $trip->start_date->format('Y-m-d') }}</small></td>
                                <td><small>{{ $trip->end_date->format('Y-m-d') }}</small></td>
                                <td><img src="{{ asset($trip->image) }}" alt="{{ __('dashboard/trips/index.image') }}"
                                        width="75"></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            {{ __('dashboard/trips/index.action') }}
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                                href="{{ route('dashboard.trips.show', $trip) }}">{{ __('dashboard/trips/index.show') }}</a>
                                            <a href="{{ route('dashboard.trips.update', $trip) }}" class="dropdown-item"
                                                data-toggle="modal" data-target="#editModal{{ $trip->id }}">
                                                {{ __('dashboard/trips/index.edit') }}</a>
                                            <form action="{{ route('dashboard.trips.destroy', $trip) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a class="dropdown-item"
                                                    href="{{ route('dashboard.trips.destroy', $trip) }}"
                                                    onclick="event.preventDefault(); this.closest('form').submit();">{{ __('dashboard/trips/index.delete') }}</a>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">{{ __('dashboard/trips/index.no_trips_found') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $trips->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    @foreach ($trips as $trip)
        <div class="modal fade" id="editModal{{ $trip->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editModal{{ $trip->id }}Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('dashboard.trips.update', $trip) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModal{{ $trip->id }}Label">
                                {{ __('dashboard/trips/index.edit_trip') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">{{ __('dashboard/trips/index.name') }}</label>
                                <input value="{{ $trip->name }}" type="text" class="form-control" id="name"
                                    name="name">
                            </div>
                            <div class="form-group">
                                <label for="description">{{ __('dashboard/trips/index.description') }}</label>
                                <textarea class="form-control" id="description" name="description">{{ $trip->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">{{ __('dashboard/trips/index.price') }}</label>
                                <input value="{{ (float) $trip->price }}" type="number" class="form-control"
                                    id="price" name="price">
                            </div>
                            <div class="form-group">
                                <label for="start_date">{{ __('dashboard/trips/index.start_date') }}</label>
                                <input value="{{ $trip->start_date->format('Y-m-d') }}" type="date" class="form-control"
                                    id="start_date" name="start_date">
                            </div>
                            <div class="form-group">
                                <label for="end_date">{{ __('dashboard/trips/index.end_date') }}</label>
                                <input value="{{ $trip->end_date->format('Y-m-d') }}" type="date" class="form-control"
                                    id="end_date" name="end_date">
                            </div>
                            <div class="form-group">
                                <label for="image">{{ __('dashboard/trips/index.image') }}</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('dashboard/trips/index.close') }}</button>
                            <button type="submit"
                                class="btn btn-primary">{{ __('dashboard/trips/index.save_changes') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Add Modal --}}
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('dashboard.trips.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">{{ __('dashboard/trips/index.add_trip') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">{{ __('dashboard/trips/index.name') }}</label>
                            <input value="{{ old('name') }}" type="text" class="form-control" id="name"
                                name="name">
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('dashboard/trips/index.description') }}</label>
                            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">{{ __('dashboard/trips/index.price') }}</label>
                            <input value="{{ old('price') }}" type="number" class="form-control" id="price"
                                name="price">
                        </div>
                        <div class="form-group">
                            <label for="start_date">{{ __('dashboard/trips/index.start_date') }}</label>
                            <input value="{{ old('start_date') }}" type="date" class="form-control" id="start_date"
                                name="start_date">
                        </div>
                        <div class="form-group">
                            <label for="end_date">{{ __('dashboard/trips/index.end_date') }}</label>
                            <input value="{{ old('end_date') }}" type="date" class="form-control" id="end_date"
                                name="end_date">
                        </div>
                        <div class="form-group">
                            <label for="image">{{ __('dashboard/trips/index.image') }}</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('dashboard/trips/index.close') }}</button>
                        <button type="submit"
                            class="btn btn-primary">{{ __('dashboard/trips/index.save_changes') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
