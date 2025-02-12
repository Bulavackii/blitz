@extends('layouts.layout')

@section('title', 'Сброс пароля')

@section('content')
<div class="container mt-5 d-flex justify-content-center align-items-center" style="min-height: 50vh;">
    <div class="col-md-6">
        <div class="card text-center shadow-lg border-0 p-4">
            <div class="card-body">
                <i class="fa-solid fa-key fa-4x text-danger mb-3"></i> <!-- Красная иконка ключа -->
                <h3 class="card-title">Сброс пароля</h3>
                <p class="text-muted">
                    Введите новый пароль для вашей учетной записи.
                </p>

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Токен сброса пароля -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email -->
                    <div class="form-group text-left">
                        <label for="email"><i class="fa-solid fa-envelope text-danger"></i> Email</label>
                        <input type="email" id="email" class="form-control" name="email" value="{{ old('email', $request->email) }}" required autofocus>
                        @error('email')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Новый пароль -->
                    <div class="form-group text-left">
                        <label for="password"><i class="fa-solid fa-lock text-danger"></i> Новый пароль</label>
                        <input type="password" id="password" class="form-control" name="password" required>
                        @error('password')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Подтверждение пароля -->
                    <div class="form-group text-left">
                        <label for="password_confirmation"><i class="fa-solid fa-lock text-danger"></i> Подтвердите пароль</label>
                        <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required>
                        @error('password_confirmation')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-danger btn-block">
                        Сбросить пароль
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
