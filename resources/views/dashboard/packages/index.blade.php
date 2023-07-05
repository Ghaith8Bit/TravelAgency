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
                    {{ __('dashboard/packages/index.add_new_package') }}
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th>{{ __('dashboard/packages/index.name') }}</th>
                            <th>{{ __('dashboard/packages/index.description') }}</th>
                            <th>{{ __('dashboard/packages/index.price') }}</th>
                            <th>{{ __('dashboard/packages/index.start_date') }}</th>
                            <th>{{ __('dashboard/packages/index.end_date') }}</th>
                            <th>{{ __('dashboard/packages/index.people_count') }}</th>
                            <th>{{ __('dashboard/packages/index.image') }}</th>
                            <th>{{ __('dashboard/packages/index.control') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($packages as $package)
                            <tr>
                                <td>{{ Str::limit($package->trip->name, 30, '...') }}</td>
                                <td>{{ Str::limit($package->trip->description, 30, '...') }}</td>
                                <td>{{ $package->price }}</td>
                                <td><small>{{ $package->trip->start_date->format('Y-m-d') }}</small></td>
                                <td><small>{{ $package->trip->end_date->format('Y-m-d') }}</small></td>
                                <td>{{ $package->people_count }}</td>
                                <td><img src="{{ asset($package->trip->image) }}" alt="Trip Image" width="75"></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            {{ __('dashboard/packages/index.actions') }}
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                                href="{{ route('dashboard.packages.show', $package) }}">{{ __('dashboard/packages/index.show') }}</a>
                                            <a href="{{ route('dashboard.packages.update', $package) }}"
                                                class="dropdown-item" data-toggle="modal"
                                                data-target="#editModal{{ $package->id }}">
                                                {{ __('dashboard/packages/index.edit') }}</a>
                                            <form action="{{ route('dashboard.packages.destroy', $package) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a class="dropdown-item"
                                                    href="{{ route('dashboard.packages.destroy', $package) }}"
                                                    onclick="event.preventDefault(); this.closest('form').submit();">{{ __('dashboard/packages/index.delete') }}</a>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">{{ __('dashboard/packages/index.no_packages') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $packages->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    @foreach ($packages as $package)
        <div class="modal fade" id="editModal{{ $package->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editModal{{ $package->id }}Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('dashboard.packages.update', $package) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModal{{ $package->id }}Label">
                                {{ __('dashboard/packages/index.edit_package') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="trip_name">{{ __('dashboard/packages/index.trip_name') }}</label>
                                <input value="{{ $package->trip->name }}" type="text" class="form-control"
                                    id="trip_name" readonly>
                            </div>
                            <div class="form-group">
                                <label for="trip_description">{{ __('dashboard/packages/index.trip_description') }}</label>
                                <textarea class="form-control" id="trip_description" readonly>{{ $package->trip->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="people_count">{{ __('dashboard/packages/index.people_count') }}</label>
                                <input value="{{ $package->people_count }}" type="number" class="form-control"
                                    id="people_count" name="people_count">
                            </div>
                            <div class="form-group">
                                <label for="price">{{ __('dashboard/packages/index.price') }}</label>
                                <input value="{{ $package->price }}" type="number" class="form-control" id="price"
                                    name="price">
                            </div>
                            <input type="hidden" name="trip_id" value="{{ $package->trip_id }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('dashboard/packages/index.close') }}</button>
                            <button type="submit"
                                class="btn btn-primary">{{ __('dashboard/packages/index.save_changes') }}</button>
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
                <form action="{{ route('dashboard.packages.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">
                            {{ __('dashboard/packages/index.add_package') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="trip_id">{{ __('dashboard/packages/index.select_trip') }}</label>
                            <select class="form-control" id="trip_id" name="trip_id">
                                @foreach ($trips as $trip)
                                    <option value="{{ $trip->id }}">{{ $trip->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="people_count">{{ __('dashboard/packages/index.people_count') }}</label>
                            <input value="{{ old('people_count') }}" type="number" class="form-control"
                                id="people_count" name="people_count">
                        </div>
                        <div class="form-group">
                            <label for="price">{{ __('dashboard/packages/index.price') }}</label>
                            <input value="{{ old('price') }}" type="number" class="form-control" id="price"
                                name="price">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('dashboard/packages/index.close') }}</button>
                        <button type="submit"
                            class="btn btn-primary">{{ __('dashboard/packages/index.save_changes') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
