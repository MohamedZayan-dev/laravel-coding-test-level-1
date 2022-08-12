@extends('layouts.bootstrap')

@section('content')

    <div class="container mt-5">
        <a href="/events" type="button" class="btn btn-primary mb-4">Home</a>
        <form class=" mt-1" method="post" action="{{ route('web.login') }}">
            @csrf
            @if (session('message'))
            <div class="alert alert-danger" role="alert">
                {{ session('message') }}
            </div>
        @endif
            <div class="form-group">
                <label for="email">Email address</label>
                <input name="email" required type="email" class="form-control" id="email"
                    placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input required name="password" type="password" class="form-control" id="password" placeholder="Password">
            </div>

                <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
