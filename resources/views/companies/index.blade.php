<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body>

        <div class="content">

            <ul>
                @foreach ($companies as $company)
                    <li>{!! $company->name !!}</li>
                @endforeach
            </ul>

        </div>

    </body>
</html>
