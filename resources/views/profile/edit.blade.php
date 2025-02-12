@extends('layouts.layout')

@section('title', 'Редактирование профиля')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-warning text-dark text-center">
                    <h3>Редактирование профиля</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Аватар -->
                        <div class="text-center mb-3">
                            <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('/images/default-avatar.jpg') }}"
                                 class="rounded-circle" width="120" height="120" alt="Аватар">
                            <input type="file" name="avatar" class="form-control mt-2">
                        </div>

                        <!-- Ник -->
                        <div class="mb-3">
                            <label class="form-label">Никнейм</label>
                            <input type="text" name="nickname" class="form-control" value="{{ old('nickname', auth()->user()->nickname) }}">
                        </div>

                        <!-- Возраст -->
                        <div class="mb-3">
                            <label class="form-label">Возраст</label>
                            <input type="number" name="age" class="form-control" value="{{ old('age', auth()->user()->age) }}">
                        </div>

                        <!-- Должность -->
                        <div class="mb-3">
                            <label class="form-label">Должность</label>
                            <input type="text" name="position" class="form-control" value="{{ old('position', auth()->user()->position) }}">
                        </div>

                        <!-- Советы -->
                        <div class="mb-3">
                            <label class="form-label">Советы</label>
                            <textarea name="tips" class="form-control">{{ old('tips', auth()->user()->tips) }}</textarea>
                        </div>

                        <!-- Ключ приглашения -->
                        <div class="mb-3">
                            <label class="form-label">Активировать ключ приглашения?</label>
                            <select name="invite_key_active" class="form-control">
                                <option value="1" {{ auth()->user()->invite_key_active ? 'selected' : '' }}>Да</option>
                                <option value="0" {{ !auth()->user()->invite_key_active ? 'selected' : '' }}>Нет</option>
                            </select>
                        </div>

                        <!-- Кнопки -->
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-success">Сохранить изменения</button>
                            <a href="{{ route('profile.edit') }}" class="btn btn-secondary">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
