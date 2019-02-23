<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>The Ideas Company</title>
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet">
</head>
<body>

<div class="container single">
    @yield('content')
</div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
