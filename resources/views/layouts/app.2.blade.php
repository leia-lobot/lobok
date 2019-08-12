<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @yield('componentcss')
  </head>
  <body>
    <div id="app" class="w-screen h-screen bg-cover" style="background-image: url('https://res.cloudinary.com/dimcuw4l3/image/upload/w_1000,ar_16:9,c_fill,g_auto,e_sharpen/v1565176364/lobok_background_zrepsk.png')">
      @yield('content')
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('javascript')
  </body>
</html>
