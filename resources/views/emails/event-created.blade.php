
    @component('mail::message')
        {{ $event->name }} was created successfully.
        <br>
        Here are the information:
        <br>
        <h1>name: {{ $event->name }}</h1>
        <h2>slug: {{ $event->slug }}</h2>
        <h3>created at: {{ $event->created_at }}</h3>
        <br>

        Thanks
        {{ config('app.name') }}
    @endcomponent
