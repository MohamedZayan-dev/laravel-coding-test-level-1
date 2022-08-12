@extends('layouts.bootstrap')

@section('content')

<div class="container mt-5">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <h1>name: {{$event->name}}</h1>
    <h2>slug: {{$event->slug}}</h2>
    <h3>created at: {{$event->created_at}}</h3>
</div>
