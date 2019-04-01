<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body>

        <div class="content">
            <h1>resources</h1>

            <ul>
                @forelse ($resources as $resource)
                    <li>
                        {!! $resource->name !!}
                    </li>
                    @empty
                        <li>No resourcess yet.</li>
                @endforelse
            </ul>

        </div>

    </body>
</html>
