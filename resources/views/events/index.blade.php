@extends('layouts.bootstrap')

@section('content')
    <div class="container mt-5">
        <a href="{{ url('/event/create') }}"<button type="button" class="btn btn-primary mb-4">Create Event</button></a>
        @guest
            <a href="/login" type="button" class="btn btn-primary mb-4">Login</a>
        @endguest
        @auth
            <form class=" mt-1" method="post" action="{{ route('web.logout') }}">
                @csrf
                <a href="/logout" type="submit" class="btn btn-primary mb-4">Logout</a>
            </form>
        @endauth
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
        <h3 class="mt-4">
            Calling of an external API(s) and display the data in the UI (Random Users)
        </h3>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">gender</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($randomUsers as $randomUser)
                    <tr>

                        <td>{{ $randomUser->name }}</td>
                        <td>{{ $randomUser->email }}</td>
                        <td>{{ $randomUser->gender }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
