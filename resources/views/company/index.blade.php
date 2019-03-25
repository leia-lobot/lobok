<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body>

        <div class="content">
            <h1>Companies</h1>

            <ul>
                @forelse ($companies as $company)
                    <li>
                        <a href="{{$company->path()}}">{!! $company->name !!}</a>
                    </li>
                    @empty
                        <li>No companies yet.</li>
                @endforelse
            </ul>

        </div>

    </body>
</html>
