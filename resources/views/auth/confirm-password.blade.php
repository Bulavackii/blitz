@extends('layouts.layout')

@section('title', 'Подтверждение пароля')

@section('content')
<div class="container mt-5 d-flex justify-content-center align-items-center" style="min-height: 50vh;">
    <div class="col-md-6">
        <div class="card text-center shadow-lg border-0 p-4">
            <div class="card-body">
                <i class="fa-solid fa-lock fa-4x text-danger mb-3"></i>
                <h3 class="card-title">Подтверждение пароля</h3>
                <p class="text-muted">Это защищённая область приложения. Пожалуйста, подтвердите свой пароль перед продолжением.</p>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div class="form-group text-left">
                        <label for="password"><i class="fa-solid fa-lock"></i> Пароль</label>
                        <input type="password" id="password" class="form-control" name="password" required autocomplete="current-password">
                        @error('password')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-danger btn-block">Подтвердить</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
