@extends('layouts.layout')

@section('title', 'Регистрация - Клан WOT Blitz Kak-Tak To')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
    <div class="col-md-6">
        <div class="card text-center shadow-lg border-0 p-4">
            <div class="card-body">
                <i class="fa-solid fa-user-plus fa-3x text-danger mb-3"></i>
                <h3 class="card-title">Регистрация</h3>
                <p class="text-muted">Создайте аккаунт, чтобы войти в систему</p>

                <!-- Форма регистрации -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group text-left">
                        <label for="name"><i class="fa-solid fa-user"></i> Имя</label>
                        <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                    </div>

                    <div class="form-group text-left">
                        <label for="email"><i class="fa-solid fa-envelope"></i> Email</label>
                        <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group text-left">
                        <label for="password"><i class="fa-solid fa-lock"></i> Пароль</label>
                        <input type="password" id="password" class="form-control" name="password" required>
                    </div>

                    <div class="form-group text-left">
                        <label for="password_confirmation"><i class="fa-solid fa-lock"></i> Подтвердите пароль</label>
                        <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required>
                    </div>

                    <button type="submit" class="btn btn-danger btn-block">Зарегистрироваться</button>
                </form>

                <div class="mt-2">
                    <a href="{{ route('login') }}" class="text-muted">Уже есть аккаунт? Войти</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
