@extends('layouts.layout')

@section('title', 'Редактирование профиля')

@section('content')
<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row justify-content-center w-100">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-warning text-dark text-center py-2">
                    <h5 class="mb-0">Редактирование профиля</h5>
                </div>
                <div class="card-body p-3">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Аватар -->
                        <div class="text-center mb-3">
                            <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('/images/default-avatar.jpg') }}"
                                 class="rounded-circle mb-2" width="90" height="90" alt="Аватар">

                            <div class="d-flex flex-column align-items-center">
                                <label class="btn btn-outline-primary btn-sm w-100">
                                    Выбрать файл <input type="file" name="avatar" class="d-none">
                                </label>
                                <button class="btn btn-primary btn-sm w-100 mt-2" type="submit">Обновить</button>

                                @if(auth()->user()->avatar)
                                <!-- Форма для удаления аватара -->
                                <form action="{{ route('profile.deleteAvatar') }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger w-100" onclick="return confirm('Вы уверены?')">
                                        Удалить аватар
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>

                        <!-- Вывод уведомлений -->
                        @if(session('success'))
                            <div class="alert alert-success mt-2">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('info'))
                            <div class="alert alert-info mt-2">
                                {{ session('info') }}
                            </div>
                        @endif

                        <!-- Ник -->
                        <div class="mb-2">
                            <label class="form-label">Никнейм</label>
                            <input type="text" name="nickname" class="form-control" value="{{ old('nickname', auth()->user()->nickname) }}">
                        </div>

                        <!-- Возраст (нельзя редактировать) -->
                        <div class="mb-2">
                            <label class="form-label">Возраст</label>
                            <input type="number" class="form-control" value="{{ auth()->user()->age }}" readonly>
                        </div>

                        <!-- Должность (нельзя редактировать) -->
                        <div class="mb-2">
                            <label class="form-label">Должность</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->position }}" readonly>
                        </div>

                        <!-- Советы -->
                        <div class="mb-2">
                            <label class="form-label">Советы</label>
                            <textarea name="tips" class="form-control">{{ old('tips', auth()->user()->tips) }}</textarea>
                        </div>

                        <!-- Ключ приглашения (нельзя редактировать) -->
                        <div class="mb-2">
                            <label class="form-label">Ключ активации</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->invite_key_active ? 'Активен' : 'Не активен' }}" disabled>
                        </div>

                        <!-- Кнопки -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success w-50 btn-sm">Сохранить</button>
                            <a href="{{ route('profile.edit') }}" class="btn btn-secondary w-50 btn-sm">Отмена</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
