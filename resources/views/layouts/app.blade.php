<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
  </head>
  <body>
    <div id="app" class="w-screen h-screen bg-cover" style="background-image: url('https://res.cloudinary.com/dimcuw4l3/image/upload/ar_16:9,c_fill,e_sharpen,g_auto,w_1000/v1558341494/stil-1487686-unsplash_qelkzg.png')">
      @yield('content')
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
  </body>
</html>
