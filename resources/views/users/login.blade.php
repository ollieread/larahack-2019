@extends('layouts.single')

@section('content')
    <main class="panel">
        <a href="/" class="panel__heading">The Ideas Company</a>
        <form method="post" action="{{ route('user:login.store') }}" class="box">
            {!! csrf_field() !!}
            <header class="box__header">
                Login
            </header>

            <div class="box__content">
                <div class="field__container">
                    <label for="login-email" class="field__label">Email</label>
                    <input type="email" class="field__input {{ $errors->has('email') ? 'field__input--invalid' : '' }}"
                           name="email" id="login-email">
                    {!! $errors->first('email', '<div class="field__feedback">:message</div>') !!}
                </div>
                <div class="field__container">
                    <label for="login-password" class="field__label">Password</label>
                    <input type="password" class="field__input {{ $errors->has('password') ? 'field__input--invalid' : '' }}" name="password" id="login-password">
                    {!! $errors->first('password', '<div class="field__feedback">:message</div>') !!}
                </div>
            </div>

            <footer class="box__footer box__footer--secondary box__footer--right">
                <a href="#" class="box__footer-link">
                    I forgot my password
                </a>
                <button type="submit" class="button button--large">
                    <i class="button__icon fas fa-sign-in fa-fw"></i>
                    Login
                </button>
            </footer>
        </form>
    </main>
@endsection