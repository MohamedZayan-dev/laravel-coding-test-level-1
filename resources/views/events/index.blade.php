@extends('layouts.bootstrap')

@section('content')
    <div class="container mt-5">
        <a href="{{ url('/event/create') }}"<button type="button" class="btn btn-primary mb-4">Create Event</button></a>
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr>

                                <td>{{ $event->name }}</td>
                                <td>{{ $event->slug }}</td>
                                <td>{{ $event->created_at }}</td>
                                <td>
                                    <a href="{{ url('/events/' . $event->id) }}" <button type="button"
                                        class="btn btn-success">View</button>
                                    </a>
                                    <a href="{{ url('/events/' . $event->id . '/edit') }}" <button type="button"
                                        class="btn btn-primary">Edit</button>
                                    </a>
                                    <form method="post" action="{{ route('events.delete', $event->id) }}">
                                        @csrf
                                        @method('delete')

                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="d-flex">
                    {!! $events->links() !!}
                </div>
            </div>

        </div>

    </div>
