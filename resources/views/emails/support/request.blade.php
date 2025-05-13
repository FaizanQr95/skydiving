@component('mail::message')
    # New Support Request: {{ $title }}

    User Details:
        Name: {{ $userName }}
        Email: {{ $userEmail }}

    Description:
    {{ $description }}

    Thanks,
    {{ config('app.name') }}
@endcomponent