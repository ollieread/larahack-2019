@extends('layouts.single')

@section('content')
    <main class="panel">
        <a href="/" class="panel__heading">The Ideas Company</a>
        <form method="post" action="{{ route('user:register.store') }}" class="box">
            {!! csrf_field() !!}
            <header class="box__header">
                Register
            </header>

            <div class="box__content">
                <div class="field__container">
                    <label for="login-display_name" class="field__label">Display Name</label>
                    <input type="text"
                           class="field__input {{ $errors->has('display_name') ? 'field__input--invalid' : '' }}"
                           name="display_name" id="login-email">
                    {!! $errors->first('display_name', '<div class="field__feedback">:message</div>') !!}
                </div>
                <div class="field__container">
                    <label for="login-first_name" class="field__label">First Name</label>
                    <input type="text"
                           class="field__input {{ $errors->has('first_name') ? 'field__input--invalid' : '' }}"
                           name="first_name" id="login-first_name">
                    {!! $errors->first('first_name', '<div class="field__feedback">:message</div>') !!}
                </div>
                <div class="field__container">
                    <label for="login-last_name" class="field__label">Last Name</label>
                    <input type="text"
                           class="field__input {{ $errors->has('last_name') ? 'field__input--invalid' : '' }}"
                           name="last_name" id="login-last_name">
                    {!! $errors->first('last_name', '<div class="field__feedback">:message</div>') !!}
                </div>
                <div class="field__container">
                    <label for="login-email" class="field__label">Email</label>
                    <input type="email" class="field__input {{ $errors->has('email') ? 'field__input--invalid' : '' }}"
                           name="email" id="login-email">
                    {!! $errors->first('email', '<div class="field__feedback">:message</div>') !!}
                </div>
                <div class="field__container">
                    <label for="login-password" class="field__label">Password</label>
                    <input type="password"
                           class="field__input {{ $errors->has('password') ? 'field__input--invalid' : '' }}"
                           name="password" id="login-password">
                    {!! $errors->first('password', '<div class="field__feedback">:message</div>') !!}
                </div>
                <div class="field__container">
                    <label for="login-password_confirmation" class="field__label">Password Confirmation</label>
                    <input type="password"
                           class="field__input {{ $errors->has('password_confirmation') ? 'field__input--invalid' : '' }}"
                           name="password_confirmation" id="login-password_confirmation">
                    {!! $errors->first('password_confirmation', '<div class="field__feedback">:message</div>') !!}
                </div>
            </div>

            <footer class="box__footer box__footer--secondary box__footer--right">
                <a href="{{ route('user:login.create') }}" class="box__footer-link">
                    I already have an account
                </a>
                <button type="submit" class="button button--large">
                    <i class="button__icon fas fa-user-plus fa-fw"></i>
                    Register
                </button>
            </footer>
        </form>
    </main>
@endsection