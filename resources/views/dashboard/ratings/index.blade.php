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
                            <th>Rate</th>
                            <th>Trip</th>
                            <th>Date</th>
                            <th>Show on Blog</th>
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
                                <td>{{ $rating->created_at->format('M d, Y') }}</td>

                                <td class="text-center">
                                    <div class="form-check form-switch d-flex justify-content-center pl-0">
                                        <input class="form-check-input" type="checkbox"
                                            id="showOnBlogSwitch{{ $rating->id }}" name="show_on_blog" value="1"
                                            {{ $rating->show_on_blog ? 'checked' : '' }}
                                            onchange="event.preventDefault(); document.getElementById('showOnBlogForm{{ $rating->id }}').submit();">
                                        <label class="form-check-label" for="showOnBlogSwitch{{ $rating->id }}"></label>
                                        <form action="{{ route('dashboard.ratings.showOnBlog', $rating) }}" method="POST"
                                            id="showOnBlogForm{{ $rating->id }}" style="display:none;">
                                            @csrf
                                            @method('PATCH')
                                        </form>
                                    </div>
                                </td>
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
