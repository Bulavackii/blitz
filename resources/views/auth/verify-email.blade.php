@extends('layouts.layout')

@section('title', 'Подтверждение Email')

@section('content')
<div class="container mt-5 d-flex justify-content-center align-items-center" style="min-height: 50vh;">
    <div class="col-md-6">
        <div class="card text-center shadow-lg border-0 p-4">
            <div class="card-body">
                <i class="fa-solid fa-envelope-circle-check fa-4x text-danger mb-3"></i> <!-- Красная иконка письма -->
                <h3 class="card-title">Подтвердите ваш Email</h3>
                <p class="text-muted">
                    Спасибо за регистрацию! Перед началом работы, пожалуйста, подтвердите ваш email, перейдя по ссылке в письме.
                    Если вы не получили письмо, мы можем отправить его снова.
                </p>

                @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success">
                        Новая ссылка подтверждения была отправлена на ваш email.
                    </div>
                @endif

                <!-- Форма для повторной отправки письма -->
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-block">
                        Отправить письмо ещё раз
                    </button>
                </form>

                <!-- Форма для выхода -->
                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-block">
                        Выйти
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
