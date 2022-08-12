@extends('layouts.bootstrap')

@section('content')

    <div class="mt-5 container">
        <a href="/events" type="button" class="btn btn-primary mb-4">Home</a>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form method="post" action="{{ route('events.edit', $event->id) }}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="name">Name</label>
                <input value={{ $event->name }} class="form-control mt-2" name="name" id="name" placeholder="Enter name">
            </div>
            <div class="form-group mt-3">
                <label for="slug">Slug</label>
                <input value={{ $event->slug }} class="form-control mt-2" name="slug" id="slug" placeholder="Slug">
            </div>
            <button type="submit" class="btn btn-success mt-3">Submit</button>
        </form>
    </div>
