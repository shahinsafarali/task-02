<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
        <title>@yield('title')</title>

        <style>
            body {
                background: #dedede;
                font-family: 'Roboto', sans-serif;
                text-align: center;
                padding-top: 5rem;
            }

            .image404 {
                width: 256px;
            }

        </style>
    </head>
    <body class="antialiased">
        <div class="">
            <div>
                <img class="image404" src="{{ asset('images/error-404.png') }}" alt="">
            </div>

            <div class="fs-30 mt-5">
                @yield('message')
            </div>
        </div>
    </body>
</html>
