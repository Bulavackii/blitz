@extends('layouts.layout')

@section('title', 'Заполните заявку')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="col-md-6 col-lg-3">
        <div class="card shadow-lg border-0 p-4">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Заполните заявку</h3>

                @if (session('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('apply.submit') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="age">Возраст</label>
                        <input type="number" id="age" name="age" class="form-control" min="10" max="99" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="city">Город</label>
                        <input type="text" id="city" name="city" class="form-control" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="profile_link">Ссылка на профиль в игре <span class="text-danger">*</span></label>
                        <input type="url" id="profile_link" name="profile_link" class="form-control" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="contact">Способ связи (Discord, Telegram и т.д.) <span class="text-danger">*</span></label>
                        <input type="text" id="contact" name="contact" class="form-control" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="invite_key">Ключ приглашения <span class="text-danger">*</span></label>
                        <input type="text" id="invite_key" name="invite_key" class="form-control" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="comment">Комментарий (необязательно)</label>
                        <textarea id="comment" name="comment" class="form-control" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-danger btn-block mt-4">Отправить заявку</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
