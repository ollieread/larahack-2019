<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>The Ideas Company</title>
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet">
</head>
<body>

<header class="header">
    <div class="container">
        <div class="header__brand">
            The Ideas Company
        </div>
        <nav class="header__nav">
            <a href="/" class="header__nav-item">
                <i class="header__nav-icon fas fa-lightbulb fa-fw"></i>
                Ideas
            </a>
            <a href="#" class="header__nav-item">
                <i class="header__nav-icon fas fa-folder-tree fa-fw"></i>
                Categories
            </a>
            <a href="#" class="header__nav-item">
                <i class="header__nav-icon fas fa-tag fa-fw"></i>
                Tags
            </a>
        </nav>
    </div>
</header>

<div class="container">
    <main class="content">
        @yield('content')
    </main>
</div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
