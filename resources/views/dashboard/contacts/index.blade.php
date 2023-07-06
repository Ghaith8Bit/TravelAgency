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
                            <th>{{ __('dashboard/contacts/index.name') }}</th>
                            <th>{{ __('dashboard/contacts/index.email') }}</th>
                            <th>{{ __('dashboard/contacts/index.message') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contacts as $contact)
                            <tr>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->message }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">{{ __('dashboard/contacts/index.no_contacts') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $contacts->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
