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
        <a href="/" class="header__brand">
            The Ideas Company
        </a>
        <nav class="header__nav">
            <a href="{{ route('idea:index') }}" class="header__nav-item">
                Ideas
            </a>
            <a href="{{ route('category:index') }}" class="header__nav-item">
                Categories
            </a>
            <a href="{{ route('tag:index') }}" class="header__nav-item">
                Tags
            </a>
            <a href="{{ route('idea:create') }}" class="header__nav-item--stand-out">
                <i class="header__nav-icon fas fa-plus fa-fw"></i>
                Add an idea
            </a>
        </nav>
        <div class="header__user">
            @if ($currentUser)
                <a href="{{ route('user:logout') }}" class="header__user-option">
                    <i class="fas fa-sign-out fa-fw"></i> Logout
                </a>

                <div class="user__avatar--tiny">
                    <img src="{{ $currentUser->avatar }}" alt="">
                </div>
            @else
                <a href="{{ route('user:login.create') }}" class="header__user-option">
                    <i class="fas fa-sign-in fa-fw"></i> Login
                </a>
                <a href="{{ route('user:register.create') }}" class="header__user-option">
                    <i class="fas fa-user-plus fa-fw"></i> Register
                </a>
            @endif
        </div>
    </div>
</header>

<div class="container">
    @yield('content')
</div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
