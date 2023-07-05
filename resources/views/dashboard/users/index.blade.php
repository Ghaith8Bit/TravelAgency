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
                    {{ __('dashboard/users/index.add_user') }}
                </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#filterModal">
                    {{ __('dashboard/users/index.filters_search') }}
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th>{{ __('dashboard/users/index.id') }}</th>
                            <th>{{ __('dashboard/users/index.name') }}</th>
                            <th>{{ __('dashboard/users/index.email') }}</th>
                            <th>{{ __('dashboard/users/index.date') }}</th>
                            <th>{{ __('dashboard/users/index.is_admin') }}</th>
                            <th>{{ __('dashboard/users/index.control') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                                <td class="text-center">
                                    <div class="form-check form-switch d-flex justify-content-center pl-0">
                                        <input class="form-check-input" type="checkbox" id="roleSwitch{{ $user->id }}"
                                            name="role_id" value="1" {{ $user->role_id == 2 ? 'checked' : '' }}
                                            onchange="event.preventDefault(); document.getElementById('roleForm{{ $user->id }}').submit();">
                                        <label class="form-check-label" for="roleSwitch{{ $user->id }}"></label>
                                        <form action="{{ route('dashboard.users.role', $user) }}" method="POST"
                                            id="roleForm{{ $user->id }}" style="display:none;">
                                            @csrf
                                            @method('PATCH')
                                        </form>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            {{ __('dashboard/users/index.actions') }}
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                                href="{{ route('dashboard.users.show', $user) }}">{{ __('dashboard/users/index.show') }}</a>
                                            <a href="{{ route('dashboard.users.update', $user) }}" class="dropdown-item"
                                                data-toggle="modal" data-target="#editModal{{ $user->id }}">
                                                {{ __('dashboard/users/index.edit') }} </a>
                                            <form action="{{ route('dashboard.users.destroy', $user) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a class="dropdown-item"
                                                    href="{{ route('dashboard.users.destroy', $user) }}"
                                                    onclick="event.preventDefault(); this.closest('form').submit();">{{ __('dashboard/users/index.delete') }}</a>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">{{ __('dashboard/users/index.no_user_found') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $users->appends(request()->query())->links('pagination::bootstrap-5', ['paginator' => $users]) }}
            </div>
        </div>
    </div>

    {{-- Filters Modal --}}
    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <!-- Filter card content goes here -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('dashboard/users/index.filters_search_label') }}</h5>
                    </div>
                    <div class="card-body px-4 py-3">
                        <form id="usersFilterForm">
                            <div class="form-row mb-3">
                                <div class="form-group col-md-4">
                                    <label for="idFilter">{{ __('dashboard/users/index.id_label') }}</label>
                                    <input type="text" class="form-control" id="idFilter" name="id"
                                        placeholder="Enter ID">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="nameFilter">{{ __('dashboard/users/index.name_label') }}</label>
                                    <input type="text" class="form-control" id="nameFilter" name="name"
                                        placeholder="Enter name">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="emailFilter">{{ __('dashboard/users/index.email_label') }}</label>
                                    <input type="text" class="form-control" id="emailFilter" name="email"
                                        placeholder="Enter email">
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="form-group col-md-6">
                                    <label for="dateFilter">{{ __('dashboard/users/index.date_label') }}</label>
                                    <select class="form-control" id="dateFilter" name="date_operator">
                                        <option value="gt">{{ __('dashboard/users/index.gt') }}</option>
                                        <option value="gte">{{ __('dashboard/users/index.gte') }}</option>
                                        <option value="lt">{{ __('dashboard/users/index.lt') }}</option>
                                        <option value="lte">{{ __('dashboard/users/index.lte') }}</option>
                                    </select>
                                    <input type="date" class="form-control mt-2" id="dateFilterValue"
                                        name="date_value">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="roleFilter">{{ __('dashboard/users/index.role_label') }}</label>
                                    <select class="form-control" id="roleFilter" name="role">
                                        <option value="">{{ __('dashboard/users/index.role_all') }}</option>
                                        <option value="2">{{ __('dashboard/users/index.role_admin') }}</option>
                                        <option value="1">{{ __('dashboard/users/index.role_user') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <button type="submit"
                                        class="btn btn-primary mr-2">{{ __('dashboard/users/index.apply_filters') }}</button>
                                    <button type="reset"
                                        class="btn btn-secondary mr-2">{{ __('dashboard/users/index.reset_filters') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (auth()->user()->isAdmin())
        {{-- Edit Modal --}}
        @foreach ($users as $user)
            <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" role="dialog"
                aria-labelledby="editModal{{ $user->id }}Label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('dashboard.users.update', $user) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModal{{ $user->id }}Label">
                                    {{ __('dashboard/users/index.edit_user') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">{{ __('dashboard/users/index.name') }}</label>
                                    <input value="{{ $user->name }}" type="text" class="form-control"
                                        id="name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="email">{{ __('dashboard/users/index.email') }}</label>
                                    <input value="{{ $user->email }}" type="text" class="form-control"
                                        id="email" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="password">{{ __('dashboard/users/index.password') }}</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ __('dashboard/users/index.close') }}</button>
                                <button type="submit"
                                    class="btn btn-primary">{{ __('dashboard/users/index.save_changes') }}</button>
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
                    <form action="{{ route('dashboard.users.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">{{ __('dashboard/users/index.add_user') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">{{ __('dashboard/users/index.name') }}</label>
                                <input value="{{ old('name') }}" type="text" class="form-control" id="name"
                                    name="name">
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __('dashboard/users/index.email') }}</label>
                                <input value="{{ old('email') }}" type="text" class="form-control" id="email"
                                    name="email">
                            </div>
                            <div class="form-group">
                                <label for="password">{{ __('dashboard/users/index.password') }}</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="form-group">
                                <label for="role">{{ __('dashboard/users/index.role_label') }}</label>
                                <select class="form-control" id="role" name="role_id">
                                    <option value="1" selected>{{ __('dashboard/users/index.role_user') }}</option>
                                    <option value="2">{{ __('dashboard/users/index.role_admin') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('dashboard/users/index.close') }}</button>
                            <button type="submit"
                                class="btn btn-primary">{{ __('dashboard/users/index.save_changes') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    <script>
        (function() {
            const form = document.querySelector('#usersFilterForm');
            const submitBtn = form.querySelector('button[type="submit"]');
            const resetBtn = form.querySelector('button[type="reset"]');

            submitBtn.addEventListener('click', (event) => {
                event.preventDefault();

                const idValue = form.querySelector('#idFilter').value;
                const nameValue = form.querySelector('#nameFilter').value;
                const emailValue = form.querySelector('#emailFilter').value;
                const dateOperator = form.querySelector('#dateFilter').value;
                const dateValue = form.querySelector('#dateFilterValue').value;
                const roleValue = form.querySelector('#roleFilter').value;

                let queryString = '';

                if (idValue) {
                    queryString += `id[like]=${idValue}&`;
                }
                if (nameValue) {
                    queryString += `name[like]=${nameValue}&`;
                }
                if (emailValue) {
                    queryString += `email[like]=${emailValue}&`;
                }
                if (dateValue) {
                    queryString += `created_at[${dateOperator}]=${dateValue}&`;
                }
                if (roleValue) {
                    queryString += `role_id[eq]=${roleValue}&`;
                }

                // Remove the trailing '&' if there is one
                if (queryString.endsWith('&')) {
                    queryString = queryString.slice(0, -1);
                }

                window.location.href = `http://localhost:8000/dashboard/users?${queryString}`;
            });

            resetBtn.addEventListener('click', () => {
                // Clear the form fields
                form.querySelector('#idFilter').value = '';
                form.querySelector('#nameFilter').value = '';
                form.querySelector('#emailFilter').value = '';
                form.querySelector('#dateFilter').value = '';
                form.querySelector('#dateFilterValue').value = '';
                form.querySelector('#roleFilter').value = '';
            });
        })();
    </script>
@endsection
