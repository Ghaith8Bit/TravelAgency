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
                    Add new Trip
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Image</th>
                            <th>Control</th>
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
                                <td><img src="{{ asset($trip->image) }}" alt="Trip Image" width="75"></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                                href="{{ route('dashboard.trips.show', $trip) }}">Show</a>
                                            <a href="{{ route('dashboard.trips.update', $trip) }}" class="dropdown-item"
                                                data-toggle="modal" data-target="#editModal{{ $trip->id }}">
                                                Edit </a>
                                            <form action="{{ route('dashboard.trips.destroy', $trip) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a class="dropdown-item"
                                                    href="{{ route('dashboard.trips.destroy', $trip) }}"
                                                    onclick="event.preventDefault(); this.closest('form').submit();">Delete</a>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No trips found.</td>
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
                    <form action="{{ route('dashboard.trips.update', $trip) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModal{{ $trip->id }}Label">Edit Trip</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input value="{{ $trip->name }}" type="text" class="form-control" id="name"
                                    name="name">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description">{{ $trip->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input value="{{ (float) $trip->price }}" type="number" class="form-control"
                                    id="price" name="price">
                            </div>
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input value="{{ $trip->start_date->format('Y-m-d') }}" type="date" class="form-control"
                                    id="start_date" name="start_date">
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input value="{{ $trip->end_date->format('Y-m-d') }}" type="date" class="form-control"
                                    id="end_date" name="end_date">
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
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
                        <h5 class="modal-title" id="createModalLabel">Add Trip</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input value="{{ old('name') }}" type="text" class="form-control" id="name"
                                name="name">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input value="{{ old('price') }}" type="number" class="form-control" id="price"
                                name="price">
                        </div>
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input value="{{ old('start_date') }}" type="date" class="form-control" id="start_date"
                                name="start_date">
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input value="{{ old('end_date') }}" type="date" class="form-control" id="end_date"
                                name="end_date">
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
