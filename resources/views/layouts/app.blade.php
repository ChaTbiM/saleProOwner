<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" style="height: 100vh">
        <main class="py-4 align-middle" style="height: 100%">
            @yield('content')
        </main>
    </div>
</body>
</html>

<style>
    #app{

        /* background: #7b4397; fallback for old browsers */
  /* background: -webkit-linear-gradient(to right, #7b4397, #dc2430); Chrome 10-25, Safari 5.1-6 */
  /* background: linear-gradient(to right, #7b4397, #dc2430); W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
  background: rgb(255,131,61);
background: linear-gradient(90deg, rgba(255,131,61,1) 0%, rgba(249,75,126,1) 100%);
    }
</style>
