@extends('layouts.layout')

@section('title', 'Вход - Клан WOT Blitz Kak-Tak To')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
    <div class="col-md-6">
        <div class="card text-center shadow-lg border-0 p-4">
            <div class="card-body">
                <i class="fa-solid fa-user-lock fa-3x text-danger mb-3"></i>
                <h3 class="card-title">Вход в аккаунт</h3>
                <p class="text-muted">Введите свои данные для входа в систему</p>

                <!-- Форма входа -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group text-left">
                        <label for="email"><i class="fa-solid fa-envelope"></i> Email</label>
                        <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="form-group text-left">
                        <label for="password"><i class="fa-solid fa-lock"></i> Пароль</label>
                        <input type="password" id="password" class="form-control" name="password" required>
                    </div>

                    <div class="form-group form-check text-left">
                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                        <label class="form-check-label" for="remember_me">Запомнить меня</label>
                    </div>

                    <button type="submit" class="btn btn-danger btn-block">Войти</button>
                </form>

                <div class="mt-2">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-muted">Забыли пароль?</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
