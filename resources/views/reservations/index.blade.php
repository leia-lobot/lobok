<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body>

        <div class="content">
            <h1>reservations</h1>

            <ul>
                @forelse ($reservations as $reservation)
                    <li>
                        {!! $reservation->title !!}
                    </li>
                    @empty
                        <li>No reservations yet.</li>
                @endforelse
            </ul>

        </div>

    </body>
</html>
