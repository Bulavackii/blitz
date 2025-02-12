@extends('layouts.layout')

@section('title', 'Сброс пароля')

@section('content')
<div class="container mt-5 d-flex justify-content-center align-items-center" style="min-height: 50vh;">
    <div class="col-md-6">
        <div class="card text-center shadow-lg border-0 p-4">
            <div class="card-body">
                <i class="fa-solid fa-envelope-circle-check fa-4x text-danger mb-3"></i> <!-- Изменил на красный -->
                <h3 class="card-title">Забыли пароль?</h3>
                <p class="text-muted">
                    Без проблем! Просто укажите ваш email, и мы отправим вам ссылку для сброса пароля.
                </p>

                <!-- Статус сессии (если ссылка уже отправлена) -->
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group text-left">
                        <label for="email"><i class="fa-solid fa-envelope text-danger"></i> Email</label> <!-- Изменил цвет иконки -->
                        <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-danger btn-block"> <!-- Изменил цвет кнопки -->
                        Отправить
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
