<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body>

        <div class="content">
            <h1>resource</h1>
            <p>{!! $resource->name !!}</p>

            <ul>
                @forelse ($extras as $extra)
                    <li>
                        {!! $extra->name !!}
                    </li>
                    @empty
                        <li>No extras yet.</li>
                @endforelse
            </ul>

        </div>

    </body>
</html>
