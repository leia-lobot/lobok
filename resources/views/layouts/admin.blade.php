<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ mix('/css/app.css')}}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    </head>
    <body>
            <!--Container -->
            <div class="mx-auto bg-grey-lightest">
                <!--Screen-->
                <div class="min-h-screen flex flex-col">
                    <!--Header Section Starts Here-->
                    @include('components.header')
                    <!--/Header-->

                    <div class="flex flex-1">

                        <!--Sidebar Section Starts Here-->
                        @include('components.nav')
                        <!--/Sidebar-->

                        <!--Main-->
                        <main class="bg-white-medium flex-1 p-3 overflow-hidden">

                            <div class="flex flex-col">
                                <!-- Stats Row Starts Here -->

                                @yield('content')

                            </div>
                        </main>
                        <!--/Main-->
                    </div>
                    <!--Footer-->

                    <!--/footer-->

                </div>

            </div>
            <script src="/js/crap.js"></script>
    </body>
</html>
